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
    <!-- Patients Attendus (Table) -->
    <div class="col-lg-8">
        <div class="card-nova h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-clock me-2 text-primary"></i> Patients attendus aujourd'hui</h4>
            </div>
            <div class="table-responsive">
                <table class="table-nova">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Heure</th>
                            <th>Statut</th>
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
                                <a href="{{ route('medecin.consultations.create', ['patient_id' => $rdv->patient_id, 'rendez_vous_id' => $rdv->id]) }}" class="btn-nova btn-nova-primary py-1 px-2 fs-7">
                                    Démarrer
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

    <!-- Statut des RDV (Doughnut Chart) -->
    <div class="col-lg-4">
        <div class="card-nova h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-pie-chart me-2 text-primary"></i> Statuts RDV</h4>
            </div>
            <div style="height: 250px; position: relative;" class="d-flex justify-content-center align-items-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <!-- Activité (Line Chart) -->
    <div class="col-lg-7">
        <div class="card-nova h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-graph-up-arrow me-2 text-primary"></i> Activité de la Semaine</h4>
            </div>
            <div style="height: 280px;">
                <canvas id="activityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Motifs (Bar Chart) -> Devenu Volume d'activité -->
    <div class="col-lg-5">
        <div class="card-nova h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-bar-chart-steps me-2 text-primary"></i> Volume d'Activité</h4>
            </div>
            <div style="height: 280px;">
                <canvas id="motifsChart"></canvas>
            </div>
        </div>
    </div><!-- Inclusion de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. Line Chart : Activité de la semaine ---
        const ctxActivity = document.getElementById('activityChart').getContext('2d');
        let gradientActivity = ctxActivity.createLinearGradient(0, 0, 0, 300);
        gradientActivity.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
        gradientActivity.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

        new Chart(ctxActivity, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Consultations',
                    data: {!! json_encode($chartData['data']) !!},
                    borderColor: '#6366f1',
                    backgroundColor: gradientActivity,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#6366f1',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(226, 232, 240, 0.6)', drawBorder: false }, ticks: { color: '#64748b' } },
                    x: { grid: { display: false, drawBorder: false }, ticks: { color: '#64748b' } }
                }
            }
        });

        // --- 2. Doughnut Chart : Statut des RDV ---
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartStatus['labels']) !!},
                datasets: [{
                    data: {!! json_encode($chartStatus['data']) !!},
                    backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#ef4444'], // Vert (Terminé), Indigo (Confirmé), Orange (En attente), Rouge (Annulé)
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { family: 'Inter', size: 12 } } }
                }
            }
        });

        // --- 3. Bar Chart : Volume d'Activité ---
        const ctxMotifs = document.getElementById('motifsChart').getContext('2d');
        new Chart(ctxMotifs, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartMotifs['labels']) !!},
                datasets: [{
                    label: 'Nombre total émis',
                    data: {!! json_encode($chartMotifs['data']) !!},
                    backgroundColor: '#0ea5e9',
                    borderRadius: 6,
                    barThickness: 24
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(226, 232, 240, 0.6)', drawBorder: false }, ticks: { color: '#64748b' } },
                    x: { grid: { display: false, drawBorder: false }, ticks: { color: '#64748b', font: { size: 11 } } }
                }
            }
        });
    });
</script>
@endsection