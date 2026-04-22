<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="MediCore - Connexion au systeme hospitalier">

        <title>{{ config('app.name', 'MediCore') }} — Connexion</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            *, *::before, *::after { box-sizing: border-box; }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #0c1425;
                color: #0f172a;
                margin: 0;
                min-height: 100vh;
                -webkit-font-smoothing: antialiased;
            }

            .auth-wrapper {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 24px;
                position: relative;
                overflow: hidden;
            }

            /* Subtle background pattern */
            .auth-wrapper::before {
                content: '';
                position: absolute;
                top: -50%; left: -50%;
                width: 200%; height: 200%;
                background: radial-gradient(ellipse at 30% 20%, rgba(15,118,110,0.15) 0%, transparent 50%),
                            radial-gradient(ellipse at 70% 80%, rgba(20,184,166,0.1) 0%, transparent 50%);
                z-index: 0;
            }

            .auth-container {
                width: 100%;
                max-width: 440px;
                position: relative;
                z-index: 1;
            }

            /* Brand Header */
            .auth-brand {
                text-align: center;
                margin-bottom: 32px;
            }

            .auth-brand-icon {
                width: 52px; height: 52px;
                background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
                border-radius: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 16px;
                box-shadow: 0 4px 16px rgba(20,184,166,0.3);
            }

            .auth-brand-icon i {
                font-size: 24px;
                color: #fff;
            }

            .auth-brand h1 {
                font-size: 1.6rem;
                font-weight: 800;
                color: #ffffff;
                letter-spacing: -0.5px;
                margin: 0;
            }

            .auth-brand p {
                font-size: 0.85rem;
                color: rgba(255,255,255,0.45);
                margin: 4px 0 0 0;
                font-weight: 400;
            }

            /* Card */
            .auth-card {
                background: #ffffff;
                border-radius: 16px;
                padding: 36px 32px;
                box-shadow: 0 4px 24px rgba(0,0,0,0.15), 0 16px 56px rgba(0,0,0,0.1);
            }

            /* Override Breeze defaults */
            .auth-card label {
                font-size: 0.8125rem;
                font-weight: 600;
                color: #0f172a;
                margin-bottom: 6px;
                display: block;
            }

            .auth-card input[type="text"],
            .auth-card input[type="email"],
            .auth-card input[type="password"] {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid #cbd5e1;
                border-radius: 8px;
                font-size: 0.875rem;
                font-family: 'Inter', sans-serif;
                color: #0f172a;
                transition: border-color 0.2s, box-shadow 0.2s;
                outline: none;
                background: #fff;
            }

            .auth-card input[type="text"]:focus,
            .auth-card input[type="email"]:focus,
            .auth-card input[type="password"]:focus {
                border-color: #0f766e;
                box-shadow: 0 0 0 3px rgba(15,118,110,0.1);
            }

            .auth-card input[type="checkbox"] {
                accent-color: #0f766e;
            }

            .auth-card button[type="submit"],
            .auth-card .primary-button {
                background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
                color: #fff;
                border: none;
                padding: 10px 24px;
                border-radius: 8px;
                font-size: 0.875rem;
                font-weight: 600;
                font-family: 'Inter', sans-serif;
                cursor: pointer;
                transition: all 0.2s;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .auth-card button[type="submit"]:hover {
                box-shadow: 0 4px 16px rgba(15,118,110,0.3);
                transform: translateY(-1px);
            }

            .auth-card a {
                color: #0f766e;
                font-size: 0.8125rem;
                transition: color 0.2s;
            }

            .auth-card a:hover {
                color: #115e59;
            }

            .auth-card .text-sm { font-size: 0.8125rem; }
            .auth-card .text-gray-600 { color: #64748b; }

            .auth-card .mt-4 { margin-top: 20px; }
            .auth-card .mt-2 { margin-top: 8px; }
            .auth-card .ms-2, .auth-card .ms-3, .auth-card .ms-4 { margin-left: 12px; }
            .auth-card .mb-4 { margin-bottom: 16px; }

            /* Error messages */
            .auth-card .text-red-600,
            .auth-card [class*="text-red"] {
                color: #dc2626;
                font-size: 0.78rem;
                font-weight: 500;
            }

            @keyframes fadeInAuth {
                from { opacity: 0; transform: translateY(12px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            .auth-container {
                animation: fadeInAuth 0.4s ease;
            }
        </style>
    </head>
    <body>
        <div class="auth-wrapper">
            <div class="auth-container">
                <div class="auth-brand">
                    <div class="auth-brand-icon">
                        <i class="bi bi-hospital"></i>
                    </div>
                    <h1>MediCore</h1>
                    <p>Systeme de gestion hospitaliere</p>
                </div>

                <div class="auth-card">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
