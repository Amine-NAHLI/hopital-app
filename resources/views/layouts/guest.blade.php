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
        :root {
            --primary: #4f46e5;
            --accent: #06b6d4;
            --secondary: #0f172a;
            --body-bg: #0f172a; /* Midnight Blue */
            --card-bg: rgba(255, 255, 255, 1);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--body-bg);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Abstract Background Elements */
        .bg-decor {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 20% 30%, rgba(79, 70, 229, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(6, 182, 212, 0.15) 0%, transparent 40%);
        }

        .auth-container {
            width: 100%;
            max-width: 460px;
            padding: 24px;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-box {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.4);
            transform: rotate(-5deg);
        }

        .logo-box i {
            font-size: 28px;
            color: white;
        }

        .auth-logo h1 {
            font-family: 'Sora', sans-serif;
            color: white;
            font-weight: 800;
            font-size: 1.85rem;
            letter-spacing: -0.03em;
            margin: 0;
        }

        .auth-logo p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            margin-top: 4px;
        }

        /* Card Stylings */
        .auth-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .auth-card label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--secondary);
            margin-bottom: 8px;
        }

        .auth-card input[type="text"],
        .auth-card input[type="email"],
        .auth-card input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: all 0.3s ease;
        }

        .auth-card input:focus {
            background: white;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .auth-card .btn-submit {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem;
            margin-top: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .auth-card .btn-submit:hover {
            background: #3730a3;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .auth-card a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .auth-card a:hover {
            text-decoration: underline;
        }

        /* Error States */
        .error-msg {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 6px;
            font-weight: 500;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.85rem !important;
            color: var(--text-muted) !important;
        }

        .checkbox-label input {
            width: 18px; height: 18px;
            accent-color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    
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
