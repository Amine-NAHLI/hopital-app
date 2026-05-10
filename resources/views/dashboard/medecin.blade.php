{{--
    Fichier : medecin.blade.php
    Description : Tableau de bord Nova Médecin.
--}}
@extends('layouts.app')
@section('title', 'MediCore Nova — Espace Praticien')

@section('content')
<div class="page-header-nova">
    <div>
        <h1>Bienvenue, <span class="text-primary">Dr. {{ $medecin->nom_complet }}</span></h1>
        <p class="text-muted mb-0">Voici un aperçu de votre activité pour aujourd'hui.</p>
    </div>
    <div class="d-flex gap-3">
        <a href="{{ route('medecin.rendez-vous.index') }}" class="btn-nova btn-nova-primary">
            <i class="bi bi-calendar-event"></i> Mon Agenda
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    @php
        $med_stats = [
            ['label' => 'Total Rendez-vous', 'value' => $stats['rdv_total'], 'icon' => 'bi-calendar-check', 'color' => '#6366f1'],
            ['label' => 'Aujourd\'hui', 'value' => $stats['rdv_aujourdhui'], 'icon' => 'bi-clock-history', 'color' => '#0ea5e9'],
            ['label' => 'Consultations', 'value' => $stats['consultations'], 'icon' => 'bi-clipboard2-pulse', 'color' => '#8b5cf6'],
            ['label' => 'Patients Uniques', 'value' => $stats['patients'], 'icon' => 'bi-people', 'color' => '#10b981'],
        ];
    @endphp

    @foreach($med_stats as $item)
        <div class="col-xl-3 col-md-6">
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
    <div class="col-lg-12">
        <div class="card-nova">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-clock me-2 text-primary"></i> Patients attendus aujourd'hui</h4>
            </div>
            <div class="table-responsive">
                <table class="table-nova">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Heure</th>
                            <th>Motif / Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rdvAujourdhui as $rdv)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-nova" style="width: 36px; height: 36px;">{{ substr($rdv->patient->nom_complet, 0, 1) }}</div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-700">{{ $rdv->patient->nom_complet }}</span>
                                        <span class="text-muted small">ID: #PT-{{ $rdv->patient->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-800 text-primary">{{ $rdv->date_heure->format('H:i') }}</span>
                            </td>
                            <td>
                                <span class="badge-nova @if($rdv->statut === 'confirme') bg-success-subtle text-success @else bg-warning-subtle text-warning @endif">
                                    {{ ucfirst($rdv->statut) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('medecin.consultations.create', ['patient_id' => $rdv->patient_id, 'rendez_vous_id' => $rdv->id]) }}" class="btn-nova btn-nova-primary py-2 px-3 fs-7">
                                    Démarrer la consultation
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-check fs-2 d-block mb-3 opacity-25"></i>
                                Aucun rendez-vous prévu pour aujourd'hui.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection