<?php

/**
 * Migration : create_patients_table
 * Description : Création de la table 'patients'.
 * Rôle : Définit les colonnes pour stocker les informations personnelles, le numéro de sécurité sociale et les antécédents des patients.
 */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->enum('sexe', ['homme', 'femme']);
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->text('adresse');
            $table->string('cin')->unique();
            $table->string('photo')->nullable();
            $table->text('antecedents')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};