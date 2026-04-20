<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medecin;
use App\Models\RendezVous;
use App\Models\Consultation;
use App\Models\Facture;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $stats = [
            'patients' => Patient::count(),
            'medecins' => Medecin::count(),
            'rendez_vous' => RendezVous::count(),
            'consultations' => Consultation::count(),
            'factures' => Facture::count(),
            'revenus' => Facture::where('statut', 'payee')->sum('montant_total'),
        ];

        $rdvAujourdhui = RendezVous::with(['patient', 'medecin'])
            ->whereDate('date_heure', today())
            ->get();

        $rdvRecents = RendezVous::with(['patient', 'medecin'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact('stats', 'rdvAujourdhui', 'rdvRecents'));
    }

    public function medecinDashboard()
    {
        $medecin = auth()->user()->medecin;

        $stats = [
            'rdv_total' => RendezVous::where('medecin_id', $medecin->id)->count(),
            'rdv_aujourdhui' => RendezVous::where('medecin_id', $medecin->id)->whereDate('date_heure', today())->count(),
            'consultations' => Consultation::where('medecin_id', $medecin->id)->count(),
            'patients' => Consultation::where('medecin_id', $medecin->id)->distinct('patient_id')->count(),
        ];

        $rdvAujourdhui = RendezVous::with('patient')
            ->where('medecin_id', $medecin->id)
            ->whereDate('date_heure', today())
            ->get();

        return view('dashboard.medecin', compact('stats', 'rdvAujourdhui', 'medecin'));
    }
}