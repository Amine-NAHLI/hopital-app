<?php

/**
 * Fichier : Ordonnance.php
 * Description : Modèle de données pour les ordonnances.
 * Rôle : Gère les informations des ordonnances prescrites aux patients.
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    protected $fillable = [
        'consultation_id',
        'patient_id',
        'medecin_id',
        'date_ordonnance',
        'medicaments',
        'instructions',
        'fichier'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}