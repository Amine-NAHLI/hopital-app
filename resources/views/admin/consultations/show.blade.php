@extends('layouts.app')
@section('title', 'Détail Consultation')
@section('page-title', 'Détail de la Consultation')

@section('content')
    <div class="card">
        <div class="card-header text-white" style="background:#4527a0">
            <i class="bi bi-clipboard2-pulse"></i> Consultation #{{ $consultation->id }}
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="fw-bold border-bottom pb-2">Informations</h5>
                    <table class="table">
                        <tr>
                            <th>Patient</th>
                            <td>{{ $consultation->patient->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Médecin</th>
                            <td>{{ $consultation->medecin->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Prix</th>
                            <td><strong>{{ $consultation->prix }} DH</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold border-bottom pb-2">Médical</h5>
                    <div class="mb-3">
                        <strong>Diagnostic :</strong>
                        <p class="mt-1">{{ $consultation->diagnostic }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Traitement :</strong>
                        <p class="mt-1">{{ $consultation->traitement ?? '-' }}</p>
                    </div>
                    <div>
                        <strong>Notes :</strong>
                        <p class="mt-1">{{ $consultation->notes ?? '-' }}</p>
                    </div>
                </div>

                @if($consultation->ordonnance)
                    <div class="col-12">
                        <div class="alert alert-success">
                            <i class="bi bi-file-medical"></i> Une ordonnance a été créée pour cette consultation.
                            <a href="{{ route('admin.ordonnances.show', $consultation->ordonnance) }}"
                                class="btn btn-sm btn-success ms-2">Voir l'ordonnance</a>
                        </div>
                    </div>
                @endif

                @if($consultation->facture)
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="bi bi-receipt"></i> Facture : {{ $consultation->facture->numero_facture }}
                            — Statut :
                            <span class="badge bg-{{ $consultation->facture->statut === 'payee' ? 'success' : 'warning' }}">
                                {{ ucfirst($consultation->facture->statut) }}
                            </span>
                            <a href="{{ route('admin.factures.show', $consultation->facture) }}"
                                class="btn btn-sm btn-info ms-2 text-white">Voir la facture</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('admin.consultations.edit', $consultation) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
@endsection