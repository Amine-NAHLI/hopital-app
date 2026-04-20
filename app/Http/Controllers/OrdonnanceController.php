<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class OrdonnanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Ordonnance::with(['patient', 'medecin']);

        if ($user->isMedecin()) {
            $query->where('medecin_id', $user->medecin->id);
        }

        $ordonnances = $query->latest()->paginate(10);
        $prefix = $user->isAdmin() ? 'admin' : 'medecin';

        return view("$prefix.ordonnances.index", compact('ordonnances'));
    }

    public function create()
    {
        $user = auth()->user();
        $consultations = Consultation::with(['patient', 'medecin'])->get();
        $patients = Patient::all();
        $medecins = Medecin::all();
        $prefix = $user->isAdmin() ? 'admin' : 'medecin';

        return view("$prefix.ordonnances.create", compact('consultations', 'patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date_ordonnance' => 'required|date',
            'medicaments' => 'required|string',
            'instructions' => 'nullable|string',
            'fichier' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('ordonnances', 'public');
        }

        Ordonnance::create($data);

        $prefix = auth()->user()->isAdmin() ? 'admin' : 'medecin';
        return redirect()->route("$prefix.ordonnances.index")
            ->with('success', 'Ordonnance créée avec succès !');
    }

    public function show(Ordonnance $ordonnance)
    {
        $prefix = auth()->user()->isAdmin() ? 'admin' : 'medecin';
        return view("$prefix.ordonnances.show", compact('ordonnance'));
    }

    public function edit(Ordonnance $ordonnance)
    {
        $consultations = Consultation::all();
        $patients = Patient::all();
        $medecins = Medecin::all();
        return view('admin.ordonnances.edit', compact('ordonnance', 'consultations', 'patients', 'medecins'));
    }

    public function update(Request $request, Ordonnance $ordonnance)
    {
        $request->validate([
            'medicaments' => 'required|string',
            'instructions' => 'nullable|string',
            'fichier' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('ordonnances', 'public');
        }

        $ordonnance->update($data);

        return redirect()->route('admin.ordonnances.index')
            ->with('success', 'Ordonnance modifiée avec succès !');
    }

    public function destroy(Ordonnance $ordonnance)
    {
        $ordonnance->delete();
        return redirect()->route('admin.ordonnances.index')
            ->with('success', 'Ordonnance supprimée avec succès !');
    }
}