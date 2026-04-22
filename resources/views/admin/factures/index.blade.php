@extends('layouts.app')
@section('title', 'Factures')
@section('page-title', 'Gestion des Factures')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-receipt"></i> Liste des Factures</span>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($factures as $f)
                        <tr>
                            <td><strong>{{ $f->numero_facture }}</strong></td>
                            <td>{{ $f->patient->nom_complet }}</td>
                            <td>{{ \Carbon\Carbon::parse($f->date_facture)->format('d/m/Y') }}</td>
                            <td><strong>{{ $f->montant_total }} DH</strong></td>
                            <td>
                                <span
                                    class="badge bg-{{ $f->statut === 'payee' ? 'success' : ($f->statut === 'annulee' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($f->statut) }}
                                </span>
                            </td>
                            <td>{{ $f->mode_paiement ? ucfirst($f->mode_paiement) : '—' }}</td>
                            <td>
                                <a href="{{ route('admin.factures.show', $f) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.factures.edit', $f) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.factures.destroy', $f) }}" class="d-inline"
                                    onsubmit="return confirm('Supprimer cette facture ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucune facture.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $factures->links() }}
        </div>
    </div>
@endsection