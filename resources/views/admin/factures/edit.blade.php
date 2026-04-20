@extends('layouts.app')
@section('title', 'Modifier Facture')
@section('page-title', 'Modifier Facture')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-pencil"></i> Modifier — {{ $facture->numero_facture }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.factures.update', $facture) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="impayee" {{ $facture->statut === 'impayee' ? 'selected' : '' }}>Impayée</option>
                            <option value="payee" {{ $facture->statut === 'payee' ? 'selected' : '' }}>Payée</option>
                            <option value="annulee" {{ $facture->statut === 'annulee' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mode de paiement</label>
                        <select name="mode_paiement" class="form-select">
                            <option value="">— Aucun —</option>
                            <option value="especes" {{ $facture->mode_paiement === 'especes' ? 'selected' : '' }}>Espèces
                            </option>
                            <option value="carte" {{ $facture->mode_paiement === 'carte' ? 'selected' : '' }}>Carte</option>
                            <option value="virement" {{ $facture->mode_paiement === 'virement' ? 'selected' : '' }}>Virement
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Mettre à jour
                    </button>
                    <a href="{{ route('admin.factures.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection