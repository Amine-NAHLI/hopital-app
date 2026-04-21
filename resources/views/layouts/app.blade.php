<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MediCore') — Système Hospitalier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================================================================
           DESIGN TOKENS — MediCore Professional Theme
        ================================================================ */
        :root {
            --primary:        #0d6efd;
            --primary-dark:   #0a58ca;
            --primary-light:  #e8f0fe;
            --sidebar-bg:     #0f1923;
            --sidebar-hover:  rgba(255,255,255,0.07);
            --sidebar-active: rgba(13,110,253,0.18);
            --sidebar-border: rgba(255,255,255,0.06);
            --sidebar-text:   rgba(255,255,255,0.65);
            --sidebar-text-h: #ffffff;
            --sidebar-accent: #3b9eff;
            --topbar-bg:      #ffffff;
            --topbar-border:  #e9ecef;
            --body-bg:        #f1f4f8;
            --card-bg:        #ffffff;
            --card-border:    #e9ecef;
            --card-shadow:    0 1px 4px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.04);
            --text-primary:   #0f1923;
            --text-secondary: #6c757d;
            --text-muted:     #adb5bd;
            --radius-sm:      6px;
            --radius-md:      10px;
            --radius-lg:      14px;
            --sidebar-w:      260px;
            --topbar-h:       62px;
            --transition:     all 0.22s ease;
        }

        /* ================================================================
           RESET & BASE
        ================================================================ */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--body-bg);
            color: var(--text-primary);
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
        }

        /* ================================================================
           SIDEBAR
        ================================================================ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 200;
            overflow: hidden;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 22px;
            height: var(--topbar-h);
            border-bottom: 1px solid var(--sidebar-border);
            text-decoration: none;
            flex-shrink: 0;
        }

        .sidebar-brand-icon {
            width: 34px; height: 34px;
            background: var(--primary);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-brand-icon i {
            font-size: 17px;
            color: #fff;
        }

        .sidebar-brand-name {
            font-size: 1rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.3px;
        }

        .sidebar-brand-sub {
            font-size: 0.625rem;
            color: var(--sidebar-text);
            font-weight: 500;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            display: block;
            line-height: 1;
        }

        /* Nav scroll area */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 14px 0;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.08) transparent;
        }

        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        /* Section label */
        .sidebar-section {
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--sidebar-text);
            padding: 16px 22px 6px;
            opacity: 0.55;
        }

        /* Nav links */
        .sidebar-nav .nav-item { padding: 0 10px; margin-bottom: 2px; }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px 14px;
            border-radius: var(--radius-md);
            color: var(--sidebar-text);
            font-weight: 500;
            font-size: 0.8375rem;
            transition: var(--transition);
            text-decoration: none;
            position: relative;
        }

        .sidebar-nav .nav-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .sidebar-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-h);
        }

        .sidebar-nav .nav-link.active {
            background: var(--sidebar-active);
            color: var(--sidebar-accent);
        }

        .sidebar-nav .nav-link.active i {
            color: var(--sidebar-accent);
        }

        .sidebar-nav .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            border-radius: 0 3px 3px 0;
            background: var(--sidebar-accent);
            margin-left: -4px;
        }

        /* Sidebar footer */
        .sidebar-footer {
            border-top: 1px solid var(--sidebar-border);
            padding: 14px 10px;
            flex-shrink: 0;
        }

        .sidebar-footer-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: var(--radius-md);
            cursor: default;
        }

        .sidebar-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, #0a58ca 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
            letter-spacing: -0.5px;
        }

        .sidebar-user-info {
            min-width: 0;
        }

        .sidebar-user-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #ffffff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 0.6875rem;
            color: var(--sidebar-text);
            text-transform: capitalize;
        }

        /* ================================================================
           MAIN CONTENT AREA
        ================================================================ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ================================================================
           TOPBAR
        ================================================================ */
        .topbar {
            height: var(--topbar-h);
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--topbar-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.2px;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 14px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1px;
        }

        .topbar-badge.admin {
            background: #e8f0fe;
            color: var(--primary);
        }

        .topbar-badge.medecin {
            background: #e6f4f1;
            color: #1a7a6e;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 16px;
            border-radius: var(--radius-sm);
            border: 1px solid #dee2e6;
            background: #fff;
            color: var(--text-secondary);
            font-size: 0.8125rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-logout:hover {
            border-color: #dc3545;
            color: #dc3545;
            background: #fff5f5;
        }

        /* ================================================================
           PAGE CONTENT
        ================================================================ */
        .page-content {
            flex: 1;
            padding: 28px;
        }

        /* ================================================================
           ALERTS
        ================================================================ */
        .alert {
            border: none;
            border-left: 4px solid transparent;
            border-radius: var(--radius-md);
            font-size: 0.8375rem;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #f0faf7;
            border-left-color: #198754;
            color: #0f5132;
        }

        .alert-danger {
            background: #fff5f5;
            border-left-color: #dc3545;
            color: #842029;
        }

        .alert-warning {
            background: #fffbf0;
            border-left-color: #ffc107;
            color: #664d03;
        }

        .alert-info {
            background: #f0f7ff;
            border-left-color: var(--primary);
            color: #084298;
        }

        /* ================================================================
           CARDS
        ================================================================ */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--card-border);
            padding: 16px 22px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0 !important;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-primary);
        }

        .card-header.bg-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header.bg-success {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e5a800 100%) !important;
            color: #000 !important;
            border-bottom: none;
        }

        .card-header.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-body { padding: 22px; }
        .card-body.p-0 { padding: 0; }

        /* ================================================================
           STAT CARDS (Dashboard)
        ================================================================ */
        .stat-card {
            border-radius: var(--radius-lg);
            padding: 22px 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(0,0,0,0.18);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -18px; right: -18px;
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }

        .stat-card .fs-2 {
            font-size: 2rem !important;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1;
        }

        .stat-card .small {
            font-size: 0.75rem;
            font-weight: 500;
            opacity: 0.88;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ================================================================
           TABLES
        ================================================================ */
        .table {
            font-size: 0.8375rem;
            margin-bottom: 0;
            color: var(--text-primary);
        }

        .table th {
            background: #f8f9fb;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--card-border);
            padding: 11px 16px;
            white-space: nowrap;
        }

        .table td {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f3f5;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background: #f8fbff;
        }

        .table tbody tr:last-child td { border-bottom: none; }

        /* ================================================================
           BUTTONS
        ================================================================ */
        .btn {
            font-size: 0.8375rem;
            font-weight: 500;
            border-radius: var(--radius-sm);
            padding: 7px 18px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-sm {
            padding: 4px 12px;
            font-size: 0.78rem;
            border-radius: 5px;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-light {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.3);
            color: #fff;
        }

        .btn-light:hover {
            background: rgba(255,255,255,0.3);
            color: #fff;
        }

        /* ================================================================
           BADGES
        ================================================================ */
        .badge {
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: 999px;
            padding: 4px 10px;
            letter-spacing: 0.1px;
        }

        /* ================================================================
           FORM CONTROLS
        ================================================================ */
        .form-control,
        .form-select {
            border-radius: var(--radius-sm);
            border: 1px solid #d1d9e0;
            font-size: 0.8375rem;
            padding: 8px 13px;
            color: var(--text-primary);
            transition: var(--transition);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13,110,253,0.12);
        }

        .form-label {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .input-group .form-control:first-child { border-radius: var(--radius-sm) 0 0 var(--radius-sm); }
        .input-group .btn:last-child { border-radius: 0 var(--radius-sm) var(--radius-sm) 0; }

        /* ================================================================
           PAGINATION
        ================================================================ */
        .pagination {
            margin-top: 18px;
            gap: 4px;
        }

        .page-link {
            border-radius: var(--radius-sm) !important;
            border: 1px solid var(--card-border);
            font-size: 0.8125rem;
            color: var(--text-secondary);
            padding: 6px 12px;
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* ================================================================
           SCROLLBAR (body area)
        ================================================================ */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d0d7de; border-radius: 6px; }
        ::-webkit-scrollbar-thumb:hover { background: #abb3bc; }
    </style>

    @yield('styles')
</head>
<body>

{{-- ================================================================
     SIDEBAR
================================================================ --}}
<aside class="sidebar">
    {{-- Brand --}}
    <a class="sidebar-brand" href="#">
        <div class="sidebar-brand-icon">
            <i class="bi bi-hospital"></i>
        </div>
        <div>
            <span class="sidebar-brand-name">MediCore</span>
            <span class="sidebar-brand-sub">Système hospitalier</span>
        </div>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <ul class="nav flex-column" style="list-style:none; padding:0; margin:0;">

            @if(auth()->user()->isAdmin())
                {{-- TABLEAU DE BORD --}}
                <li><span class="sidebar-section">Tableau de bord</span></li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-1x2"></i> Dashboard
                    </a>
                </li>

                {{-- GESTION --}}
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

                {{-- MEDICAL --}}
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

                {{-- FINANCES --}}
                <li><span class="sidebar-section">Finances</span></li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.factures.*') ? 'active' : '' }}"
                       href="{{ route('admin.factures.index') }}">
                        <i class="bi bi-receipt"></i> Factures
                    </a>
                </li>

            @else
                {{-- MÉDECIN --}}
                <li><span class="sidebar-section">Tableau de bord</span></li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('medecin.dashboard') ? 'active' : '' }}"
                       href="{{ route('medecin.dashboard') }}">
                        <i class="bi bi-grid-1x2"></i> Dashboard
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
    </nav>

    {{-- Footer: user info --}}
    <div class="sidebar-footer">
        <div class="sidebar-footer-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="sidebar-user-role">{{ auth()->user()->role }}</div>
            </div>
        </div>
    </div>
</aside>

{{-- ================================================================
     MAIN WRAPPER
================================================================ --}}
<div class="main-wrapper">

    {{-- TOPBAR --}}
    <header class="topbar">
        <h1 class="topbar-title">@yield('page-title', 'MediCore')</h1>
        <div class="topbar-right">
            <span class="topbar-badge {{ auth()->user()->isAdmin() ? 'admin' : 'medecin' }}">
                <i class="bi bi-person-circle" style="font-size:14px"></i>
                {{ auth()->user()->isAdmin() ? 'Administrateur' : 'Médecin' }}
            </span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Déconnexion
                </button>
            </form>
        </div>
    </header>

    {{-- PAGE CONTENT --}}
    <main class="page-content">

        {{-- Success alert --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Error alert --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>