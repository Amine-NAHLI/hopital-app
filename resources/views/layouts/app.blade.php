{{--
    Fichier : app.blade.php
    Description : Layout principal de l'application pour les utilisateurs connectés.
    Rôle : Définit la structure HTML de base, inclut le CSS global, la barre de navigation et le contenu dynamique.
--}}
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MediCore Pro - Système de Gestion Hospitalière">
    <title>@yield('title', 'MediCore Pro')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icons & Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════════════════════════
           MediCore Pro — Design System 3.0
           Built from scratch. Clean, purposeful, real product design.
           ═══════════════════════════════════════════════════════════ */

        /* ── TOKENS ─────────────────────────────────────────────────── */
        :root {
            /* Surfaces */
            --bg:       #F5F7FA;
            --surface:  #FFFFFF;
            --border:   #E5E7EB;
            --border-2: #D1D5DB;

            /* Text — three levels of emphasis */
            --t1: #111827;   /* headings / strong labels */
            --t2: #374151;   /* body copy */
            --t3: #6B7280;   /* secondary / captions */
            --t4: #9CA3AF;   /* placeholders / disabled */

            /* Primary action — trust blue */
            --blue:      #2563EB;
            --blue-h:    #1D4ED8;
            --blue-bg:   #EFF6FF;
            --blue-ring: rgba(37, 99, 235, 0.14);

            /* Accent (used in brand wordmark) */
            --accent:    #22D3EE;

            /* Status */
            --green:     #16A34A;  --green-bg:  #DCFCE7;
            --amber:     #B45309;  --amber-bg:  #FEF3C7;
            --red:       #DC2626;  --red-bg:    #FEE2E2;
            --sky:       #0369A1;  --sky-bg:    #E0F2FE;
            --violet:    #6D28D9;  --violet-bg: #EDE9FE;
            --teal:      #0F766E;  --teal-bg:   #CCFBF1;
            --rose:      #BE123C;  --rose-bg:   #FFE4E6;

            /* Sidebar */
            --sb-bg: #0C0D10;
            --sb-w:  248px;

            /* Layout */
            --tb-h:  60px;

            /* Radius */
            --r-xs: 4px;
            --r-sm: 6px;
            --r-md: 8px;
            --r-lg: 12px;

            /* Elevation — subtle, realistic */
            --e1: 0 1px 2px rgba(0,0,0,0.05);
            --e2: 0 1px 3px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.04);
            --e3: 0 4px 12px rgba(0,0,0,0.07), 0 2px 4px rgba(0,0,0,0.04);

            /* Motion — intentionally short */
            --ease: 0.14s ease;
        }

        /* ── RESET & BASE ───────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            background: var(--bg);
            color: var(--t2);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Sora', 'Inter', sans-serif;
            color: var(--t1);
            line-height: 1.3;
            letter-spacing: -0.02em;
            margin: 0;
        }

        a { color: inherit; text-decoration: none; }

        /* Thin, unobtrusive scrollbar */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border-2); border-radius: 99px; }

        /* ── SIDEBAR ────────────────────────────────────────────────── */
        .sidebar {
            width: var(--sb-w);
            height: 100vh;
            background: var(--sb-bg);
            position: fixed;
            left: 0; top: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-right: 1px solid rgba(255,255,255,0.04);
        }

        /* Single-pixel accent line at the very top */
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--blue);
            opacity: 0.8;
            z-index: 1;
        }

        /* Brand header — same height as topbar */
        .sidebar-brand {
            height: var(--tb-h);
            padding: 0 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            flex-shrink: 0;
        }

        .brand-logo {
            width: 30px; height: 30px;
            background: var(--blue);
            border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* Kill old pulse animation */
        .brand-logo::after { display: none !important; }
        .brand-logo i { color: white; font-size: 15px; }

        .brand-name {
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: rgba(255,255,255,0.90);
            letter-spacing: -0.02em;
        }

        /* Navigation body */
        .sidebar-nav {
            flex: 1;
            padding: 8px 8px 16px;
            overflow-y: auto;
        }

        .sidebar-nav::-webkit-scrollbar { width: 0; }

        /* Section labels */
        .nav-section-title {
            font-family: 'Inter', sans-serif;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.22);
            padding: 16px 8px 4px;
            display: block;
        }

        .nav-section-title::after { display: none !important; }

        /* Nav items */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 7px 10px;
            border-radius: var(--r-sm);
            margin-bottom: 1px;
            font-size: 13px;
            font-weight: 400;
            color: rgba(255,255,255,0.48);
            text-decoration: none;
            transition: background var(--ease), color var(--ease);
            position: relative;
            overflow: hidden;
        }

        .nav-link i {
            font-size: 14px;
            width: 16px;
            text-align: center;
            flex-shrink: 0;
            opacity: 0.7;
            transition: opacity var(--ease);
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.82);
            transform: none;
        }

        .nav-link:hover i { opacity: 1; }

        /* Active: 2px blue left bar + tinted bg */
        .nav-link.active {
            background: rgba(37,99,235,0.14);
            color: rgba(255,255,255,0.95);
            font-weight: 500;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 5px; bottom: 5px;
            width: 2px;
            background: var(--blue);
            border-radius: 0 2px 2px 0;
        }

        .nav-link.active i { opacity: 1; }

        /* User footer */
        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 10px;
            flex-shrink: 0;
        }

        .user-widget {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px;
            border-radius: var(--r-sm);
            transition: background var(--ease);
        }

        .user-widget:hover { background: rgba(255,255,255,0.06); cursor: default; }

        .user-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--blue);
            color: white;
            font-size: 11px;
            font-weight: 600;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            border: none;
            box-shadow: none;
        }

        .user-info { flex: 1; min-width: 0; }

        .user-name {
            font-size: 12.5px;
            font-weight: 500;
            color: rgba(255,255,255,0.88);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255,255,255,0.32);
            line-height: 1.3;
        }

        /* ── MAIN CONTENT ───────────────────────────────────────────── */
        .main-content {
            margin-left: var(--sb-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ─────────────────────────────────────────────────── */
        .topbar {
            height: var(--tb-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 50;
            /* No blur, no glass — clean white */
            backdrop-filter: none;
            box-shadow: none;
        }

        /* Kill animated stripe */
        .topbar::before { display: none !important; }

        .page-title {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--t1);
            margin: 0;
            letter-spacing: -0.01em;
            display: block;
        }

        /* Kill dot accent */
        .page-title::before { display: none !important; }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            border: none;
        }

        .role-badge.admin {
            background: var(--blue-bg);
            color: var(--blue-h);
        }

        .role-badge.medecin {
            background: var(--teal-bg);
            color: var(--teal);
        }

        .logout-btn {
            background: transparent;
            border: 1px solid var(--border);
            padding: 6px 12px;
            border-radius: var(--r-sm);
            font-size: 13px;
            font-weight: 500;
            color: var(--t3);
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: background var(--ease), color var(--ease), border-color var(--ease);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .logout-btn:hover {
            background: var(--red-bg);
            color: var(--red);
            border-color: #FECACA;
            transform: none;
            box-shadow: none;
        }

        /* ── CONTENT CONTAINER ──────────────────────────────────────── */
        .content-container {
            padding: 28px 32px;
            flex: 1;
            animation: fade-up 0.2s ease both;
        }

        @keyframes fade-up {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── CARDS ──────────────────────────────────────────────────── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border) !important;
            border-radius: var(--r-lg) !important;
            box-shadow: var(--e1) !important;
            transition: box-shadow var(--ease) !important;
            overflow: hidden;
        }

        .card:hover { box-shadow: var(--e2) !important; }

        .card-header {
            background: var(--surface) !important;
            border-bottom: 1px solid var(--border) !important;
            padding: 14px 20px !important;
            position: static !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }

        /* Kill old left accent bar */
        .card-header::before { display: none !important; }

        .card-header i {
            color: var(--t4) !important;
            font-size: 14px !important;
        }

        /* Text inside card headers */
        .card-header h4,
        .card-header h5,
        .card-header .fw-bold {
            font-family: 'Sora', sans-serif !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: var(--t1) !important;
            letter-spacing: -0.01em !important;
        }

        .card-body { padding: 20px; }

        .card-footer {
            background: var(--bg) !important;
            border-top: 1px solid var(--border) !important;
            padding: 12px 20px !important;
        }

        /* ── STAT CARDS ─────────────────────────────────────────────── */
        /*
         * White cards with a coloured top border.
         * Numbers are dark text — no more candy gradients.
         * These are data surfaces, not decorations.
         */
        .stat-card {
            padding: 20px !important;
            border-radius: var(--r-lg) !important;
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            box-shadow: var(--e1) !important;
            color: var(--t1) !important;
            position: relative;
            overflow: hidden;
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
            gap: 4px;
            min-height: 108px !important;
            /* No bounce, no float */
            transition: box-shadow var(--ease), border-color var(--ease) !important;
        }

        /* Kill glass shimmer */
        .stat-card::after { display: none !important; }

        .stat-card:hover {
            box-shadow: var(--e2) !important;
            border-color: var(--border-2) !important;
            transform: none !important;
        }

        /* Watermark icon */
        .stat-icon {
            position: absolute !important;
            right: 14px !important;
            bottom: 10px !important;
            font-size: 38px !important;
            opacity: 0.07 !important;
            transform: none !important;
            transition: opacity var(--ease) !important;
        }

        .stat-card:hover .stat-icon {
            opacity: 0.12 !important;
            transform: none !important;
        }

        .stat-value {
            font-family: 'Sora', sans-serif !important;
            font-size: 26px !important;
            font-weight: 700 !important;
            line-height: 1 !important;
            letter-spacing: -0.04em !important;
            color: var(--t1) !important;
            text-shadow: none !important;
            margin-bottom: 0 !important;
        }

        .stat-label {
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.08em !important;
            color: var(--t4) !important;
            opacity: 1 !important;
        }

        /* Coloured top borders — one per metric type */
        .stat-bg-patients      { border-top: 3px solid var(--blue)   !important; }
        .stat-bg-medecins      { border-top: 3px solid #0891B2        !important; }
        .stat-bg-rdv           { border-top: 3px solid #D97706        !important; }
        .stat-bg-consultations { border-top: 3px solid var(--violet)  !important; }
        .stat-bg-factures      { border-top: 3px solid var(--rose)    !important; }
        .stat-bg-revenus       { border-top: 3px solid var(--green)   !important; }

        /* Watermark icon colour per type */
        .stat-bg-patients      .stat-icon { color: var(--blue)  !important; }
        .stat-bg-medecins      .stat-icon { color: #0891B2       !important; }
        .stat-bg-rdv           .stat-icon { color: #D97706       !important; }
        .stat-bg-consultations .stat-icon { color: var(--violet) !important; }
        .stat-bg-factures      .stat-icon { color: var(--rose)   !important; }
        .stat-bg-revenus       .stat-icon { color: var(--green)  !important; }

        /* ── TABLES ─────────────────────────────────────────────────── */
        .table-responsive { border-radius: 0; overflow-x: auto; }
        .table { margin-bottom: 0; font-size: 13.5px; }

        .table thead th {
            background: var(--bg) !important;
            padding: 10px 16px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.07em !important;
            color: var(--t4) !important;
            border: none !important;
            border-bottom: 1px solid var(--border) !important;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 12px 16px !important;
            vertical-align: middle !important;
            font-size: 13.5px !important;
            color: var(--t2) !important;
            border-bottom: 1px solid var(--border) !important;
            transition: background var(--ease);
        }

        .table tbody tr:last-child td { border-bottom: none !important; }

        .table-hover tbody tr:hover td {
            background: #F9FAFB !important;
        }

        /* ── BUTTONS ────────────────────────────────────────────────── */
        .btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            padding: 7px 14px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            line-height: 1.4 !important;
            border-radius: var(--r-md) !important;
            cursor: pointer !important;
            transition: background var(--ease), color var(--ease), border-color var(--ease) !important;
            overflow: visible !important;
            position: static !important;
            text-decoration: none !important;
        }

        .btn::after { display: none !important; }

        /* Primary — solid blue */
        .btn-primary {
            background: var(--blue) !important;
            border: 1px solid var(--blue) !important;
            color: #fff !important;
            box-shadow: none !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--blue-h) !important;
            border-color: var(--blue-h) !important;
            color: #fff !important;
            transform: none !important;
            box-shadow: none !important;
        }

        /* Outline variants */
        .btn-outline-primary {
            background: transparent !important;
            border: 1px solid var(--blue) !important;
            color: var(--blue) !important;
        }
        .btn-outline-primary:hover {
            background: var(--blue-bg) !important;
            color: var(--blue) !important;
            transform: none !important;
        }

        .btn-outline-secondary {
            background: transparent !important;
            border: 1px solid var(--border) !important;
            color: var(--t3) !important;
        }
        .btn-outline-secondary:hover {
            background: var(--bg) !important;
            border-color: var(--border-2) !important;
            color: var(--t2) !important;
            transform: none !important;
        }

        .btn-outline-info {
            background: transparent !important;
            border: 1px solid #BAE6FD !important;
            color: var(--sky) !important;
        }
        .btn-outline-info:hover {
            background: var(--sky-bg) !important;
            transform: none !important;
        }

        .btn-outline-warning {
            background: transparent !important;
            border: 1px solid #FDE68A !important;
            color: var(--amber) !important;
        }
        .btn-outline-warning:hover {
            background: var(--amber-bg) !important;
            transform: none !important;
        }

        .btn-outline-danger {
            background: transparent !important;
            border: 1px solid #FECACA !important;
            color: var(--red) !important;
        }
        .btn-outline-danger:hover {
            background: var(--red-bg) !important;
            transform: none !important;
        }

        /* Solid variants */
        .btn-warning {
            background: #F59E0B !important;
            border: 1px solid #F59E0B !important;
            color: #fff !important;
            box-shadow: none !important;
        }
        .btn-warning:hover {
            background: var(--amber) !important;
            border-color: var(--amber) !important;
            color: #fff !important;
            transform: none !important;
        }

        .btn-danger {
            background: var(--red) !important;
            border: 1px solid var(--red) !important;
            color: #fff !important;
            box-shadow: none !important;
        }
        .btn-danger:hover {
            background: #B91C1C !important;
            border-color: #B91C1C !important;
            color: #fff !important;
            transform: none !important;
        }

        .btn-light, .btn-white {
            background: var(--bg) !important;
            border: 1px solid var(--border) !important;
            color: var(--t2) !important;
        }
        .btn-light:hover, .btn-white:hover {
            background: #E9EBF0 !important;
            color: var(--t1) !important;
            transform: none !important;
        }

        .btn-dark {
            background: var(--t1) !important;
            border: 1px solid var(--t1) !important;
            color: #fff !important;
        }
        .btn-dark:hover {
            background: #1F2937 !important;
            transform: none !important;
        }

        /* Sizes */
        .btn-sm {
            padding: 5px 10px !important;
            font-size: 12px !important;
            border-radius: var(--r-sm) !important;
            gap: 5px !important;
        }
        .btn-lg {
            padding: 10px 20px !important;
            font-size: 14px !important;
        }

        /* Icon button (used in action columns) */
        .btn-icon-hover {
            width: 32px !important;
            height: 32px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: transparent !important;
            border: 1px solid transparent !important;
            border-radius: var(--r-sm) !important;
            cursor: pointer !important;
            transition: background var(--ease), border-color var(--ease) !important;
        }
        .btn-icon-hover:hover {
            background: var(--bg) !important;
            border-color: var(--border) !important;
            transform: none !important;
            box-shadow: none !important;
        }

        /* ── ALERTS ─────────────────────────────────────────────────── */
        .alert {
            border: none !important;
            border-radius: var(--r-md) !important;
            padding: 12px 16px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            box-shadow: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
        }

        .alert-success {
            background: var(--green-bg) !important;
            color: #166534 !important;
            border-left: 3px solid var(--green) !important;
        }
        .alert-danger {
            background: var(--red-bg) !important;
            color: #991B1B !important;
            border-left: 3px solid var(--red) !important;
        }
        .alert-warning {
            background: var(--amber-bg) !important;
            color: #92400E !important;
            border-left: 3px solid #F59E0B !important;
        }
        .alert-info {
            background: var(--sky-bg) !important;
            color: #075985 !important;
            border-left: 3px solid #0EA5E9 !important;
        }

        /* ── FORMS ──────────────────────────────────────────────────── */
        .form-control,
        .form-select {
            border-radius: var(--r-sm) !important;
            border: 1px solid var(--border-2) !important;
            padding: 8px 12px !important;
            font-size: 13.5px !important;
            font-family: 'Inter', sans-serif !important;
            color: var(--t1) !important;
            background: var(--surface) !important;
            transition: border-color var(--ease), box-shadow var(--ease) !important;
            height: auto !important;
            line-height: 1.5 !important;
        }

        .form-control::placeholder { color: var(--t4) !important; }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--blue) !important;
            box-shadow: 0 0 0 3px var(--blue-ring) !important;
            outline: none !important;
            background: var(--surface) !important;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(220,38,38,0.1) !important;
        }

        .form-label {
            font-size: 13px !important;
            font-weight: 500 !important;
            color: var(--t1) !important;
            margin-bottom: 5px !important;
            display: block;
        }

        .input-group-text {
            background: var(--bg) !important;
            border: 1px solid var(--border-2) !important;
            color: var(--t3) !important;
            font-size: 13px !important;
        }

        textarea.form-control { resize: vertical; min-height: 88px; }

        /* ── BADGES ─────────────────────────────────────────────────── */
        .badge {
            font-size: 11px !important;
            font-weight: 600 !important;
            padding: 3px 8px !important;
            border-radius: var(--r-xs) !important;
            letter-spacing: 0.02em !important;
        }

        .badge.rounded-pill { border-radius: 99px !important; padding: 3px 10px !important; }

        /* Semantic status colours */
        .bg-success { background: var(--green-bg) !important; color: var(--green) !important; }
        .bg-warning { background: var(--amber-bg) !important; color: var(--amber) !important; }
        .bg-danger  { background: var(--red-bg)   !important; color: var(--red)   !important; }
        .bg-info    { background: var(--sky-bg)   !important; color: var(--sky)   !important; }
        .bg-light   { background: var(--bg)       !important; color: var(--t2)    !important; }
        .bg-dark    { background: var(--t1)       !important; color: #fff         !important; }

        /* ── PAGINATION ─────────────────────────────────────────────── */
        .pagination { gap: 3px !important; }

        .page-link {
            border: 1px solid var(--border) !important;
            border-radius: var(--r-sm) !important;
            padding: 6px 12px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            color: var(--t3) !important;
            background: var(--surface) !important;
            transition: background var(--ease), color var(--ease), border-color var(--ease) !important;
            min-width: 34px;
            text-align: center;
        }

        .page-link:hover {
            background: var(--blue-bg) !important;
            border-color: var(--blue) !important;
            color: var(--blue) !important;
            transform: none !important;
            box-shadow: none !important;
        }

        .page-item.active .page-link {
            background: var(--blue) !important;
            border-color: var(--blue) !important;
            color: #fff !important;
            box-shadow: none !important;
        }

        .page-item.disabled .page-link {
            background: var(--bg) !important;
            color: var(--t4) !important;
            border-color: var(--border) !important;
        }

        /* ── NAV PILLS (detail page tabs) ───────────────────────────── */
        .nav-pills .nav-link {
            border-radius: var(--r-sm) !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            padding: 7px 14px !important;
            color: var(--t3) !important;
            transition: background var(--ease) !important;
        }

        .nav-pills .nav-link:hover {
            background: var(--bg) !important;
            color: var(--t2) !important;
        }

        .nav-pills .nav-link.active {
            background: var(--blue) !important;
            color: #fff !important;
            box-shadow: none !important;
        }

        /* ── DOCTOR CARDS (admin/medecins/index) ────────────────────── */
        .card-medecin {
            border: 1px solid var(--border) !important;
            box-shadow: var(--e1) !important;
            transition: box-shadow var(--ease), border-color var(--ease), transform var(--ease) !important;
        }

        .card-medecin:hover {
            transform: translateY(-3px) !important;
            box-shadow: var(--e3) !important;
            border-color: var(--border-2) !important;
        }

        .card-overlay {
            background: var(--bg) !important;
            height: 60px !important;
        }

        /* ── UTILITIES ──────────────────────────────────────────────── */
        .x-small          { font-size: 11.5px !important; }
        .bg-primary-light { background: var(--blue-bg)   !important; }
        .bg-success-light { background: var(--green-bg)  !important; }
        .bg-warning-light { background: var(--amber-bg)  !important; }
        .bg-danger-light  { background: var(--red-bg)    !important; }
        .bg-info-light    { background: var(--sky-bg)    !important; }
        .text-primary     { color: var(--blue)           !important; }
        .text-success     { color: var(--green)          !important; }
        .text-warning     { color: var(--amber)          !important; }
        .text-danger      { color: var(--red)            !important; }
        .text-info        { color: var(--sky)            !important; }
        .text-muted       { color: var(--t3)             !important; }
        .text-secondary   { color: var(--t2)             !important; }
        .text-dark        { color: var(--t1)             !important; }

        /* Divider helper */
        .border-bottom { border-bottom: 1px solid var(--border) !important; }
        .border-top    { border-top:    1px solid var(--border) !important; }

        /* ── RESPONSIVE ─────────────────────────────────────────────── */
        @media (max-width: 992px) {
            .sidebar           { transform: translateX(-100%); }
            .main-content      { margin-left: 0; }
            .topbar            { padding: 0 16px; }
            .content-container { padding: 20px 16px; }
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="#" class="sidebar-brand">
            <div class="brand-logo">
                <i class="bi bi-hospital"></i>
            </div>
            <span class="brand-name">MediCore<span style="color: var(--accent)">Pro</span></span>
        </a>

        <nav class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                <span class="nav-section-title">Principal</span>
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    Tableau de bord
                </a>

                <span class="nav-section-title">Gestion</span>
                <a href="{{ route('admin.patients.index') }}"
                    class="nav-link {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Patients
                </a>
                <a href="{{ route('admin.medecins.index') }}"
                    class="nav-link {{ request()->routeIs('admin.medecins.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i>
                    Corps Médical
                </a>
                <a href="{{ route('admin.rendez-vous.index') }}"
                    class="nav-link {{ request()->routeIs('admin.rendez-vous.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar"></i>
                    Rendez-vous
                </a>

                <span class="nav-section-title">Activité</span>
                <a href="{{ route('admin.consultations.index') }}"
                    class="nav-link {{ request()->routeIs('admin.consultations.*') ? 'active' : '' }}">
                    <i class="bi bi-heart-pulse"></i>
                    Consultations
                </a>
                <a href="{{ route('admin.ordonnances.index') }}"
                    class="nav-link {{ request()->routeIs('admin.ordonnances.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-medical"></i>
                    Ordonnances
                </a>

                <span class="nav-section-title">Finance</span>
                <a href="{{ route('admin.factures.index') }}"
                    class="nav-link {{ request()->routeIs('admin.factures.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>
                    Facturation
                </a>
            @else
                <span class="nav-section-title">Espace Praticien</span>
                <a href="{{ route('medecin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('medecin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>
                <a href="{{ route('medecin.patients.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.patients.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Mes Patients
                </a>
                <a href="{{ route('medecin.rendez-vous.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.rendez-vous.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i>
                    Mon Agenda
                </a>
                <a href="{{ route('medecin.consultations.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.consultations.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-pulse"></i>
                    Consultations
                </a>
                <a href="{{ route('medecin.ordonnances.index') }}"
                    class="nav-link {{ request()->routeIs('medecin.ordonnances.*') ? 'active' : '' }}">
                    <i class="bi bi-file-medical"></i>
                    Ordonnances
                </a>
            @endif
        </nav>

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
                    <i class="bi bi-gear" style="color: rgba(255,255,255,0.25); font-size: 13px; margin-left: auto;"></i>
                </div>
            </a>
        </div>
    </aside>

    <!-- Main -->
    <main class="main-content">
        <header class="topbar">
            <h1 class="page-title">@yield('page-title', 'Tableau de bord')</h1>

            <div class="topbar-actions">
                <span class="role-badge {{ auth()->user()->isAdmin() ? 'admin' : 'medecin' }}">
                    <i class="bi bi-shield-check"></i>
                    {{ auth()->user()->isAdmin() ? 'Admin' : 'Praticien' }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Déconnexion
                    </button>
                </form>
            </div>
        </header>

        <div class="content-container">
            @if(session('success'))
                <div class="alert alert-success mb-4" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
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
