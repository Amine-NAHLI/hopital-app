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

    <title>{{ config('app.name', 'MediCore Pro') }} — Portail</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ============================================================
           MediCore Pro — Auth Pages Design System v2.1
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
            overflow-x: hidden;
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

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        .orb-1 { width: 420px; height: 420px; background: radial-gradient(circle, rgba(79, 70, 229, 0.18) 0%, transparent 70%); top: -120px; left: -120px; animation: orb-float 14s ease-in-out infinite; }
        .orb-2 { width: 380px; height: 380px; background: radial-gradient(circle, rgba(6, 182, 212, 0.14) 0%, transparent 70%); bottom: -100px; right: -100px; animation: orb-float 18s ease-in-out infinite reverse; }
        .orb-3 { width: 260px; height: 260px; background: radial-gradient(circle, rgba(168, 85, 247, 0.12) 0%, transparent 70%); top: 50%; right: 15%; animation: orb-float 22s ease-in-out infinite 4s; }

        @keyframes orb-float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(30px, -40px) scale(1.04); }
            66%       { transform: translate(-20px, 30px) scale(0.97); }
        }

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
            max-width: 1200px;
            padding: 40px 24px;
            position: relative;
            z-index: 10;
            margin: 0 auto;
        }

        /* === Auth Logo Component === */
        .auth-logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-box {
            width: 68px; height: 68px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.45);
            transform: rotate(-5deg);
        }

        .logo-box i { font-size: 30px; color: white; }

        .auth-logo h1 {
            font-family: 'Sora', sans-serif;
            color: white;
            font-weight: 800;
            font-size: 1.9rem;
            margin: 0;
        }

        /* === Auth Card Component (to be used in views) === */
        .auth-card {
            background: white;
            border-radius: 24px;
            padding: 44px 40px;
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.55);
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 470px;
            margin: 0 auto;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        /* Common Form Elements */
        label { display: block; font-weight: 600; font-size: 0.83rem; color: var(--secondary); margin-bottom: 8px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px;
            font-family: 'Outfit', sans-serif; font-size: 0.9rem; transition: all 0.25s ease; outline: none;
        }
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.09); background: white; }
        
        .btn-submit {
            width: 100%; background: linear-gradient(135deg, var(--primary) 0%, #6366f1 100%); color: white; border: none;
            padding: 14px; border-radius: 12px; font-weight: 700; font-family: 'Sora', sans-serif; cursor: pointer;
            transition: all 0.25s ease; box-shadow: 0 4px 16px rgba(79, 70, 229, 0.35); display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79, 70, 229, 0.45); color: white; }

        .error-msg { color: #ef4444; font-size: 0.79rem; margin-top: 6px; font-weight: 500; }
        
        .checkbox-label { display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.84rem; color: var(--text-muted); }
        .checkbox-label input { width: 17px; height: 17px; accent-color: var(--primary); }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="auth-container">
        {{ $slot }}
    </div>
</body>
</html>
