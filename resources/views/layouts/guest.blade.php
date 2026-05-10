{{--
    Fichier : guest.blade.php
    Description : Layout public futuriste (Thème Clair) pour MediCore Pro Nova.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'MediCore Nova'))</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icons & Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.15);
            --secondary: #0ea5e9;
            --bg-nova: #f8fafc;
            --text-nova-main: #0f172a;
            --text-nova-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-nova);
            color: var(--text-nova-main);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.1) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(244, 63, 94, 0.05) 0px, transparent 50%);
        }

        /* Ambient floating elements */
        .ambient-shape {
            position: absolute;
            z-index: -1;
            filter: blur(80px);
            border-radius: 50%;
            opacity: 0.4;
        }

        .shape-1 { width: 400px; height: 400px; background: var(--primary); top: -100px; left: -100px; animation: float 15s infinite; }
        .shape-2 { width: 300px; height: 300px; background: var(--secondary); bottom: -50px; right: -50px; animation: float 20s infinite reverse; }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 30px) scale(1.1); }
        }

        .auth-container {
            width: 100%;
            max-width: 1100px;
            padding: 40px 24px;
            z-index: 10;
        }

        .auth-card-nova {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 32px;
            padding: 48px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }

        .logo-nova-guest {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            color: white; font-size: 32px;
            box-shadow: 0 10px 20px var(--primary-glow);
        }

        .brand-text-guest {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            text-align: center;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            display: block;
        }

        /* Form elements */
        label { font-weight: 600; font-size: 0.85rem; color: var(--text-nova-muted); margin-bottom: 8px; display: block; }
        input {
            width: 100%; padding: 14px 20px; border-radius: 16px; border: 1px solid rgba(226, 232, 240, 0.8);
            background: white; transition: all 0.3s ease; font-weight: 500;
        }
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px var(--primary-glow); outline: none; }

        .btn-nova-auth {
            width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;
            padding: 16px; border-radius: 16px; border: none; font-weight: 700; font-size: 1rem;
            margin-top: 12px; transition: all 0.3s ease; box-shadow: 0 10px 20px var(--primary-glow);
        }
        .btn-nova-auth:hover { transform: translateY(-2px); box-shadow: 0 15px 25px var(--primary-glow); color: white; }
    </style>
</head>
<body>
    <div class="ambient-shape shape-1"></div>
    <div class="ambient-shape shape-2"></div>

    <div class="auth-container">
        {{ $slot }}
    </div>
</body>
</html>
