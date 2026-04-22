@extends('layouts.app')
@section('title', 'Dashboard Medecin')
@section('page-title', 'Espace Praticien — Dr. {{ $medecin->nom_complet }}')

@section('content')
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-bg-rdv">
                <i class="bi bi-calendar-event stat-icon"></i>
                <div class="stat-value">{{ $stats['rdv_total'] }}</div>
                <div class="stat-label">Total Rendez-vous</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-bg-patients">
                <i class="bi bi-person-check stat-icon"></i>
                <div class="stat-value">{{ $stats['rdv_aujourdhui'] }}</div>
                <div class="stat-label">Aujourd'hui</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-bg-consultations">
                <i class="bi bi-heart-pulse stat-icon"></i>
                <div class="stat-value">{{ $stats['consultations'] }}</div>
                <div class="stat-label">Consultations</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-bg-medecins">
                <i class="bi bi-people stat-icon"></i>
                <div class="stat-value">{{ $stats['patients'] }}</div>
                <div class="stat-label">Patients suivis</div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-secondary">
                    <i class="bi bi-calendar2-check text-primary me-2"></i>
                    Mes rendez-vous du jour
                </h5>
                <span class="badge bg-primary-light text-primary px-3 py-2">
                    {{ now()->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="bg-light">
                            <th class="ps-4">Patient</th>
                            <th>Heure</th>
                            <th>Motif</th>
                            <th>Statut</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rdvAujourdhui as $rdv)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3 bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width:35px; height:35px; font-size: 0.8rem;">
                                            {{ strtoupper(substr($rdv->patient->nom_complet, 0, 1)) }}
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $rdv->patient->nom_complet }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted fw-medium">
                                        <i class="bi bi-clock me-1"></i> {{ $rdv->date_heure->format('H:i') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                        {{ $rdv->motif ?? 'Consultation standard' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill {{ $rdv->statut === 'confirme' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($rdv->statut) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('medecin.rendez-vous.show', $rdv) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                        Aucun rendez-vous pour aujourd'hui
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection