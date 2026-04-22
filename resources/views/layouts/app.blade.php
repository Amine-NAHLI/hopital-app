<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MediCore Pro - Système de Gestion Hospitalière Avancé">
    <title>@yield('title', 'MediCore Pro') — Excellence Médicale</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            /* Palette Principale - Sophistiquée & Médicale */
            --primary: #4f46e5;
            /* Indigo 600 */
            --primary-light: #eef2ff;
            --primary-dark: #3730a3;
            --secondary: #0f172a;
            /* Slate 900 */
            --accent: #06b6d4;
            /* Cyan 500 */
            --accent-soft: #ecfeff;

            /* Status Colors */
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;

            /* Sidebar - Dark Glass */
            --sidebar-bg: #0f172a;
            --sidebar-width: 280px;
            --sidebar-item-h: rgba(255, 255, 255, 0.08);
            --sidebar-active: #4f46e5;

            /* Body & Surface */
            --body-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;

            /* Text */
            --text-main: #1e293b;
            --text-muted: #64748b;
            --text-light: #94a3b8;

            /* Effects */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius-md: 12px;
            --radius-lg: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* --- Global Reset --- */
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-main);
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .sidebar-brand {
            font-family: 'Sora', sans-serif;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-brand {
            padding: 32px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .brand-logo i {
            color: white;
            font-size: 20px;
        }

        .brand-name {
            color: white;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
        }

        .sidebar-nav {
            flex: 1;
            padding: 0 16px 24px;
            overflow-y: auto;
        }

        .nav-section-title {
            color: var(--text-light);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 24px 12px 12px;
            opacity: 0.6;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-light);
            text-decoration: none;
            border-radius: var(--radius-md);
            margin-bottom: 4px;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .nav-link i {
            font-size: 1.1rem;
            opacity: 0.7;
            transition: var(--transition);
        }

        .nav-link:hover {
            background: var(--sidebar-item-h);
            color: white;
        }

        .nav-link:hover i {
            opacity: 1;
            transform: translateX(2px);
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .nav-link.active i {
            opacity: 1;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(0, 0, 0, 0.1);
        }

        .user-widget {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            color: var(--text-light);
            font-size: 0.7rem;
            opacity: 0.7;
        }

        /* --- Main Content --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 0;
            min-height: 100vh;
            transition: var(--transition);
        }

        /* --- Topbar --- */
        .topbar {
            height: 80px;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 900;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary);
            margin: 0;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .role-badge {
            padding: 6px 16px;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .role-badge.admin {
            background: var(--primary-light);
            color: var(--primary);
        }

        .role-badge.medecin {
            background: var(--accent-soft);
            color: var(--accent);
        }

        .logout-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: var(--radius-md);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background: #fff;
            color: var(--danger);
            border-color: var(--danger);
            box-shadow: var(--shadow-sm);
        }

        /* --- Page Content Area --- */
        .content-container {
            padding: 40px;
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Cards & Stats --- */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 20px 24px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header i {
            color: var(--primary);
        }

        .stat-card {
            padding: 24px;
            border-radius: var(--radius-lg);
            color: white;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 140px;
            transition: var(--transition);
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 5rem;
            opacity: 0.15;
            transform: rotate(-15deg);
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 4px;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.9;
        }

        /* --- Tables --- */
        .table-responsive {
            border-radius: var(--radius-md);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f1f5f9;
            padding: 16px 24px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border: none;
        }

        .table tbody td {
            padding: 16px 24px;
            vertical-align: middle;
            font-size: 0.9rem;
            color: var(--text-main);
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover td {
            background-color: #f8fafc;
        }

        /* --- Buttons --- */
        .btn {
            border-radius: var(--radius-md);
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* --- Alerts --- */
        .alert {
            border-radius: var(--radius-md);
            border: none;
            padding: 16px 20px;
            font-weight: 500;
            box-shadow: var(--shadow-sm);
        }

        /* --- Responsive --- */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                padding: 0 20px;
            }

            .content-container {
                padding: 24px 20px;
            }
        }

        /* Support for original stat card inline styles (override) */
        .stat-card[style*="background"] {
            background: var(--primary) !important;
            /* Fallback */
        }

        /* Specific overrides for consistent medical feel */
        .stat-bg-patients {
            background: linear-gradient(135deg, #6366f1, #4f46e5) !important;
        }

        .stat-bg-medecins {
            background: linear-gradient(135deg, #06b6d4, #0891b2) !important;
        }

        .stat-bg-rdv {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
        }

        .stat-bg-consultations {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important;
        }

        .stat-bg-factures {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        }

        .stat-bg-revenus {
            background: linear-gradient(135deg, #10b981, #059669) !important;
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <a href="#" class="sidebar-brand">
            <div class="brand-logo">
                <i class="bi bi-hospital"></i>
            </div>
            <span class="brand-name">MediCore<span style="color: var(--accent)">Pro</span></span>
        </a>

        <div class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                <div class="nav-section-title">Principal</div>
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    Tableau de bord
                </a>

                <div class="nav-section-title">Gestion Patients</div>
                <a href="{{ route('admin.patients.index') }}"
                    class="nav-link {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    Annuaire Patients
                </a>
                <a href="{{ route('admin.medecins.index') }}"
                    class="nav-link {{ request()->routeIs('admin.medecins.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge-fill"></i>
                    Corps Médical
                </a>
                <a href="{{ route('admin.rendez-vous.index') }}"
                    class="nav-link {{ request()->routeIs('admin.rendez-vous.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event-fill"></i>
                    Rendez-vous
                </a>

                <div class="nav-section-title">Activité Médicale</div>
                <a href="{{ route('admin.consultations.index') }}"
                    class="nav-link {{ request()->routeIs('admin.consultations.*') ? 'active' : '' }}">
                    <i class="bi bi-heart-pulse-fill"></i>
                    Consultations
                </a>
                <a href="{{ route('admin.ordonnances.index') }}"
                    class="nav-link {{ request()->routeIs('admin.ordonnances.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    Ordonnances
                </a>

                <div class="nav-section-title">Finance</div>
                <a href="{{ route('admin.factures.index') }}"
                    class="nav-link {{ request()->routeIs('admin.factures.*') ? 'active' : '' }}">
                    <i class="bi bi-credit-card-2-back-fill"></i>
                    Facturation
                </a>
            @else
                <div class="nav-section-title">Espace Praticien</div>
                <a href="{{ route('medecin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('medecin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    Mon Dashboard
                </a>
                <a href="{{ route('medecin.patients.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.patients.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    Mes Patients
                </a>
                <a href="{{ route('medecin.rendez-vous.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.rendez-vous.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check-fill"></i>
                    Mon Agenda
                </a>
                <a href="{{ route('medecin.consultations.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.consultations.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-pulse"></i>
                    Mes Consultations
                </a>
                <a href="{{ route('medecin.ordonnances.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.ordonnances.*') ? 'active' : '' }}">
                    <i class="bi bi-file-medical-fill"></i>
                    Mes Ordonnances
                </a>
            @endif
        </div>

        <div class="sidebar-footer">
            <a href="#" class="text-decoration-none">
                <div class="user-widget">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">{{ auth()->user()->isAdmin() ? 'Administrateur' : 'Praticien' }}</div>
                    </div>
                    <i class="bi bi-gear text-light opacity-50 ms-auto"></i>
                </div>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <h1 class="page-title">@yield('page-title', 'Tableau de bord')</h1>

            <div class="topbar-actions">
                <span class="role-badge {{ auth()->user()->isAdmin() ? 'admin' : 'medecin' }}">
                    <i class="bi bi-shield-check me-1"></i>
                    {{ auth()->user()->isAdmin() ? 'Admin' : 'Praticien' }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Quitter
                    </button>
                </form>
            </div>
        </header>

        <!-- Dynamic Content -->
        <div class="content-container">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>