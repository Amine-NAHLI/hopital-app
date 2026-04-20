<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedecinController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $medecins = Medecin::when($search, function ($query) use ($search) {
            $query->where('nom', 'like', "%$search%")
                ->orWhere('specialite', 'like', "%$search%");
        })->paginate(10);

        return view('admin.medecins.index', compact('medecins', 'search'));
    }

    public function create()
    {
        return view('admin.medecins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::create([
            'name' => $request->prenom . ' ' . $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'medecin',
        ]);

        $data = $request->except(['password', 'password_confirmation']);
        $data['user_id'] = $user->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('medecins', 'public');
        }

        Medecin::create($data);

        return redirect()->route('admin.medecins.index')
            ->with('success', 'Médecin ajouté avec succès !');
    }

    public function show(Medecin $medecin)
    {
        $medecin->load(['rendezVous.patient', 'consultations.patient']);
        return view('admin.medecins.show', compact('medecin'));
    }

    public function edit(Medecin $medecin)
    {
        return view('admin.medecins.edit', compact('medecin'));
    }

    public function update(Request $request, Medecin $medecin)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $medecin->user_id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['password']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('medecins', 'public');
        }

        $medecin->update($data);
        $medecin->user->update([
            'name' => $request->prenom . ' ' . $request->nom,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.medecins.index')
            ->with('success', 'Médecin modifié avec succès !');
    }

    public function destroy(Medecin $medecin)
    {
        $medecin->user->delete();
        return redirect()->route('admin.medecins.index')
            ->with('success', 'Médecin supprimé avec succès !');
    }
}