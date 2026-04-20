<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HopitalApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a237e 0%, #283593 100%);
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }
        .sidebar .nav-link i { margin-right: 10px; width: 20px; }
        .sidebar-brand {
            color: white;
            font-size: 1.3rem;
            font-weight: bold;
            padding: 15px 20px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 15px;
            display: block;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .topbar {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            padding: 12px 20px;
            margin: -20px -20px 20px -20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .card-header { border-radius: 12px 12px 0 0 !important; font-weight: 600; }
        .stat-card { border-radius: 12px; padding: 20px; color: white; }
        .btn-primary { background: #1a237e; border-color: #1a237e; }
        .btn-primary:hover { background: #283593; border-color: #283593; }
        .badge-admin { background: #1a237e; }
        .badge-medecin { background: #00796b; }
        .alert { border-radius: 10px; }
        .table th { background: #f8f9fa; font-weight: 600; }
        .sidebar-section {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            padding: 10px 20px 5px;
            letter-spacing: 1px;
        }
    </style>
    @yield('styles')
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <a class="sidebar-brand" href="#">
        <i class="bi bi-hospital"></i> HopitalApp
    </a>

    <ul class="nav flex-column">
        @if(auth()->user()->isAdmin())
            <li><span class="sidebar-section">Tableau de bord</span></li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li><span class="sidebar-section">Gestion</span></li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}"
                   href="{{ route('admin.patients.index') }}">
                    <i class="bi bi-people"></i> Patients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.medecins.*') ? 'active' : '' }}"
                   href="{{ route('admin.medecins.index') }}">
                    <i class="bi bi-person-badge"></i> Médecins
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.rendez-vous.*') ? 'active' : '' }}"
                   href="{{ route('admin.rendez-vous.index') }}">
                    <i class="bi bi-calendar-check"></i> Rendez-vous
                </a>
            </li>

            <li><span class="sidebar-section">Médical</span></li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.consultations.*') ? 'active' : '' }}"
                   href="{{ route('admin.consultations.index') }}">
                    <i class="bi bi-clipboard2-pulse"></i> Consultations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.ordonnances.*') ? 'active' : '' }}"
                   href="{{ route('admin.ordonnances.index') }}">
                    <i class="bi bi-file-medical"></i> Ordonnances
                </a>
            </li>

            <li><span class="sidebar-section">Finances</span></li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.factures.*') ? 'active' : '' }}"
                   href="{{ route('admin.factures.index') }}">
                    <i class="bi bi-receipt"></i> Factures
                </a>
            </li>

        @else
            <li><span class="sidebar-section">Tableau de bord</span></li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('medecin.dashboard') ? 'active' : '' }}"
                   href="{{ route('medecin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li><span class="sidebar-section">Gestion</span></li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('medecin.patients.*') ? 'active' : '' }}"
                   href="{{ route('medecin.patients.index') }}">
                    <i class="bi bi-people"></i> Mes Patients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('medecin.rendez-vous.*') ? 'active' : '' }}"
                   href="{{ route('medecin.rendez-vous.index') }}">
                    <i class="bi bi-calendar-check"></i> Mes Rendez-vous
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('medecin.consultations.*') ? 'active' : '' }}"
                   href="{{ route('medecin.consultations.index') }}">
                    <i class="bi bi-clipboard2-pulse"></i> Consultations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('medecin.ordonnances.*') ? 'active' : '' }}"
                   href="{{ route('medecin.ordonnances.index') }}">
                    <i class="bi bi-file-medical"></i> Ordonnances
                </a>
            </li>
        @endif
    </ul>
</div>

{{-- Main Content --}}
<div class="main-content">
    <div class="topbar">
        <h5 class="mb-0">@yield('page-title', 'HopitalApp')</h5>
        <div class="d-flex align-items-center gap-3">
            <span class="badge {{ auth()->user()->isAdmin() ? 'badge-admin' : 'badge-medecin' }} text-white px-3 py-2">
                <i class="bi bi-person-circle"></i>
                {{ auth()->user()->name }}
                ({{ ucfirst(auth()->user()->role) }})
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>

    {{-- Messages de succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Messages d'erreur --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>