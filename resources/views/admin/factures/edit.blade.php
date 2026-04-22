@extends('layouts.app')
@section('title', 'Modifier Facture')
@section('page-title', 'Mise à jour Comptable')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background: #fefce8; color: #854d0e;">
                        <i class="bi bi-receipt-cutoff fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-dark">Règlement de Facture</h4>
                        <p class="text-muted small mb-0">Pièce n° {{ $facture->numero_facture }}</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="bg-light p-3 rounded-3 mb-4 d-flex justify-content-between align-items-center border">
                        <div>
                            <span class="text-muted small d-block">Montant à régler</span>
                            <span class="fs-4 fw-bold text-dark">{{ number_format($facture->montant_total, 2) }} DH</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted small d-block">Patient</span>
                            <span class="fw-bold text-secondary">{{ $facture->patient->nom_complet }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.factures.update', $facture) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Statut de paiement <span class="text-danger">*</span></label>
                                <select name="statut" class="form-select form-select-lg @error('statut') is-invalid @enderror">
                                    <option value="impayee" {{ old('statut', $facture->statut) === 'impayee' ? 'selected' : '' }}>En attente (Impayée)</option>
                                    <option value="payee" {{ old('statut', $facture->statut) === 'payee' ? 'selected' : '' }}>Réglée (Payée)</option>
                                    <option value="annulee" {{ old('statut', $facture->statut) === 'annulee' ? 'selected' : '' }}>Annulée / Avoir</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Mode de règlement</label>
                                <div class="row g-3">
                                    @foreach(['especes' => 'Espèces', 'carte' => 'Carte Bancaire', 'virement' => 'Virement'] as $val => $lab)
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="mode_paiement" id="mode_{{ $val }}" value="{{ $val }}" 
                                                {{ old('mode_paiement', $facture->mode_paiement) === $val ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary w-100 py-3 d-flex flex-column align-items-center gap-2" for="mode_{{ $val }}">
                                                <i class="bi bi-{{ $val === 'especes' ? 'cash' : ($val === 'carte' ? 'credit-card' : 'bank') }} fs-4"></i>
                                                <span class="small fw-bold">{{ $lab }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.factures.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-warning px-5 shadow text-white fw-bold">
                                <i class="bi bi-check2-circle me-2"></i> Valider le règlement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection