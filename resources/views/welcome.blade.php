{{--
    Fichier : welcome.blade.php
    Description : Page d'accueil MediCore Nova — Futuriste & Claire.
--}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediCore Nova — L'excellence médicale augmentée</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.15);
            --secondary: #0ea5e9;
            --bg-nova: #f8fafc;
            --surface-nova: rgba(255, 255, 255, 0.85);
            --text-nova-main: #0f172a;
            --text-nova-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-nova);
            color: var(--text-nova-main);
            margin: 0;
            overflow-x: hidden;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 40%),
                radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.08) 0px, transparent 40%);
        }

        /* ── NAVBAR ─────────────────────────────────────────────────── */
        .navbar-nova {
            padding: 24px 0;
            background: rgba(248, 250, 252, 0.6);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            position: fixed;
            width: 100%;
            top: 0; z-index: 1000;
        }

        .brand-logo-box {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 22px;
            box-shadow: 0 8px 16px var(--primary-glow);
        }

        .brand-text-welcome {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.03em;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ── HERO ───────────────────────────────────────────────────── */
        .hero-nova {
            padding: 180px 0 100px;
            position: relative;
            text-align: center;
        }

        .floating-badge {
            background: white;
            padding: 8px 16px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--primary);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 32px;
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .hero-title-nova {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            line-height: 1.1;
            letter-spacing: -0.05em;
            color: var(--text-nova-main);
            margin-bottom: 24px;
        }

        .hero-subtitle-nova {
            font-size: 1.25rem;
            color: var(--text-nova-muted);
            max-width: 700px;
            margin: 0 auto 48px;
            line-height: 1.6;
        }

        .btn-nova-hero {
            padding: 18px 48px;
            border-radius: 20px;
            font-weight: 800;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .btn-nova-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 20px 40px var(--primary-glow);
        }

        .btn-nova-primary:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px var(--primary-glow);
            color: white;
        }

        /* ── FEATURE CARDS ─────────────────────────────────────────── */
        .features-nova { padding: 100px 0; }

        .feature-card-nova {
            background: white;
            border-radius: 32px;
            padding: 48px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card-nova:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.05);
            border-color: var(--primary);
        }

        .feature-icon-box {
            width: 64px; height: 64px;
            border-radius: 20px;
            background: var(--primary-glow);
            color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 32px;
        }

        /* ── QUICK ACCESS NOVA ─────────────────────────────────────── */
        .quick-access-nova {
            padding: 100px 0;
            background: white;
            position: relative;
        }

        .user-card-nova {
            background: var(--bg-nova);
            border-radius: 24px;
            padding: 24px;
            text-decoration: none;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            gap: 20px;
            border: 1px solid transparent;
        }

        .user-card-nova:hover {
            background: white;
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            transform: translateY(-5px);
        }

        .user-avatar-nova {
            width: 56px; height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 800; font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar-nova">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="d-flex align-items-center gap-3 text-decoration-none">
                <div class="brand-logo-box">
                    <i class="bi bi-hospital"></i>
                </div>
                <span class="brand-text-welcome">MediCore Nova</span>
            </a>
            
            <div class="d-flex gap-4 align-items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-nova-hero btn-nova-primary py-2 px-4 fs-6">Tableau de Bord</a>
                @else
                    <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none">Connexion</a>
                    <a href="{{ route('register') }}" class="btn-nova-hero btn-nova-primary py-2 px-4 fs-6">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <header class="hero-nova">
        <div class="container">
            <div class="floating-badge">
                <i class="bi bi-cpu"></i> IA & Gestion Médicale Nouvelle Génération
            </div>
            <h1 class="hero-title-nova">L'avenir de la santé,<br>conçu pour aujourd'hui.</h1>
            <p class="hero-subtitle-nova">
                MediCore Nova redéfinit l'expérience hospitalière avec une interface fluide, une gestion intelligente des patients et des outils décisionnels de pointe.
            </p>
            <div class="d-flex justify-content-center gap-4">
                <a href="{{ route('login') }}" class="btn-nova-hero btn-nova-primary">
                    Démarrer l'Expérience <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </header>

    <section class="quick-access-nova">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold h1" style="font-family: 'Sora', sans-serif;">Accès Instantané</h2>
                <p class="text-muted">Explorez les différents rôles de la plateforme en un clic.</p>
            </div>
            <div class="row g-4">
                @foreach($users as $user)
                    <div class="col-md-3">
                        <a href="{{ route('login', ['email' => $user->email, 'magic_id' => $user->id]) }}" class="user-card-nova">
                            <div class="user-avatar-nova">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark">{{ $user->name }}</span>
                                <span class="text-muted small text-uppercase fw-bold">{{ $user->role }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="features-nova">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="feature-card-nova">
                        <div class="feature-icon-box">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Sécurité Absolue</h4>
                        <p class="text-muted mb-0">Vos données médicales sont protégées par les standards de chiffrement les plus élevés de l'industrie.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card-nova">
                        <div class="feature-icon-box" style="background: rgba(14, 165, 233, 0.1); color: var(--secondary);">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Performance Fluid</h4>
                        <p class="text-muted mb-0">Une interface ultra-réactive conçue pour minimiser le temps de saisie et maximiser le temps de soin.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card-nova">
                        <div class="feature-icon-box" style="background: rgba(244, 63, 94, 0.1); color: #f43f5e;">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Vision 360°</h4>
                        <p class="text-muted mb-0">Suivez l'historique complet de vos patients à travers un dossier médical numérique unifié.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 text-center text-muted border-top bg-white">
        <p class="mb-0 fw-bold">© 2026 MediCore Nova. L'excellence au service de la vie.</p>
    </footer>
</body>
</html>
