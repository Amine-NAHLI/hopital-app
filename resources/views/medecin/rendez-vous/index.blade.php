@extends('layouts.app')
@section('title', 'Mes Rendez-vous')
@section('page-title', 'Agenda Praticien')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-secondary">Mes Consultations Planifiées</h4>
                <p class="text-muted small mb-0">Vue d'ensemble de vos rendez-vous patients</p>
            </div>
            <div class="d-flex gap-2">
                <span class="badge bg-primary px-3 py-2 rounded-pill">
                    {{ $rendezVous->total() }} RDV au total
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Patient</th>
                            <th>Date & Heure</th>
                            <th>Motif</th>
                            <th>Statut</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rendezVous as $rdv)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold text-primary" 
                                             style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($rdv->patient->prenom, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $rdv->patient->nom_complet }}</div>
                                            <span class="text-muted x-small">CIN: {{ $rdv->patient->cin }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge bg-light text-dark border fw-medium px-3 py-2">
                                        <i class="bi bi-clock text-primary me-2"></i>
                                        {{ $rdv->date_heure->format('d/m/Y H:i') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted small">{{ Str::limit($rdv->motif, 40) }}</span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'en_attente' => 'bg-warning',
                                            'confirme' => 'bg-success',
                                            'annule' => 'bg-danger',
                                            'termine' => 'bg-info text-white'
                                        ][$rdv->statut] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge rounded-pill {{ $statusClass }} px-3 py-2 shadow-sm">
                                        {{ ucfirst($rdv->statut) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('medecin.patients.show', $rdv->patient) }}" class="btn btn-sm btn-outline-primary" title="Dossier Patient">
                                            <i class="bi bi-person-bounding-box"></i>
                                        </a>
                                        @if($rdv->statut === 'confirme')
                                            <a href="{{ route('medecin.consultations.create', ['rendez_vous_id' => $rdv->id]) }}" 
                                               class="btn btn-sm btn-primary" title="Démarrer Consultation">
                                                <i class="bi bi-play-fill"></i> Consulter
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted py-4">
                                        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                        Aucun rendez-vous à afficher.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($rendezVous->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $rendezVous->links() }}
            </div>
        @endif
    </div>
@endsection
