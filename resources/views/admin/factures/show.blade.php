@extends('layouts.app')
@section('title', 'Facture')
@section('page-title', 'Détail Facture')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-receipt"></i> {{ $facture->numero_facture }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Patient</th>
                            <td>{{ $facture->patient->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Médecin</th>
                            <td>{{ $facture->consultation->medecin->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Montant</th>
                            <td><strong class="fs-5">{{ $facture->montant_total }} DH</strong></td>
                        </tr>
                        <tr>
                            <th>Statut</th>
                            <td>
                                <span
                                    class="badge fs-6 bg-{{ $facture->statut === 'payee' ? 'success' : ($facture->statut === 'annulee' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($facture->statut) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Mode paiement</th>
                            <td>{{ $facture->mode_paiement ? ucfirst($facture->mode_paiement) : '—' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.factures.edit', $facture) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Modifier statut
                </a>
                <a href="{{ route('admin.factures.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
@endsection