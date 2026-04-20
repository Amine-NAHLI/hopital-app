<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'rendez_vous_id',
        'patient_id',
        'medecin_id',
        'date_consultation',
        'diagnostic',
        'traitement',
        'notes',
        'prix'
    ];

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function ordonnance()
    {
        return $this->hasOne(Ordonnance::class);
    }

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
}