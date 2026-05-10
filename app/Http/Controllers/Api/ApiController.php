<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\RendezVous;
use App\Models\Consultation;
use App\Models\Facture;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Endpoint : Liste des utilisateurs pour la démo (Public)
    public function demoUsers()
    {
        $users = \App\Models\User::all(['id', 'name', 'email', 'role']);
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    // Endpoint 1 : Liste des patients
    public function patients()
    {
        $patients = Patient::select('id', 'nom', 'prenom', 'cin', 'telephone', 'sexe', 'date_naissance')
            ->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $patients,
            'message' => 'Liste des patients récupérée avec succès'
        ]);
    }

    // Endpoint 2 : Liste des médecins
    public function medecins()
    {
        $medecins = Medecin::select('id', 'nom', 'prenom', 'specialite', 'telephone', 'email')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $medecins,
            'message' => 'Liste des médecins récupérée avec succès'
        ]);
    }

    // Endpoint 3 : Liste des rendez-vous
    public function rendezVous()
    {
        $rdvs = RendezVous::with([
            'patient:id,nom,prenom',
            'medecin:id,nom,prenom,specialite'
        ])
            ->orderBy('date_heure', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $rdvs,
            'message' => 'Liste des rendez-vous récupérée avec succès'
        ]);
    }

    // Endpoint 4 : Statistiques générales
    public function stats()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'patients' => Patient::count(),
                'medecins' => Medecin::count(),
                'rendez_vous' => RendezVous::count(),
                'consultations' => Consultation::count(),
                'factures' => Facture::count(),
                'revenus_total' => Facture::where('statut', 'payee')->sum('montant_total'),
                'rdv_aujourd_hui' => RendezVous::whereDate('date_heure', today())->count(),
            ],
            'message' => 'Statistiques récupérées avec succès'
        ]);
    }

    // Endpoint 5 : Détail d'un patient
    public function patientDetail($id)
    {
        $patient = Patient::with([
            'rendezVous.medecin:id,nom,prenom,specialite',
            'consultations.medecin:id,nom,prenom',
            'factures'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $patient,
            'message' => 'Patient récupéré avec succès'
        ]);
    }

    // Login API : générer un token
    public function login(Request $request)
    {
        // Magic Login (Bypass pour les tests/démo)
        if ($request->has('magic_id')) {
            $user = \App\Models\User::find($request->magic_id);
            if ($user) {
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                    'message' => 'Connexion Magique réussie'
                ]);
            }
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect'
            ], 401);
        }

        $user = \Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
            'message' => 'Connexion réussie'
        ]);
    }

    // Logout API
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie'
        ]);
    }
}