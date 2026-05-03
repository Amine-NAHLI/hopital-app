<?php

/**
 * Seeder : DatabaseSeeder.php
 * Description : Classe principale de peuplement de la base de données.
 * Rôle : Appelle les autres seeders pour initialiser le système avec des données de test.
 */


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PatientSeeder::class,
            MedecinSeeder::class,
            RendezVousSeeder::class,
            ConsultationSeeder::class,
        ]);
    }
}