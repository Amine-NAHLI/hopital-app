{{--
    Fichier : app.blade.php
    Description : Layout principal futuriste (Thème Clair) pour MediCore Pro Nova.
--}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MediCore Pro Nova - L'avenir de la gestion hospitalière">
    <title>@yield('title', 'MediCore Pro Nova')</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icons & Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════════════════════════
           MediCore Pro Nova — Futuristic Light Design System
           ═══════════════════════════════════════════════════════════ */
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.15);
            --secondary: #0ea5e9;
            --accent: #f43f5e;
            --bg-nova: #f8fafc;
            --surface-nova: rgba(255, 255, 255, 0.85);
            --border-nova: rgba(255, 255, 255, 0.5);
            --text-nova-main: #0f172a;
            --text-nova-muted: #64748b;
            
            --sb-w: 280px;
            --tb-h: 70px;
            
            --nova-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04), 0 4px 10px -2px rgba(0, 0, 0, 0.02);
            --nova-glass: blur(12px) saturate(180%);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-nova);
            color: var(--text-nova-main);
            margin: 0;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.05) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(244, 63, 94, 0.02) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* ── SIDEBAR NOVA ───────────────────────────────────────────── */
        .sidebar {
            width: var(--sb-w);
            height: 100vh;
            background: var(--surface-nova);
            backdrop-filter: var(--nova-glass);
            border-right: 1px solid rgba(226, 232, 240, 0.8);
            position: fixed;
            left: 0; top: 0;
            z-index: 1000;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px 32px;
            text-decoration: none;
        }

        .logo-nova {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 16px var(--primary-glow);
            color: white; font-size: 20px;
        }

        .brand-text {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.03em;
        }

        .nav-section { margin-bottom: 24px; }
        .nav-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-nova-muted);
            padding: 0 12px 12px;
            opacity: 0.7;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 16px;
            color: var(--text-nova-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            margin-bottom: 4px;
        }

        .nav-item i { font-size: 1.1rem; transition: all 0.3s ease; }

        .nav-item:hover {
            background: white;
            color: var(--primary);
            box-shadow: var(--nova-shadow);
            transform: translateX(4px);
        }

        .nav-item.active {
            background: white;
            color: var(--primary);
            box-shadow: var(--nova-shadow);
            position: relative;
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            right: 12px; width: 6px; height: 6px;
            background: var(--primary);
            border-radius: 50%;
        }

        /* ── MAIN CONTENT ───────────────────────────────────────────── */
        .main-wrapper {
            margin-left: var(--sb-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ─────────────────────────────────────────────────── */
        .top-nova {
            height: var(--tb-h);
            background: rgba(248, 250, 252, 0.7);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0; z-index: 900;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .search-nova {
            background: white;
            border-radius: 14px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            width: 300px;
            transition: all 0.3s ease;
        }

        .search-nova:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
            width: 340px;
        }

        .search-nova input {
            border: none; outline: none; background: transparent; font-size: 0.9rem; width: 100%;
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 6px 6px 6px 16px;
            border-radius: 100px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: var(--nova-shadow);
        }

        .avatar-nova {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.85rem;
        }

        /* ── CARDS NOVA ─────────────────────────────────────────────── */
        .card-nova {
            background: var(--surface-nova);
            backdrop-filter: var(--nova-glass);
            border: 1px solid var(--border-nova);
            border-radius: 24px;
            padding: 24px;
            box-shadow: var(--nova-shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
        }

        .card-nova:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.08);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .stat-icon-nova {
            width: 48px; height: 48px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        /* ── TABLES NOVA ────────────────────────────────────────────── */
        .table-nova {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table-nova th {
            padding: 12px 20px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-nova-muted);
        }

        .table-nova tr {
            background: white;
            transition: all 0.3s ease;
        }

        .table-nova td {
            padding: 16px 20px;
            border-top: 1px solid rgba(226, 232, 240, 0.5);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .table-nova td:first-child { border-left: 1px solid rgba(226, 232, 240, 0.5); border-radius: 16px 0 0 16px; }
        .table-nova td:last-child { border-right: 1px solid rgba(226, 232, 240, 0.5); border-radius: 0 16px 16px 0; }

        .table-nova tr:hover {
            transform: scale(1.01);
            box-shadow: var(--nova-shadow);
            z-index: 10;
        }

        /* ── BUTTONS NOVA ───────────────────────────────────────────── */
        .btn-nova {
            padding: 10px 24px;
            border-radius: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            font-size: 0.9rem;
        }

        .btn-nova-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 8px 20px var(--primary-glow);
        }

        .btn-nova-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px var(--primary-glow);
            color: white;
        }

        .badge-nova {
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        /* ── UTILS ─────────────────────────────────────────────────── */
        .page-header-nova {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header-nova h1 {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: -0.04em;
        }

        /* ── GLOBAL OVERRIDES (THE POWER OF NOVA) ──────────────────── */
        .card {
            background: var(--surface-nova) !important;
            backdrop-filter: var(--nova-glass) !important;
            border: 1px solid var(--border-nova) !important;
            border-radius: 24px !important;
            box-shadow: var(--nova-shadow) !important;
            transition: all 0.4s ease !important;
        }
        .card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05); }
        
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--secondary)) !important; border: none !important; border-radius: 14px !important; padding: 10px 24px !important; font-weight: 700 !important; box-shadow: 0 8px 20px var(--primary-glow) !important; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 24px var(--primary-glow) !important; }
        
        .table { --bs-table-bg: transparent !important; }
        .table thead th { background: transparent !important; border-bottom: 2px solid rgba(226, 232, 240, 0.8) !important; color: var(--text-nova-muted) !important; font-size: 0.75rem !important; text-transform: uppercase !important; letter-spacing: 0.05em !important; padding: 16px 20px !important; }
        .table tbody td { padding: 16px 20px !important; vertical-align: middle !important; border-bottom: 1px solid rgba(226, 232, 240, 0.4) !important; background: transparent !important; }
        
        .form-control, .form-select { border-radius: 14px !important; border: 1px solid rgba(226, 232, 240, 0.8) !important; padding: 12px 18px !important; background: white !important; transition: all 0.3s ease !important; }
        .form-control:focus { border-color: var(--primary) !important; box-shadow: 0 0 0 4px var(--primary-glow) !important; }

        .badge { padding: 6px 12px !important; border-radius: 10px !important; font-weight: 700 !important; font-size: 0.75rem !important; text-transform: uppercase !important; }
        .bg-primary { background: var(--primary-glow) !important; color: var(--primary) !important; }
        
        /* Sidebar Scrollbar */
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }

        /* More Global Overrides */
        .rounded-pill { border-radius: 100px !important; }
        .input-group.rounded-pill { padding: 4px; background: white; border: 1px solid rgba(226, 232, 240, 0.8); }
        .input-group.rounded-pill .form-control { border: none !important; }
        .input-group.rounded-pill .btn { border-radius: 100px !important; }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); width: var(--sb-w); }
            .sidebar.active { transform: translateX(0); box-shadow: 20px 0 60px rgba(0,0,0,0.1); }
            .main-wrapper { margin-left: 0; }
            .top-nova { padding: 0 16px; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <div class="logo-nova">
                <i class="bi bi-hospital"></i>
            </div>
            <span class="brand-text">MediCore Nova</span>
        </a>

        <div class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                <div class="nav-section">
                    <span class="nav-label">Administration</span>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.medecins.index') }}" class="nav-item {{ request()->routeIs('admin.medecins.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i> Médecins
                    </a>
                    <a href="{{ route('admin.patients.index') }}" class="nav-item {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Patients
                    </a>
                </div>
                <div class="nav-section">
                    <span class="nav-label">Opérations</span>
                    <a href="{{ route('admin.rendez-vous.index') }}" class="nav-item {{ request()->routeIs('admin.rendez-vous.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i> Rendez-vous
                    </a>
                    <a href="{{ route('admin.consultations.index') }}" class="nav-item {{ request()->routeIs('admin.consultations.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-pulse"></i> Consultations
                    </a>
                    <a href="{{ route('admin.factures.index') }}" class="nav-item {{ request()->routeIs('admin.factures.*') ? 'active' : '' }}">
                        <i class="bi bi-receipt"></i> Facturation
                    </a>
                </div>
            @else
                <div class="nav-section">
                    <span class="nav-label">Espace Médecin</span>
                    <a href="{{ route('medecin.dashboard') }}" class="nav-item {{ request()->routeIs('medecin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                    <a href="{{ route('medecin.patients.index') }}" class="nav-item {{ request()->routeIs('medecin.patients.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Mes Patients
                    </a>
                    <a href="{{ route('medecin.rendez-vous.index') }}" class="nav-item {{ request()->routeIs('medecin.rendez-vous.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i> Mon Agenda
                    </a>
                    <a href="{{ route('medecin.consultations.index') }}" class="nav-item {{ request()->routeIs('medecin.consultations.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard2-pulse"></i> Mes Consultations
                    </a>
                </div>
                <div class="nav-section">
                    <span class="nav-label" style="color: var(--primary);">Intelligence Artificielle</span>
                    <a href="{{ route('medecin.ai.assistant') }}" class="nav-item {{ request()->routeIs('medecin.ai.*') ? 'active' : '' }}" style="background: var(--primary-glow); color: var(--primary); font-weight: 700;">
                        <i class="bi bi-robot fill-current animate-pulse"></i> IA Clinique
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-auto pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item w-100 border-0 bg-transparent text-danger">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper">
        <header class="top-nova">
            <div class="search-nova">
                <i class="bi bi-search text-muted"></i>
                <input type="text" placeholder="Rechercher un patient, un acte...">
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="user-pill">
                    <div class="d-flex flex-column text-end">
                        <span class="fw-bold small">{{ auth()->user()->name }}</span>
                        <span class="text-muted" style="font-size: 10px; text-transform: uppercase; font-weight: 700;">{{ auth()->user()->role }}</span>
                    </div>
                    <div class="avatar-nova">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="content-nova p-4 p-lg-5">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">

    <style>
        #nprogress .bar { background: var(--primary) !important; height: 3px !important; }
        #nprogress .spinner-icon { border-top-color: var(--primary) !important; border-left-color: var(--primary) !important; }
    </style>

    <script>
        // Progress bar on page load
        NProgress.start();
        window.onload = function() { NProgress.done(); };

        // Progress bar on every link click or form submission
        document.addEventListener('click', function(e) {
            const target = e.target.closest('a');
            if (target && target.href && !target.target && !target.href.includes('#')) {
                NProgress.start();
            }
        });
        document.addEventListener('submit', function() {
            NProgress.start();
        });
    </script>
    @stack('scripts')
</body>
</html>
