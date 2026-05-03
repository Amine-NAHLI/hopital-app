<?php

/**
 * Fichier : RendezVousController.php
 * Description : Contrôleur gérant les rendez-vous.
 * Rôle : Permet de planifier, d'afficher et de modifier le statut des rendez-vous entre patients et médecins.
 */


namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->get('search');

        $query = RendezVous::with(['patient', 'medecin']);

        if ($user->isMedecin()) {
            $query->where('medecin_id', $user->medecin->id);
        }

        if ($search) {
            $query->whereHas('patient', function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                    ->orWhere('prenom', 'like', "%$search%");
            });
        }

        $rendezVous = $query->orderBy('date_heure', 'desc')->paginate(10);
        $prefix = $user->isAdmin() ? 'admin' : 'medecin';

        return view("$prefix.rendez-vous.index", compact('rendezVous', 'search'));
    }

    public function create()
    {
        $patients = Patient::all();
        $medecins = Medecin::all();
        return view('admin.rendez-vous.create', compact('patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date',
            'motif' => 'nullable|string',
            'statut' => 'required|in:en_attente,confirme,annule,termine',
        ]);

        RendezVous::create($request->all());

        return redirect()->route('admin.rendez-vous.index')
            ->with('success', 'Rendez-vous ajouté avec succès !');
    }

    public function show(RendezVous $rendezVous)
    {
        $user = auth()->user();
        if ($user->isMedecin() && $rendezVous->medecin_id !== $user->medecin->id) {
            abort(403, 'Vous n\'êtes pas autorisé à consulter ce rendez-vous.');
        }

        $prefix = $user->isAdmin() ? 'admin' : 'medecin';
        return view("$prefix.rendez-vous.show", compact('rendezVous'));
    }

    public function edit(RendezVous $rendezVous)
    {
        $user = auth()->user();
        if ($user->isMedecin() && $rendezVous->medecin_id !== $user->medecin->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier ce rendez-vous.');
        }

        $patients = Patient::all();
        $medecins = Medecin::all();
        $prefix = $user->isAdmin() ? 'admin' : 'medecin';
        return view("$prefix.rendez-vous.edit", compact('rendezVous', 'patients', 'medecins'));
    }

    public function update(Request $request, RendezVous $rendezVous)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date',
            'motif' => 'nullable|string',
            'statut' => 'required|in:en_attente,confirme,annule,termine',
        ]);

        $rendezVous->update($request->all());
        $prefix = auth()->user()->isAdmin() ? 'admin' : 'medecin';

        return redirect()->route("$prefix.rendez-vous.index")
            ->with('success', 'Rendez-vous modifié avec succès !');
    }

    public function destroy(RendezVous $rendezVous)
    {
        $rendezVous->delete();
        return redirect()->route('admin.rendez-vous.index')
            ->with('success', 'Rendez-vous supprimé avec succès !');
    }
}