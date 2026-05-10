{{--
    Fichier : admin.blade.php
    Description : Tableau de bord Nova Admin.
--}}
@extends('layouts.app')
@section('title', 'MediCore Nova — Dashboard Admin')

@section('content')
<div class="page-header-nova">
    <div>
        <h1>Vue d'ensemble <span class="text-primary">Hospitalière</span></h1>
        <p class="text-muted mb-0">Bienvenue dans l'interface de contrôle MediCore Nova.</p>
    </div>
    <div class="d-flex gap-3">
        <button class="btn-nova btn-nova-primary">
            <i class="bi bi-plus-lg"></i> Nouveau Patient
        </button>
    </div>
</div>

<div class="row g-4 mb-5">
    @php
        $stat_items = [
            ['label' => 'Patients', 'value' => $stats['patients'], 'icon' => 'bi-people', 'color' => '#6366f1'],
            ['label' => 'Médecins', 'value' => $stats['medecins'], 'icon' => 'bi-person-badge', 'color' => '#0ea5e9'],
            ['label' => 'Rendez-vous', 'value' => $stats['rendez_vous'], 'icon' => 'bi-calendar-check', 'color' => '#f59e0b'],
            ['label' => 'Consultations', 'value' => $stats['consultations'], 'icon' => 'bi-clipboard2-pulse', 'color' => '#8b5cf6'],
            ['label' => 'Factures', 'value' => $stats['factures'], 'icon' => 'bi-receipt', 'color' => '#ec4899'],
            ['label' => 'Revenus (DH)', 'value' => number_format($stats['revenus'], 0, '.', ' '), 'icon' => 'bi-cash-stack', 'color' => '#10b981'],
        ];
    @endphp

    @foreach($stat_items as $item)
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card-nova">
                <div class="stat-icon-nova" style="background: {{ $item['color'] }}15; color: {{ $item['color'] }};">
                    <i class="bi {{ $item['icon'] }}"></i>
                </div>
                <h3 class="fw-800 mb-1" style="font-family: 'Sora', sans-serif;">{{ $item['value'] }}</h3>
                <span class="text-muted small fw-700 text-uppercase letter-spacing-1">{{ $item['label'] }}</span>
            </div>
        </div>
    @endforeach
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card-nova">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-calendar2-week me-2 text-primary"></i> Planning du jour</h4>
                <a href="{{ route('admin.rendez-vous.index') }}" class="text-primary small fw-700 text-decoration-none">Voir tout <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table-nova">
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
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-nova" style="width: 32px; height: 32px; font-size: 0.7rem;">{{ substr($rdv->patient->nom_complet, 0, 1) }}</div>
                                    <span class="fw-700">{{ $rdv->patient->nom_complet }}</span>
                                </div>
                            </td>
                            <td><span class="text-muted small">Dr.</span> {{ $rdv->medecin->nom_complet }}</td>
                            <td>
                                <span class="badge bg-light text-dark fw-700 p-2 px-3 rounded-pill border border-light">
                                    {{ $rdv->date_heure->format('H:i') }}
                                </span>
                            </td>
                            <td class="text-end">
                                <span class="badge-nova @if($rdv->statut === 'confirme') bg-success-subtle text-success @elseif($rdv->statut === 'annule') bg-danger-subtle text-danger @else bg-warning-subtle text-warning @endif">
                                    {{ ucfirst($rdv->statut) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Aucun rendez-vous pour aujourd'hui.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card-nova">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-activity me-2 text-primary"></i> Activité Récente</h4>
            </div>
            <div class="activity-timeline">
                @foreach($rdvRecents as $rdv)
                    <div class="d-flex gap-3 mb-4">
                        <div class="flex-shrink-0">
                            <div class="p-2 rounded-4 bg-light">
                                <i class="bi bi-chat-left-text text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1 fw-700 small">Nouveau rendez-vous pour <strong>{{ $rdv->patient->nom_complet }}</strong></p>
                            <span class="text-muted extra-small" style="font-size: 11px;">
                                <i class="bi bi-clock me-1"></i> {{ $rdv->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="btn w-100 bg-light fw-700 text-muted mt-3 py-3 border-0" style="border-radius: 16px;">
                Afficher l'historique complet
            </button>
        </div>
    </div>
</div>
@endsection