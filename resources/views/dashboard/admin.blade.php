@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Vue d\'ensemble Hospitalière')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card stat-bg-patients">
            <i class="bi bi-people stat-icon"></i>
            <div class="stat-value">{{ $stats['patients'] }}</div>
            <div class="stat-label">Patients</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card stat-bg-medecins">
            <i class="bi bi-person-badge stat-icon"></i>
            <div class="stat-value">{{ $stats['medecins'] }}</div>
            <div class="stat-label">Médecins</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card stat-bg-rdv">
            <i class="bi bi-calendar-check stat-icon"></i>
            <div class="stat-value">{{ $stats['rendez_vous'] }}</div>
            <div class="stat-label">Rendez-vous</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card stat-bg-consultations">
            <i class="bi bi-clipboard2-pulse stat-icon"></i>
            <div class="stat-value">{{ $stats['consultations'] }}</div>
            <div class="stat-label">Consultations</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card stat-bg-factures">
            <i class="bi bi-receipt stat-icon"></i>
            <div class="stat-value">{{ $stats['factures'] }}</div>
            <div class="stat-label">Factures</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card stat-bg-revenus">
            <i class="bi bi-cash-stack stat-icon"></i>
            <div class="stat-value">{{ number_format($stats['revenus'], 0, '.', ' ') }}</div>
            <div class="stat-label">DH Revenus</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-calendar2-week"></i> Planning du jour
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Médecin</th>
                                <th>Heure</th>
                                <th class="text-end">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rdvAujourdhui as $rdv)
                            <tr>
                                <td class="fw-bold text-secondary">{{ $rdv->patient->nom_complet }}</td>
                                <td><span class="text-muted">Dr.</span> {{ $rdv->medecin->nom_complet }}</td>
                                <td>
                                    <div class="badge bg-light text-dark border">
                                        <i class="bi bi-clock me-1"></i> {{ $rdv->date_heure->format('H:i') }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="badge rounded-pill @if($rdv->statut === 'confirme') bg-success @elseif($rdv->statut === 'annule') bg-danger @else bg-warning @endif">
                                        {{ ucfirst($rdv->statut) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-calendar-x d-block fs-2 mb-2"></i>
                                    Aucun rendez-vous planifié aujourd'hui
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-clock-history"></i> Flux d'activité récent
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Médecin</th>
                                <th>Date</th>
                                <th class="text-end">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rdvRecents as $rdv)
                            <tr>
                                <td class="fw-bold text-secondary">{{ $rdv->patient->nom_complet }}</td>
                                <td>Dr. {{ $rdv->medecin->nom_complet }}</td>
                                <td>{{ $rdv->date_heure->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <span class="badge rounded-pill @if($rdv->statut === 'confirme' || $rdv->statut === 'termine') bg-success @elseif($rdv->statut === 'annule') bg-danger @else bg-warning @endif">
                                        {{ ucfirst($rdv->statut) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection