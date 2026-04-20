<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medecin;

class MedecinSeeder extends Seeder
{
    public function run(): void
    {
        Medecin::create([
            'user_id' => 2,
            'nom' => 'Bennani',
            'prenom' => 'Karim',
            'specialite' => 'Cardiologie',
            'telephone' => '0661111111',
            'email' => 'karim@hopital.ma',
        ]);

        Medecin::create([
            'user_id' => 3,
            'nom' => 'Alami',
            'prenom' => 'Sara',
            'specialite' => 'Pédiatrie',
            'telephone' => '0662222222',
            'email' => 'sara@hopital.ma',
        ]);

        Medecin::create([
            'user_id' => 4,
            'nom' => 'Tazi',
            'prenom' => 'Youssef',
            'specialite' => 'Neurologie',
            'telephone' => '0663333333',
            'email' => 'youssef@hopital.ma',
        ]);
    }
}