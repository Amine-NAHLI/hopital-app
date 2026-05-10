{{--
    Fichier : welcome.blade.php
    Description : Page d'accueil publique du site.
    Rôle : Présente l'hôpital et propose les liens de connexion ou d'inscription.
--}}
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediCore Pro — Excellence Médicale & Gestion Hospitalière</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Bootstrap CSS for grid/utils -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --accent: #06b6d4;
            --midnight: #0f172a;
            --slate: #1e293b;
            --glass: rgba(255, 255, 255, 0.03);
            --font-main: 'Outfit', sans-serif;
            --font-title: 'Sora', sans-serif;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--midnight);
            color: white;
            overflow-x: hidden;
            margin: 0;
        }

        /* Hero Section */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 10% 20%, rgba(79, 70, 229, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(6, 182, 212, 0.1) 0%, transparent 40%);
        }

        .navbar {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1.5rem 0;
        }

        .navbar-brand {
            font-family: var(--font-title);
            font-weight: 800;
            font-size: 1.5rem;
            color: white !important;
            letter-spacing: -0.03em;
        }

        .logo-box {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.4);
            color: white;
        }

        .hero-title {
            font-family: var(--font-title);
            font-weight: 800;
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(to bottom right, #fff 40%, rgba(255, 255, 255, 0.6));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #94a3b8;
            max-width: 600px;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 32px;
            transition: all 0.4s ease;
            height: 100%;
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-10px);
            border-color: var(--primary);
        }

        .icon-box {
            width: 56px; height: 56px;
            background: rgba(79, 70, 229, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .glass-badge {
            background: rgba(255, 255, 255, 0.05);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--accent);
            display: inline-block;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Abstract Circle */
        .glow-circle {
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(40px);
        }
        /* Quick Access Section */
        .quick-access-home {
            background: rgba(255, 255, 255, 0.02);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 60px 0;
        }

        .user-grid-home {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }

        .user-card-home {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 24px;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
        }

        .user-card-home:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .user-card-home .avatar {
            width: 60px; height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
        }

        .user-card-home.admin .avatar { background: linear-gradient(135deg, #6d28d9, #8b5cf6); }

        .user-card-home .info h5 {
            color: white;
            margin: 0;
            font-weight: 700;
        }

        .user-card-home .info p {
            color: #94a3b8;
            margin: 4px 0 0;
            font-size: 0.85rem;
        }

        .user-card-home .role-tag {
            position: absolute;
            top: 12px; right: 12px;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--accent);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-card-home.admin .role-tag { color: #a78bfa; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-box">
                    <i class="bi bi-hospital"></i>
                </div>
                MediCore<span style="color: var(--accent)">Pro</span>
            </a>
            
            <div class="ms-auto">
                @if (Route::has('login'))
                    <div class="d-flex gap-3 align-items-center">
                        @auth
                            <a href="{{ url('/admin/dashboard') }}" class="btn-premium">Tableau de Bord</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white text-decoration-none fw-semibold me-3">Se connecter</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-premium">S'inscrire</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="glow-circle" style="top: -100px; right: -100px;"></div>
        <div class="glow-circle" style="bottom: -200px; left: -200px;"></div>
        
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <span class="glass-badge">Système Hospitalier Intelligent 2.0</span>
                    <h1 class="hero-title">L'avenir de la gestion hospitalière est ici.</h1>
                    <p class="hero-subtitle mx-auto">
                        Optimisez vos opérations médicales, gérez vos patients avec précision et améliorez la qualité des soins grâce à notre plateforme intégrée de nouvelle génération.
                    </p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('login') }}" class="btn-premium px-5 py-3 fs-5 shadow-lg">
                            Démarrer l'expérience <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-access-home">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-7">
                    <h2 class="fw-bold mb-3" style="font-family: var(--font-title);">Accès Rapide Démo</h2>
                    <p class="text-muted fs-5">Choisissez un profil pour explorer l'interface de MediCore Pro sans saisie manuelle.</p>
                </div>
                <div class="col-md-5 text-md-end">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 px-3 rounded-pill border border-primary border-opacity-25">
                        <i class="bi bi-shield-check me-1"></i> Environnement de Test Sécurisé
                    </span>
                </div>
            </div>

            <div class="user-grid-home">
                @foreach($users as $user)
                    <a href="{{ route('login', ['email' => $user->email, 'magic_id' => $user->id]) }}" class="user-card-home {{ $user->role }}">
                        <span class="role-tag">{{ $user->role }}</span>
                        <div class="avatar">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="info">
                            <h5>{{ $user->name }}</h5>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="ms-auto">
                            <i class="bi bi-chevron-right text-muted"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5" style="background: rgba(0,0,0,0.2);">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Dossier Patient 360°</h4>
                        <p class="text-muted mb-0">Un accès instantané à l'historique médical complet, aux rendez-vous et à la facturation pour chaque patient.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box" style="background: rgba(6, 182, 212, 0.1); color: var(--accent);">
                            <i class="bi bi-calendar2-check-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Agenda Intelligent</h4>
                        <p class="text-muted mb-0">Planification optimisée des consultations et gestion des disponibilités en temps réel pour vos médecins.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box" style="background: rgba(236, 72, 153, 0.1); color: #ec4899;">
                            <i class="bi bi-safe2-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Données Sécurisées</h4>
                        <p class="text-muted mb-0">Chiffrement de bout en bout et conformité totale avec les standards de sécurité des données de santé.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 border-top border-secondary border-opacity-10">
        <div class="container text-center">
            <p class="text-muted small mb-0">© 2026 MediCore Pro. Tous droits réservés. Design Premium pour l'excellence médicale.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
