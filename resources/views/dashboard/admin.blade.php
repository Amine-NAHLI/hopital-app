@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Tableau de bord — Administrateur')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-2">
        <div class="stat-card" style="background: linear-gradient(135deg, #1a237e, #3949ab)">
            <div class="fs-2 fw-bold">{{ $stats['patients'] }}</div>
            <div class="small"><i class="bi bi-people"></i> Patients</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card" style="background: linear-gradient(135deg, #00796b, #009688)">
            <div class="fs-2 fw-bold">{{ $stats['medecins'] }}</div>
            <div class="small"><i class="bi bi-person-badge"></i> Médecins</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card" style="background: linear-gradient(135deg, #e65100, #f57c00)">
            <div class="fs-2 fw-bold">{{ $stats['rendez_vous'] }}</div>
            <div class="small"><i class="bi bi-calendar-check"></i> Rendez-vous</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card" style="background: linear-gradient(135deg, #4527a0, #7b1fa2)">
            <div class="fs-2 fw-bold">{{ $stats['consultations'] }}</div>
            <div class="small"><i class="bi bi-clipboard2-pulse"></i> Consultations</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card" style="background: linear-gradient(135deg, #c62828, #e53935)">
            <div class="fs-2 fw-bold">{{ $stats['factures'] }}</div>
            <div class="small"><i class="bi bi-receipt"></i> Factures</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card" style="background: linear-gradient(135deg, #2e7d32, #43a047)">
            <div class="fs-2 fw-bold">{{ number_format($stats['revenus'], 0) }} DH</div>
            <div class="small"><i class="bi bi-cash"></i> Revenus</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-calendar-day"></i> Rendez-vous d'aujourd'hui
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Médecin</th>
                            <th>Heure</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rdvAujourdhui as $rdv)
                        <tr>
                            <td>{{ $rdv->patient->nom_complet }}</td>
                            <td>{{ $rdv->medecin->nom_complet }}</td>
                            <td>{{ $rdv->date_heure->format('H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $rdv->statut === 'confirme' ? 'success' : ($rdv->statut === 'annule' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($rdv->statut) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                Aucun rendez-vous aujourd'hui
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="bi bi-clock-history"></i> Derniers rendez-vous
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Médecin</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rdvRecents as $rdv)
                        <tr>
                            <td>{{ $rdv->patient->nom_complet }}</td>
                            <td>{{ $rdv->medecin->nom_complet }}</td>
                            <td>{{ $rdv->date_heure->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $rdv->statut === 'confirme' ? 'success' : ($rdv->statut === 'annule' ? 'danger' : ($rdv->statut === 'termine' ? 'secondary' : 'warning')) }}">
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
@endsection