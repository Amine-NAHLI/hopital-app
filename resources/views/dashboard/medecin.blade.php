@extends('layouts.app')
@section('title', 'Dashboard Medecin')
@section('page-title', 'Tableau de bord — Dr. {{ $medecin->nom_complet }}')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #0f766e, #14b8a6)">
                <div class="fs-2 fw-bold">{{ $stats['rdv_total'] }}</div>
                <div class="small"><i class="bi bi-calendar"></i> Total Rendez-vous</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #d97706, #fbbf24)">
                <div class="fs-2 fw-bold">{{ $stats['rdv_aujourdhui'] }}</div>
                <div class="small"><i class="bi bi-calendar-day"></i> Aujourd'hui</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #7c3aed, #a78bfa)">
                <div class="fs-2 fw-bold">{{ $stats['consultations'] }}</div>
                <div class="small"><i class="bi bi-clipboard2-pulse"></i> Consultations</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: linear-gradient(135deg, #059669, #34d399)">
                <div class="fs-2 fw-bold">{{ $stats['patients'] }}</div>
                <div class="small"><i class="bi bi-people"></i> Patients suivis</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-calendar-day"></i> Mes rendez-vous d'aujourd'hui
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Heure</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rdvAujourdhui as $rdv)
                        <tr>
                            <td>{{ $rdv->patient->nom_complet }}</td>
                            <td>{{ $rdv->date_heure->format('H:i') }}</td>
                            <td>{{ $rdv->motif ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $rdv->statut === 'confirme' ? 'success' : 'warning' }}">
                                    {{ ucfirst($rdv->statut) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('medecin.rendez-vous.show', $rdv) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Aucun rendez-vous aujourd'hui
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection