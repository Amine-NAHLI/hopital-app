@extends('layouts.app')
@section('title', 'Consultations')
@section('page-title', 'Rapports de Consultations')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-secondary">Journal des Consultations</h4>
                <p class="text-muted small mb-0">Historique complet des diagnostics et soins médicaux</p>
            </div>
            <a href="{{ route('admin.consultations.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Enregistrer une Consultation
            </a>
        </div>
        <div class="card-body px-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="bg-light">
                            <th class="ps-4">ID</th>
                            <th>Patient bénéficiaire</th>
                            <th>Praticien responsable</th>
                            <th>Date de soin</th>
                            <th>Aperçu Diagnostic</th>
                            <th>Honoraires</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consultations as $c)
                            <tr>
                                <td class="ps-4">
                                    <span class="text-muted small fw-bold">#CONS-{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $c->patient->nom_complet }}</div>
                                    <span class="text-muted x-small" style="font-size: 0.75rem;">CIN: {{ $c->patient->cin }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-purple-light text-purple rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                             style="width:30px; height:30px; font-size: 0.75rem; background: #f5f3ff; color: #7c3aed;">
                                            <i class="bi bi-clipboard2-pulse-fill"></i>
                                        </div>
                                        <span class="fw-medium text-secondary">Dr. {{ $c->medecin->nom_complet }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge bg-light text-dark border fw-medium px-3 py-2">
                                        <i class="bi bi-calendar3 text-primary me-2"></i>
                                        {{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td>
                                    <p class="text-muted small mb-0 fst-italic" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $c->diagnostic }}
                                    </p>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">{{ number_format($c->prix, 2, '.', ' ') }} DH</span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.consultations.show', $c) }}" class="btn btn-sm btn-outline-info" title="Voir rapport">
                                            <i class="bi bi-file-earmark-text-fill"></i>
                                        </a>
                                        <a href="{{ route('admin.consultations.edit', $c) }}" class="btn btn-sm btn-outline-warning" title="Éditer">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.consultations.destroy', $c) }}" class="d-inline"
                                              onsubmit="return confirm('Confirmer la suppression de cet enregistrement ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted py-4">
                                        <i class="bi bi-clipboard-x fs-1 d-block mb-2"></i>
                                        Aucune consultation n'a été enregistrée pour le moment.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $consultations->links() }}
            </div>
        </div>
    </div>
@endsection