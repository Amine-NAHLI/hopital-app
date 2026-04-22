@extends('layouts.app')
@section('title', 'Ordonnances')
@section('page-title', 'Mes Prescriptions')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-secondary">Archives des Ordonnances</h4>
                <p class="text-muted small mb-0">Liste des prescriptions que vous avez émises</p>
            </div>
            <a href="{{ route('medecin.ordonnances.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-file-earmark-medical me-2"></i> Rédiger une Ordonnance
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Référence</th>
                            <th>Patient</th>
                            <th>Date d'émission</th>
                            <th>Médicaments</th>
                            <th class="text-end pe-4">Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ordonnances as $o)
                            <tr>
                                <td class="ps-4">
                                    <span class="text-muted small fw-bold">#ORD-{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $o->patient->nom_complet }}</div>
                                    <span class="text-muted small">CIN: {{ $o->patient->cin }}</span>
                                </td>
                                <td>
                                    <span class="text-dark small">
                                        <i class="bi bi-calendar3 me-1 text-primary"></i>
                                        {{ \Carbon\Carbon::parse($o->date_ordonnance)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted small" title="{{ $o->medicaments }}">
                                        {{ Str::limit($o->medicaments, 45) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    @if($o->fichier)
                                        <a href="{{ asset('storage/' . $o->fichier) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-file-pdf"></i> PDF
                                        </a>
                                    @else
                                        <span class="badge bg-light text-muted fw-normal border">Aucun scan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted py-4">
                                        <i class="bi bi-file-earmark-medical fs-1 d-block mb-2"></i>
                                        Vous n'avez pas encore émis d'ordonnance.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($ordonnances->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $ordonnances->links() }}
            </div>
        @endif
    </div>
@endsection
