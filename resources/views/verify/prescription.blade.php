<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification Ordonnance - MediCore Nova</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-verify {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
            padding: 40px 30px;
            text-align: center;
            max-width: 450px;
            width: 90%;
        }
        .success-icon {
            width: 100px;
            height: 100px;
            background-color: #dcfce7;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 20px auto;
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        .app-title {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            color: #1e293b;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        .app-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }
        .status-badge {
            display: inline-block;
            background: #16a34a;
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }
        .info-box {
            background: #f1f5f9;
            border-radius: 16px;
            padding: 20px;
            text-align: left;
            margin-bottom: 20px;
        }
        .info-item {
            margin-bottom: 12px;
        }
        .info-item:last-child {
            margin-bottom: 0;
        }
        .info-label {
            color: #64748b;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            display: block;
            margin-bottom: 2px;
        }
        .info-value {
            color: #0f172a;
            font-weight: 700;
            font-size: 1.05rem;
        }
        @keyframes popIn {
            0% { transform: scale(0); opacity: 0; }
            80% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="card-verify">
        <div class="success-icon">
            <i class="bi bi-shield-fill-check"></i>
        </div>
        
        <h1 class="app-title">MediCore Nova</h1>
        <p class="app-subtitle">Système de Traçabilité e-Santé</p>

        <div class="status-badge">
            <i class="bi bi-check-circle-fill me-1"></i> Ordonnance Valide
        </div>

        <p class="text-muted small mb-4">
            Ce document est authentique et a bien été émis par notre système d'information hospitalier.
        </p>

        <div class="info-box">
            <div class="info-item">
                <span class="info-label">Statut de Validation</span>
                <span class="info-value text-success"><i class="bi bi-check2-all"></i> Certifié Conforme</span>
            </div>
            <div class="info-item">
                <span class="info-label">Date de Vérification</span>
                <span class="info-value">{{ date('d/m/Y à H:i') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Référence Sécurisée</span>
                <span class="info-value" style="font-family: monospace; color: #475569;">#{{ strtoupper(substr($id, 0, 8)) }}</span>
            </div>
        </div>

        <div class="mt-4">
            <a href="#" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-semibold" style="border-width: 2px;" onclick="window.close(); return false;">
                Fermer
            </a>
        </div>
        
        <div class="mt-4 pt-3 border-top text-muted" style="font-size: 0.75rem;">
            Sécurisé par la technologie Llama 3.3 LPU & MediCore
        </div>
    </div>

</body>
</html>
