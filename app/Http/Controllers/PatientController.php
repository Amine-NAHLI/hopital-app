<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $patients = Patient::when($search, function ($query) use ($search) {
            $query->where('nom', 'like', "%$search%")
                ->orWhere('prenom', 'like', "%$search%")
                ->orWhere('cin', 'like', "%$search%");
        })->paginate(10);

        $prefix = auth()->user()->isAdmin() ? 'admin' : 'medecin';
        return view("$prefix.patients.index", compact('patients', 'search'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:homme,femme',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'adresse' => 'required|string',
            'cin' => 'required|string|unique:patients,cin',
            'antecedents' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('patients', 'public');
        }

        Patient::create($data);

        return redirect()->route('admin.patients.index')
            ->with('success', 'Patient ajouté avec succès !');
    }

    public function show(Patient $patient)
    {
        $prefix = auth()->user()->isAdmin() ? 'admin' : 'medecin';
        $patient->load(['rendezVous.medecin', 'consultations.medecin', 'ordonnances', 'factures']);
        return view("$prefix.patients.show", compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:homme,femme',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'adresse' => 'required|string',
            'cin' => 'required|string|unique:patients,cin,' . $patient->id,
            'antecedents' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('patients', 'public');
        }

        $patient->update($data);

        return redirect()->route('admin.patients.index')
            ->with('success', 'Patient modifié avec succès !');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('admin.patients.index')
            ->with('success', 'Patient supprimé avec succès !');
    }
}