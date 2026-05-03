<?php

/**
 * Migration : create_medecins_table
 * Description : Création de la table 'medecins'.
 * Rôle : Stocke les informations professionnelles des médecins, liées à un compte utilisateur.
 */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('specialite');
            $table->string('telephone');
            $table->string('email');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};