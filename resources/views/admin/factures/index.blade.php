@extends('layouts.app')
@section('title', 'Facturation')
@section('page-title', 'Comptabilité & Facturation')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-bottom">
            <div>
                <h4 class="mb-0 fw-bold text-secondary">Journal de Facturation</h4>
                <p class="text-muted small mb-0">Suivi des paiements et règlements des patients</p>
            </div>
            <div class="d-flex gap-2">
                <div class="badge bg-success-light text-success px-3 py-2 border" style="background: #f0fdf4; color: #16a34a">
                    <i class="bi bi-wallet2 me-1"></i> Total Encaissé
                </div>
            </div>
        </div>
        <div class="card-body px-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="bg-light">
                            <th class="ps-4">Référence</th>
                            <th>Patient</th>
                            <th>Date Facture</th>
                            <th>Montant Total</th>
                            <th>État du Paiement</th>
                            <th>Mode</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($factures as $f)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-dark text-white rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                             style="width:28px; height:28px; font-size: 0.65rem;">
                                            <i class="bi bi-hash"></i>
                                        </div>
                                        <span class="fw-bold text-secondary">{{ $f->numero_facture }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $f->patient->nom_complet }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ \Carbon\Carbon::parse($f->date_facture)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark fs-6">{{ number_format($f->montant_total, 2, '.', ' ') }} <small class="text-muted">DH</small></span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'payee' => 'bg-success',
                                            'annulee' => 'bg-danger',
                                            'en_attente' => 'bg-warning'
                                        ][$f->statut] ?? 'bg-primary';
                                        
                                        $statusLabel = [
                                            'payee' => 'Réglée',
                                            'annulee' => 'Annulée',
                                            'en_attente' => 'En attente'
                                        ][$f->statut] ?? ucfirst($f->statut);
                                    @endphp
                                    <span class="badge rounded-pill {{ $statusClass }} px-3 py-2 shadow-sm">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td>
                                    @if($f->mode_paiement)
                                        <span class="badge bg-light text-dark border fw-normal px-2 py-1">
                                            <i class="bi bi-credit-card me-1 text-muted"></i> {{ ucfirst($f->mode_paiement) }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group shadow-sm rounded">
                                        <a href="{{ route('admin.factures.show', $f) }}" class="btn btn-sm btn-white border" title="Imprimer/Voir">
                                            <i class="bi bi-printer-fill text-dark"></i>
                                        </a>
                                        <a href="{{ route('admin.factures.edit', $f) }}" class="btn btn-sm btn-white border" title="Modifier">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.factures.destroy', $f) }}" class="d-inline"
                                              onsubmit="return confirm('Confirmer la suppression de cette facture ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-white border" title="Supprimer">
                                                <i class="bi bi-trash3-fill text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted py-4">
                                        <i class="bi bi-cash-stack fs-1 d-block mb-2"></i>
                                        Aucune transaction enregistrée.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $factures->links() }}
            </div>
        </div>
    </div>
@endsection