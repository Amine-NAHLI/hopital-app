<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RendezVous;

class RendezVousSeeder extends Seeder
{
    public function run(): void
    {
        $rdvs = [
            [
                'patient_id' => 1,
                'medecin_id' => 1,
                'date_heure' => '2026-04-21 09:00:00',
                'statut' => 'confirme',
                'motif' => 'Consultation cardiologie',
            ],
            [
                'patient_id' => 2,
                'medecin_id' => 2,
                'date_heure' => '2026-04-21 10:30:00',
                'statut' => 'en_attente',
                'motif' => 'Suivi pédiatrique',
            ],
            [
                'patient_id' => 3,
                'medecin_id' => 3,
                'date_heure' => '2026-04-22 14:00:00',
                'statut' => 'confirme',
                'motif' => 'Maux de tête persistants',
            ],
            [
                'patient_id' => 4,
                'medecin_id' => 1,
                'date_heure' => '2026-04-23 11:00:00',
                'statut' => 'termine',
                'motif' => 'Bilan annuel',
            ],
            [
                'patient_id' => 5,
                'medecin_id' => 2,
                'date_heure' => '2026-04-24 09:30:00',
                'statut' => 'annule',
                'motif' => 'Fièvre',
            ],
        ];

        foreach ($rdvs as $rdv) {
            RendezVous::create($rdv);
        }
    }
}