<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consultation;
use App\Models\Ordonnance;
use App\Models\Facture;

class ConsultationSeeder extends Seeder
{
    public function run(): void
    {
        $consultation = Consultation::create([
            'rendez_vous_id' => 4,
            'patient_id' => 4,
            'medecin_id' => 1,
            'date_consultation' => '2026-04-23',
            'diagnostic' => 'Tension artérielle élevée',
            'traitement' => 'Repos et médicaments',
            'notes' => 'Patient à revoir dans 1 mois',
            'prix' => 200.00,
        ]);

        Ordonnance::create([
            'consultation_id' => $consultation->id,
            'patient_id' => 4,
            'medecin_id' => 1,
            'date_ordonnance' => '2026-04-23',
            'medicaments' => "Amlodipine 5mg - 1 comprimé/jour\nAspégic 100mg - 1 comprimé/jour",
            'instructions' => 'Prendre le matin avec de l\'eau. Éviter le sel.',
        ]);

        Facture::create([
            'consultation_id' => $consultation->id,
            'patient_id' => 4,
            'numero_facture' => 'FACT-2026-001',
            'date_facture' => '2026-04-23',
            'montant_total' => 200.00,
            'statut' => 'payee',
            'mode_paiement' => 'especes',
        ]);
    }
}