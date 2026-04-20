<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'nom' => 'El Mansouri',
                'prenom' => 'Mohamed',
                'date_naissance' => '1985-03-15',
                'sexe' => 'homme',
                'telephone' => '0661234567',
                'email' => 'mohamed@gmail.com',
                'adresse' => '12 Rue Hassan II, Casablanca',
                'cin' => 'AB123456',
                'antecedents' => 'Diabète type 2',
            ],
            [
                'nom' => 'Benjelloun',
                'prenom' => 'Fatima',
                'date_naissance' => '1990-07-22',
                'sexe' => 'femme',
                'telephone' => '0662345678',
                'email' => 'fatima@gmail.com',
                'adresse' => '45 Avenue Mohammed V, Rabat',
                'cin' => 'CD234567',
                'antecedents' => 'Hypertension',
            ],
            [
                'nom' => 'Chraibi',
                'prenom' => 'Ahmed',
                'date_naissance' => '1978-11-30',
                'sexe' => 'homme',
                'telephone' => '0663456789',
                'email' => 'ahmed@gmail.com',
                'adresse' => '8 Rue Ibn Sina, Fès',
                'cin' => 'EF345678',
                'antecedents' => 'Aucun',
            ],
            [
                'nom' => 'Ouali',
                'prenom' => 'Nadia',
                'date_naissance' => '1995-01-10',
                'sexe' => 'femme',
                'telephone' => '0664567890',
                'email' => 'nadia@gmail.com',
                'adresse' => '23 Boulevard Zerktouni, Marrakech',
                'cin' => 'GH456789',
                'antecedents' => 'Asthme',
            ],
            [
                'nom' => 'Idrissi',
                'prenom' => 'Omar',
                'date_naissance' => '1970-05-18',
                'sexe' => 'homme',
                'telephone' => '0665678901',
                'email' => 'omar@gmail.com',
                'adresse' => '67 Rue Allal Ben Abdellah, Tanger',
                'cin' => 'IJ567890',
                'antecedents' => 'Cholestérol élevé',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}