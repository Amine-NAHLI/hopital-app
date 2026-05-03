<?php

/**
 * Fichier : RendezVous.php
 * Description : Modèle de données pour les rendez-vous.
 * Rôle : Gère le planning et le statut des rendez-vous entre médecins et patients.
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendez_vous';

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'date_heure',
        'statut',
        'motif'
    ];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }
}