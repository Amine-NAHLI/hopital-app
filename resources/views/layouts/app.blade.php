<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MediCore - Systeme de gestion hospitaliere professionnel">
    <title>@yield('title', 'MediCore') — Systeme Hospitalier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ================================================================
           DESIGN TOKENS — MediCore Professional Medical Theme
        ================================================================ */
        :root {
            /* Core Palette — Sophisticated Teal / Slate */
            --primary:          #0f766e;
            --primary-dark:     #0d6560;
            --primary-light:    #f0fdfa;
            --primary-hover:    #115e59;
            --accent:           #14b8a6;
            --accent-light:     #ccfbf1;

            /* Sidebar — Deep Navy */
            --sidebar-bg:       #0c1425;
            --sidebar-bg-2:     #111d35;
            --sidebar-hover:    rgba(255,255,255,0.05);
            --sidebar-active:   rgba(20,184,166,0.12);
            --sidebar-border:   rgba(255,255,255,0.05);
            --sidebar-text:     rgba(255,255,255,0.5);
            --sidebar-text-h:   rgba(255,255,255,0.92);
            --sidebar-accent:   #2dd4bf;

            /* Topbar */
            --topbar-bg:        #ffffff;
            --topbar-border:    #e2e8f0;

            /* Body */
            --body-bg:          #f1f5f9;

            /* Cards */
            --card-bg:          #ffffff;
            --card-border:      #e2e8f0;
            --card-shadow:      0 1px 3px rgba(0,0,0,.04), 0 4px 24px rgba(0,0,0,.03);
            --card-shadow-hover:0 4px 12px rgba(0,0,0,.06), 0 8px 32px rgba(0,0,0,.04);

            /* Typography */
            --text-primary:     #0f172a;
            --text-secondary:   #64748b;
            --text-muted:       #94a3b8;

            /* Radii */
            --radius-sm:        6px;
            --radius-md:        10px;
            --radius-lg:        14px;
            --radius-xl:        18px;

            /* Layout */
            --sidebar-w:        264px;
            --topbar-h:         64px;

            /* Motion */
            --transition:       all 0.2s cubic-bezier(.4,0,.2,1);
            --transition-slow:  all 0.35s cubic-bezier(.4,0,.2,1);
        }

        /* ================================================================
           RESET & BASE
        ================================================================ */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--body-bg);
            color: var(--text-primary);
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ================================================================
           SIDEBAR
        ================================================================ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg-2) 100%);
            display: flex;
            flex-direction: column;
            z-index: 200;
            overflow: hidden;
            border-right: 1px solid rgba(255,255,255,0.03);
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 0 24px;
            height: var(--topbar-h);
            border-bottom: 1px solid var(--sidebar-border);
            text-decoration: none;
            flex-shrink: 0;
        }

        .sidebar-brand:hover { text-decoration: none; }

        .sidebar-brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(20,184,166,0.25);
        }

        .sidebar-brand-icon i {
            font-size: 17px;
            color: #fff;
        }

        .sidebar-brand-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.4px;
        }

        .sidebar-brand-sub {
            font-size: 0.6rem;
            color: var(--sidebar-text);
            font-weight: 500;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            display: block;
            line-height: 1;
            margin-top: 1px;
        }

        /* Nav scroll area */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 0;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.06) transparent;
        }

        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }

        /* Section label */
        .sidebar-section {
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            color: var(--sidebar-text);
            padding: 20px 24px 8px;
            opacity: 0.5;
            display: block;
        }

        /* Nav links */
        .sidebar-nav .nav-item { padding: 0 12px; margin-bottom: 1px; }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: var(--radius-md);
            color: var(--sidebar-text);
            font-weight: 500;
            font-size: 0.825rem;
            transition: var(--transition);
            text-decoration: none;
            position: relative;
            letter-spacing: -0.01em;
        }

        .sidebar-nav .nav-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
            transition: var(--transition);
            opacity: 0.7;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-h);
        }

        .sidebar-nav .nav-link:hover i { opacity: 1; }

        .sidebar-nav .nav-link.active {
            background: var(--sidebar-active);
            color: var(--sidebar-accent);
        }

        .sidebar-nav .nav-link.active i {
            color: var(--sidebar-accent);
            opacity: 1;
        }

        .sidebar-nav .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 22%; bottom: 22%;
            width: 3px;
            border-radius: 0 3px 3px 0;
            background: var(--sidebar-accent);
            margin-left: -2px;
        }

        /* Sidebar footer */
        .sidebar-footer {
            border-top: 1px solid var(--sidebar-border);
            padding: 16px 12px;
            flex-shrink: 0;
        }

        .sidebar-footer-user {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 14px;
            border-radius: var(--radius-md);
            cursor: default;
        }

        .sidebar-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
            letter-spacing: -0.5px;
        }

        .sidebar-user-info { min-width: 0; }

        .sidebar-user-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
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
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(8px);
            background: rgba(255,255,255,0.92);
        }

        .topbar-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.3px;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1px;
        }

        .topbar-badge.admin {
            background: var(--primary-light);
            color: var(--primary);
        }

        .topbar-badge.medecin {
            background: #ecfdf5;
            color: #047857;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 18px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--topbar-border);
            background: #fff;
            color: var(--text-secondary);
            font-size: 0.8125rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-logout:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: #fef2f2;
        }

        /* ================================================================
           PAGE CONTENT
        ================================================================ */
        .page-content {
            flex: 1;
            padding: 32px;
        }

        /* ================================================================
           ALERTS
        ================================================================ */
        .alert {
            border: none;
            border-left: 4px solid transparent;
            border-radius: var(--radius-md);
            font-size: 0.8375rem;
            padding: 14px 18px;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .alert-success {
            background: #ecfdf5;
            border-left-color: #059669;
            color: #065f46;
        }

        .alert-danger {
            background: #fef2f2;
            border-left-color: #ef4444;
            color: #991b1b;
        }

        .alert-warning {
            background: #fffbeb;
            border-left-color: #f59e0b;
            color: #92400e;
        }

        .alert-info {
            background: var(--primary-light);
            border-left-color: var(--primary);
            color: var(--primary-dark);
        }

        /* ================================================================
           CARDS
        ================================================================ */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--card-border);
            padding: 18px 24px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0 !important;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }

        .card-header i {
            font-size: 15px;
            opacity: 0.7;
        }

        .card-header.bg-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header.bg-primary i { opacity: 1; }

        .card-header.bg-success {
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header.bg-success i { opacity: 1; }

        .card-header.bg-warning {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header.bg-warning i { opacity: 1; }

        .card-header.bg-danger {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header.bg-danger i { opacity: 1; }

        .card-header.bg-dark {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header.bg-dark i { opacity: 1; }

        .card-body { padding: 24px; }
        .card-body.p-0 { padding: 0; }

        /* ================================================================
           STAT CARDS (Dashboard)
        ================================================================ */
        .stat-card {
            border-radius: var(--radius-xl);
            padding: 24px 22px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
            transition: transform 0.25s cubic-bezier(.4,0,.2,1),
                        box-shadow 0.25s cubic-bezier(.4,0,.2,1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: -30px; right: 30px;
            width: 60px; height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .stat-card .fs-2 {
            font-size: 2.1rem !important;
            font-weight: 800;
            letter-spacing: -1.5px;
            line-height: 1;
            position: relative;
            z-index: 1;
        }

        .stat-card .small {
            font-size: 0.75rem;
            font-weight: 500;
            opacity: 0.85;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            position: relative;
            z-index: 1;
            letter-spacing: 0.01em;
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
            background: #f8fafc;
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--card-border);
            padding: 12px 18px;
            white-space: nowrap;
        }

        .table td {
            padding: 13px 18px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .table-hover tbody tr {
            transition: var(--transition);
        }

        .table-hover tbody tr:hover {
            background: #f8fafb;
        }

        .table tbody tr:last-child td { border-bottom: none; }

        .table-bordered {
            border: none;
        }

        .table-bordered th,
        .table-bordered td {
            border: none;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-bordered thead th {
            border-bottom: 1px solid var(--card-border);
        }

        /* ================================================================
           BUTTONS
        ================================================================ */
        .btn {
            font-size: 0.8375rem;
            font-weight: 500;
            border-radius: var(--radius-sm);
            padding: 8px 20px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            letter-spacing: -0.01em;
        }

        .btn-sm {
            padding: 5px 12px;
            font-size: 0.78rem;
            border-radius: 6px;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            box-shadow: 0 2px 8px rgba(15,118,110,0.25);
        }

        .btn-success {
            background: #059669;
            border-color: #059669;
        }

        .btn-success:hover {
            background: #047857;
            border-color: #047857;
            box-shadow: 0 2px 8px rgba(5,150,105,0.25);
        }

        .btn-warning {
            background: #d97706;
            border-color: #d97706;
            color: #fff;
        }

        .btn-warning:hover {
            background: #b45309;
            border-color: #b45309;
            color: #fff;
            box-shadow: 0 2px 8px rgba(217,119,6,0.25);
        }

        .btn-danger {
            background: #dc2626;
            border-color: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            box-shadow: 0 2px 8px rgba(220,38,38,0.25);
        }

        .btn-secondary {
            background: #e2e8f0;
            border-color: #e2e8f0;
            color: var(--text-secondary);
        }

        .btn-secondary:hover {
            background: #cbd5e1;
            border-color: #cbd5e1;
            color: var(--text-primary);
        }

        .btn-info {
            background: #0284c7;
            border-color: #0284c7;
            color: #fff;
        }

        .btn-info:hover {
            background: #0369a1;
            border-color: #0369a1;
            color: #fff;
            box-shadow: 0 2px 8px rgba(2,132,199,0.25);
        }

        .btn-dark {
            background: #1e293b;
            border-color: #1e293b;
        }

        .btn-dark:hover {
            background: #0f172a;
            border-color: #0f172a;
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .btn-outline-danger {
            color: #dc2626;
            border-color: #dc2626;
        }

        .btn-outline-danger:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
        }

        .btn-light {
            background: rgba(255,255,255,0.18);
            border-color: rgba(255,255,255,0.25);
            color: #fff;
        }

        .btn-light:hover {
            background: rgba(255,255,255,0.28);
            color: #fff;
        }

        /* ================================================================
           BADGES
        ================================================================ */
        .badge {
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: 999px;
            padding: 4px 12px;
            letter-spacing: 0.15px;
        }

        .badge.bg-primary { background: var(--primary) !important; }
        .badge.bg-success { background: #059669 !important; }
        .badge.bg-warning { background: #d97706 !important; color: #fff !important; }
        .badge.bg-danger { background: #dc2626 !important; }
        .badge.bg-info { background: #0284c7 !important; color: #fff !important; }
        .badge.bg-secondary { background: #64748b !important; }

        /* ================================================================
           FORM CONTROLS
        ================================================================ */
        .form-control,
        .form-select {
            border-radius: var(--radius-sm);
            border: 1px solid #cbd5e1;
            font-size: 0.8375rem;
            padding: 9px 14px;
            color: var(--text-primary);
            transition: var(--transition);
            background-color: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15,118,110,0.1);
        }

        .form-label {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        textarea.form-control {
            resize: vertical;
        }

        .input-group .form-control:first-child { border-radius: var(--radius-sm) 0 0 var(--radius-sm); }
        .input-group .btn:last-child { border-radius: 0 var(--radius-sm) var(--radius-sm) 0; }

        .invalid-feedback {
            font-size: 0.78rem;
            font-weight: 500;
        }

        /* ================================================================
           PAGINATION
        ================================================================ */
        .pagination {
            margin-top: 20px;
            gap: 4px;
        }

        .page-link {
            border-radius: var(--radius-sm) !important;
            border: 1px solid var(--card-border);
            font-size: 0.8125rem;
            color: var(--text-secondary);
            padding: 7px 13px;
            transition: var(--transition);
        }

        .page-link:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary-light);
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* ================================================================
           CUSTOM — PROFILE AVATAR IN TABLES
        ================================================================ */
        .avatar-circle {
            width: 40px; height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }

        .avatar-circle-lg {
            width: 120px; height: 120px;
            font-size: 40px;
        }

        .avatar-circle-md {
            width: 80px; height: 80px;
            font-size: 28px;
        }

        /* ================================================================
           CUSTOM — SECTION HEADERS IN DETAIL VIEWS
        ================================================================ */
        h5.fw-bold.border-bottom {
            color: var(--text-primary);
            font-size: 0.95rem;
            padding-bottom: 10px;
            border-color: var(--card-border) !important;
        }

        /* ================================================================
           CUSTOM — PRE BLOCKS
        ================================================================ */
        pre.bg-light {
            background: #f8fafc !important;
            border: 1px solid var(--card-border);
            font-size: 0.825rem;
            color: var(--text-primary);
        }

        /* ================================================================
           SCROLLBAR (body area)
        ================================================================ */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 6px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ================================================================
           ANIMATION — Fade In on Load
        ================================================================ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .page-content {
            animation: fadeInUp 0.3s cubic-bezier(.4,0,.2,1);
        }

        /* ================================================================
           RESPONSIVE
        ================================================================ */
        @media (max-width: 992px) {
            .sidebar { display: none; }
            .main-wrapper { margin-left: 0; }
            .page-content { padding: 20px; }
        }

        /* ================================================================
           CUSTOM COLOR HEADERS (for purple consultations)
        ================================================================ */
        .card-header[style*="background:#4527a0"],
        .card-header.bg-purple {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%) !important;
            color: #fff !important;
            border-bottom: none;
        }

        .card-header[style*="background:#4527a0"] i,
        .card-header.bg-purple i { opacity: 1; }

        /* ================================================================
           STAT CARD — Refined Color Gradients
        ================================================================ */
        .stat-card[style*="1a237e"] {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%) !important;
        }

        .stat-card[style*="00796b"] {
            background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%) !important;
        }

        .stat-card[style*="e65100"] {
            background: linear-gradient(135deg, #d97706 0%, #fbbf24 100%) !important;
        }

        .stat-card[style*="4527a0"] {
            background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%) !important;
        }

        .stat-card[style*="c62828"] {
            background: linear-gradient(135deg, #dc2626 0%, #f87171 100%) !important;
        }

        .stat-card[style*="2e7d32"] {
            background: linear-gradient(135deg, #059669 0%, #34d399 100%) !important;
        }
    </style>

    @yield('styles')
</head>
<body>

{{-- ================================================================
     SIDEBAR
================================================================ --}}
<aside class="sidebar" id="sidebar">
    {{-- Brand --}}
    <a class="sidebar-brand" href="#">
        <div class="sidebar-brand-icon">
            <i class="bi bi-hospital"></i>
        </div>
        <div>
            <span class="sidebar-brand-name">MediCore</span>
            <span class="sidebar-brand-sub">Systeme hospitalier</span>
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
                        <i class="bi bi-person-badge"></i> Medecins
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.rendez-vous.*') ? 'active' : '' }}"
                       href="{{ route('admin.rendez-vous.index') }}">
                        <i class="bi bi-calendar-check"></i> Rendez-vous
                    </a>
                </li>

                {{-- MEDICAL --}}
                <li><span class="sidebar-section">Medical</span></li>
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
                {{-- MEDECIN --}}
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
    <header class="topbar" id="topbar">
        <h1 class="topbar-title">@yield('page-title', 'MediCore')</h1>
        <div class="topbar-right">
            <span class="topbar-badge {{ auth()->user()->isAdmin() ? 'admin' : 'medecin' }}">
                <i class="bi bi-person-circle" style="font-size:14px"></i>
                {{ auth()->user()->isAdmin() ? 'Administrateur' : 'Medecin' }}
            </span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout" id="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Deconnexion
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