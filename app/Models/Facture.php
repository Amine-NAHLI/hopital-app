<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'consultation_id',
        'patient_id',
        'numero_facture',
        'date_facture',
        'montant_total',
        'statut',
        'mode_paiement'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}