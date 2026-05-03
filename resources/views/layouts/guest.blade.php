{{--
    Fichier : guest.blade.php
    Description : Layout pour les pages d'authentification (connexion, inscription).
    Rôle : Fournit une interface simplifiée pour les utilisateurs non connectés.
--}}
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="MediCore Pro - Authentification Sécurisée">

    <title>{{ config('app.name', 'MediCore Pro') }} — Connexion</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ============================================================
           MediCore Pro — Auth Pages Design System v2.0
           ============================================================ */
        :root {
            --primary: #4f46e5;
            --accent: #06b6d4;
            --secondary: #0f172a;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: #080f1f;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* === Layered Background === */
        .bg-decor {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse at 15% 25%, rgba(79, 70, 229, 0.2) 0%, transparent 45%),
                radial-gradient(ellipse at 85% 75%, rgba(6, 182, 212, 0.18) 0%, transparent 45%),
                radial-gradient(ellipse at 50% 100%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
        }

        /* Animated floating orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        .orb-1 {
            width: 420px; height: 420px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.18) 0%, transparent 70%);
            top: -120px; left: -120px;
            animation: orb-float 14s ease-in-out infinite;
        }

        .orb-2 {
            width: 380px; height: 380px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.14) 0%, transparent 70%);
            bottom: -100px; right: -100px;
            animation: orb-float 18s ease-in-out infinite reverse;
        }

        .orb-3 {
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.12) 0%, transparent 70%);
            top: 50%; right: 15%;
            animation: orb-float 22s ease-in-out infinite 4s;
        }

        @keyframes orb-float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(30px, -40px) scale(1.04); }
            66%       { transform: translate(-20px, 30px) scale(0.97); }
        }

        /* === Dot grid background pattern === */
        .bg-decor::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* === Auth Container === */
        .auth-container {
            width: 100%;
            max-width: 470px;
            padding: 24px;
            position: relative;
            z-index: 10;
            animation: auth-enter 0.65s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes auth-enter {
            from { opacity: 0; transform: translateY(32px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* === Logo Area === */
        .auth-logo {
            text-align: center;
            margin-bottom: 36px;
        }

        .logo-box {
            width: 68px; height: 68px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.45), 0 0 0 1px rgba(255,255,255,0.08);
            transform: rotate(-5deg);
            position: relative;
        }

        /* Glowing halo around logo */
        .logo-box::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 26px;
            border: 1.5px solid rgba(79, 70, 229, 0.3);
            animation: halo-pulse 3s ease-in-out infinite;
        }

        @keyframes halo-pulse {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50%       { opacity: 0.15; transform: scale(1.1); }
        }

        .logo-box i { font-size: 30px; color: white; }

        .auth-logo h1 {
            font-family: 'Sora', sans-serif;
            color: white;
            font-weight: 800;
            font-size: 1.9rem;
            letter-spacing: -0.04em;
            margin: 0 0 6px;
        }

        .auth-logo p {
            color: rgba(255, 255, 255, 0.42);
            font-size: 0.875rem;
            margin: 0;
        }

        /* === Auth Card === */
        .auth-card {
            background: rgba(255, 255, 255, 0.99);
            border-radius: 24px;
            padding: 44px 40px;
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.06),
                0 30px 60px -10px rgba(0, 0, 0, 0.55),
                0 10px 20px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        /* Subtle top gradient accent on card */
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent), #a78bfa);
        }

        .auth-card label {
            display: block;
            font-weight: 600;
            font-size: 0.83rem;
            color: var(--secondary);
            margin-bottom: 8px;
        }

        .auth-card input[type="text"],
        .auth-card input[type="email"],
        .auth-card input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            color: var(--text-main);
            transition: all 0.25s ease;
            outline: none;
        }

        .auth-card input:focus {
            background: white;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.09);
        }

        .auth-card input::placeholder { color: #94a3b8; }

        /* === Submit Button === */
        .auth-card .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, #6366f1 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-family: 'Sora', sans-serif;
            font-size: 0.92rem;
            margin-top: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 16px rgba(79, 70, 229, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .auth-card .btn-submit:hover {
            background: linear-gradient(135deg, #3730a3 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.45);
            color: white;
        }

        .auth-card .btn-submit:active { transform: translateY(0); }

        /* === Links === */
        .auth-card a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-card a:hover { color: #3730a3; text-decoration: underline; }

        /* === Error Messages === */
        .error-msg {
            color: #ef4444;
            font-size: 0.79rem;
            margin-top: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* === Checkbox === */
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.84rem !important;
            color: var(--text-muted) !important;
            font-weight: 500 !important;
        }

        .checkbox-label input {
            width: 17px; height: 17px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        /* === Session status === */
        .auth-card .session-status {
            background: #f0fdf4;
            border-left: 3px solid #10b981;
            color: #065f46;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="auth-container">
        <div class="auth-logo">
            <div class="logo-box">
                <i class="bi bi-hospital"></i>
            </div>
            <h1>MediCore<span style="color: var(--accent)">Pro</span></h1>
            <p>Portail de Gestion Hospitalière</p>
        </div>

        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
