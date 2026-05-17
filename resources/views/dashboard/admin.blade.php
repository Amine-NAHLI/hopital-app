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

<div class="row g-4 mb-4">
    <!-- Planning du jour -->
    <div class="col-lg-8">
        <div class="card-nova h-100">
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

    <!-- Répartition RDV (Doughnut Chart) -->
    <div class="col-lg-4">
        <div class="card-nova h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-pie-chart me-2 text-primary"></i> Statuts RDV Hospitaliers</h4>
            </div>
            <div style="height: 250px;" class="d-flex justify-content-center align-items-center">
                <canvas id="rdvStatusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Évolution des Revenus (Line Chart) -->
    <div class="col-lg-8">
        <div class="card-nova h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-graph-up-arrow me-2 text-primary"></i> Analyse des Revenus Mensuels (DH)</h4>
            </div>
            <div style="height: 280px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Effectifs par Spécialité (Bar Chart) -->
    <div class="col-lg-4">
        <div class="card-nova h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-person-badge me-2 text-primary"></i> Spécialités Médicales</h4>
            </div>
            <div style="height: 280px;">
                <canvas id="specialityChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Activité Récente -->
    <div class="col-lg-12">
        <div class="card-nova">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-800 mb-0"><i class="bi bi-activity me-2 text-primary"></i> Activité Récente du Système</h4>
            </div>
            <div class="row">
                @foreach($rdvRecents as $rdv)
                    <div class="col-md-6 mb-3">
                        <div class="d-flex gap-3 align-items-center bg-light p-3 rounded-4">
                            <div class="flex-shrink-0">
                                <div class="p-2 rounded-4 bg-white shadow-sm">
                                    <i class="bi bi-calendar-plus text-primary fs-5"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 fw-700 text-dark small">Nouveau rendez-vous planifié pour <strong>{{ $rdv->patient->nom_complet }}</strong></p>
                                <span class="text-muted extra-small" style="font-size: 11px;">
                                    <i class="bi bi-clock me-1"></i> {{ $rdv->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Inclusion de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. Line Chart : Revenus ---
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        let gradientRevenue = ctxRevenue.createLinearGradient(0, 0, 0, 300);
        gradientRevenue.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Vert émeraude
        gradientRevenue.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthsData['labels']) !!},
                datasets: [{
                    label: 'Revenus (DH)',
                    data: {!! json_encode($monthsData['data']) !!},
                    borderColor: '#10b981',
                    backgroundColor: gradientRevenue,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#10b981',
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

        // --- 2. Doughnut Chart : Statut des RDV Globaux ---
        const ctxRDVStatus = document.getElementById('rdvStatusChart').getContext('2d');
        new Chart(ctxRDVStatus, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($rdvStats['labels']) !!},
                datasets: [{
                    data: {!! json_encode($rdvStats['data']) !!},
                    backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#ef4444'], // Vert, Indigo, Orange, Rouge
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 10, font: { family: 'Inter', size: 11 } } }
                }
            }
        });

        // --- 3. Bar Chart : Médecins par Spécialité ---
        const ctxSpeciality = document.getElementById('specialityChart').getContext('2d');
        new Chart(ctxSpeciality, {
            type: 'bar',
            data: {
                labels: {!! json_encode($specialityData['labels']) !!},
                datasets: [{
                    data: {!! json_encode($specialityData['data']) !!},
                    backgroundColor: '#8b5cf6', // Violet
                    borderRadius: 6,
                    barThickness: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(226, 232, 240, 0.6)', drawBorder: false }, ticks: { color: '#64748b', stepSize: 1 } },
                    x: { grid: { display: false, drawBorder: false }, ticks: { color: '#64748b', font: { size: 10 } } }
                }
            }
        });
    });
</script>
@endsection