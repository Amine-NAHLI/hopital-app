<?php

/**
 * Fichier : Medecin.php
 * Description : Modèle de données pour les médecins.
 * Rôle : Représente un médecin et définit ses relations avec les utilisateurs, spécialités et consultations.
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'specialite',
        'telephone',
        'email',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function ordonnances()
    {
        return $this->hasMany(Ordonnance::class);
    }

    public function getNomCompletAttribute(): string
    {
        return 'Dr. ' . $this->prenom . ' ' . $this->nom;
    }
}