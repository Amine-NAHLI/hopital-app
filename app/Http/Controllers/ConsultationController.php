<?php

/**
 * Fichier : ConsultationController.php
 * Description : Contrôleur gérant les consultations médicales.
 * Rôle : Permet de créer, afficher, modifier et supprimer des consultations, ainsi que de générer les factures associées.
 */


namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\Facture;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Consultation::with(['patient', 'medecin']);

        if ($user->isMedecin()) {
            $query->where('medecin_id', $user->medecin->id);
        }

        $consultations = $query->latest()->paginate(10);
        $prefix = $user->isAdmin() ? 'admin' : 'medecin';

        return view("$prefix.consultations.index", compact('consultations'));
    }

    public function create()
    {
        $user = auth()->user();
        $patients = Patient::all();
        $medecins = Medecin::all();

        $rdvQuery = RendezVous::with(['patient', 'medecin'])
            ->where('statut', 'confirme');

        if ($user->isMedecin()) {
            $rdvQuery->where('medecin_id', $user->medecin->id);
        }

        $rendezVous = $rdvQuery->get();
        $prefix = $user->isAdmin() ? 'admin' : 'medecin';

        return view("$prefix.consultations.create", compact('patients', 'medecins', 'rendezVous'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date_consultation' => 'required|date',
            'diagnostic' => 'required|string',
            'traitement' => 'nullable|string',
            'notes' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
        ]);

        $rendezVous = RendezVous::findOrFail($request->rendez_vous_id);
        if ((int) $rendezVous->patient_id !== (int) $request->patient_id) {
            return back()->withErrors(['patient_id' => 'Erreur de sécurité : Le patient sélectionné ne correspond pas au titulaire du rendez-vous choisi.'])->withInput();
        }

        $consultation = Consultation::create($request->all());

        RendezVous::find($request->rendez_vous_id)
            ->update(['statut' => 'termine']);

        Facture::create([
            'consultation_id' => $consultation->id,
            'patient_id' => $consultation->patient_id,
            'numero_facture' => 'FACT-' . date('Y') . '-' . str_pad($consultation->id, 4, '0', STR_PAD_LEFT),
            'date_facture' => today(),
            'montant_total' => $consultation->prix,
            'statut' => 'impayee',
        ]);

        $prefix = auth()->user()->isAdmin() ? 'admin' : 'medecin';
        return redirect()->route("$prefix.consultations.index")
            ->with('success', 'Consultation enregistrée et facture générée !');
    }

    public function show(Consultation $consultation)
    {
        $user = auth()->user();
        if ($user->isMedecin() && $consultation->medecin_id !== $user->medecin->id) {
            abort(403, 'Vous n\'êtes pas autorisé à voir cette consultation.');
        }

        $prefix = $user->isAdmin() ? 'admin' : 'medecin';
        $consultation->load(['patient', 'medecin', 'ordonnance', 'facture']);
        return view("$prefix.consultations.show", compact('consultation'));
    }

    public function edit(Consultation $consultation)
    {
        $patients = Patient::all();
        $medecins = Medecin::all();
        return view('admin.consultations.edit', compact('consultation', 'patients', 'medecins'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'diagnostic' => 'required|string',
            'traitement' => 'nullable|string',
            'notes' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
        ]);

        $consultation->update($request->all());

        return redirect()->route('admin.consultations.index')
            ->with('success', 'Consultation modifiée avec succès !');
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('admin.consultations.index')
            ->with('success', 'Consultation supprimée avec succès !');
    }
}