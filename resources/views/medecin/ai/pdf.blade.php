<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Clinique IA — MediCore</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.5;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }
        .header {
            border-bottom: 3px solid #6366f1;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .ordonnance-header {
            border-bottom: 3px solid #0d9488;
        }
        .logo-title {
            font-size: 26px;
            font-weight: bold;
            color: #6366f1;
            margin: 0;
        }
        .ordonnance-title {
            color: #0d9488;
        }
        .sub-title {
            font-size: 14px;
            color: #64748b;
            margin-top: 5px;
        }
        .info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
        }
        .info-table {
            width: 100%;
            font-size: 13px;
        }
        .info-table td {
            padding: 4px 8px;
        }
        .info-label {
            font-weight: bold;
            color: #475569;
            width: 130px;
        }
        .doc-type-badge {
            display: inline-block;
            padding: 6px 14px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #6366f1;
            border-radius: 4px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .badge-ordonnance { background-color: #0d9488; }
        .badge-diagnostic { background-color: #6366f1; }
        .badge-compte-rendu { background-color: #2563eb; }
        .badge-vulgarisation { background-color: #0284c7; }

        .content-box {
            background-color: #ffffff;
            margin-top: 10px;
        }
        .content-box h1, .content-box h2, .content-box h3 {
            color: #0f172a;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 5px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .content-box h2 { font-size: 18px; color: #4338ca; }
        .content-box ul, .content-box ol { padding-left: 20px; }
        .content-box li { margin-bottom: 6px; }

        .footer {
            margin-top: 50px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            font-size: 11px;
            color: #94a3b8;
            text-align: center;
        }
        .signature-box {
            margin-top: 60px;
            float: right;
            width: 250px;
            text-align: center;
            border-top: 1px dashed #94a3b8;
            padding-top: 10px;
            font-size: 13px;
            color: #475569;
        }
    </style>
</head>
<body>

    <div class="header {{ $type == 'ordonnance' ? 'ordonnance-header' : '' }}">
        <table width="100%">
            <tr>
                <td>
                    <h1 class="logo-title {{ $type == 'ordonnance' ? 'ordonnance-title' : '' }}">
                        {{ $type == 'ordonnance' ? '✚ ORDONNANCE MÉDICALE' : 'HÔPITAL MEDICORE NOVA' }}
                    </h1>
                    <div class="sub-title">Système d'Assistance Clinique Avancée (IA Groq LPU)</div>
                </td>
                <td align="right" style="font-size: 13px; color: #475569;">
                    <strong>{{ $medecin->user->nom_complet ?? 'Dr. Médecin' }}</strong><br>
                    Spécialité : {{ $medecin->specialite ?? 'Praticien Hospitalier' }}<br>
                    Date : {{ date('d/m/Y') }}
                </td>
            </tr>
        </table>
    </div>

    @php
        $badgeClass = 'badge-diagnostic';
        $docTitle = 'Avis Diagnostique Expert';
        if ($type == 'ordonnance') { $badgeClass = 'badge-ordonnance'; $docTitle = 'Prescription Assistée'; }
        if ($type == 'compte_rendu') { $badgeClass = 'badge-compte-rendu'; $docTitle = 'Compte-rendu Hospitalier'; }
        if ($type == 'vulgarisation') { $badgeClass = 'badge-vulgarisation'; $docTitle = 'Fiche d\'Information Patient'; }
    @endphp

    <div class="doc-type-badge {{ $badgeClass }}">
        {{ $docTitle }}
    </div>

    <div class="info-box">
        <table class="info-table">
            <tr>
                <td class="info-label">Dossier / Patient :</td>
                <td><strong>{{ $patientInfo ?? 'Non spécifié' }}</strong></td>
                <td class="info-label">Service :</td>
                <td>Consultation Générale</td>
            </tr>
            <tr>
                <td class="info-label">Observations :</td>
                <td colspan="3" style="font-style: italic; color: #64748b;">
                    "{{ substr($notes ?? 'Aucune note initiale', 0, 150) }}{{ strlen($notes ?? '') > 150 ? '...' : '' }}"
                </td>
            </tr>
        </table>
    </div>

    <div class="content-box">
        {!! $htmlContent !!}
    </div>

    @if($type == 'ordonnance')
        <div style="margin-top: 40px;">
            <table width="100%">
                <tr>
                    <td width="30%" valign="bottom" style="text-align: left; padding-left: 20px;">
                        @if(isset($qrCodeBase64))
                            <img src="data:image/svg+xml;base64, {!! $qrCodeBase64 !!}" style="width: 100px; height: 100px;">
                            <div style="font-size: 10px; color: #94a3b8; margin-top: 5px;">Scan de vérification<br>d'authenticité</div>
                        @endif
                    </td>
                    <td width="70%" valign="bottom">
                        <div class="signature-box" style="margin-top: 0; border-top: none; float: right; border-bottom: 1px dashed #94a3b8; padding-bottom: 40px; margin-bottom: 10px;">
                            Signature & Cachet du Médecin<br>
                            <strong>{{ $medecin->user->nom_complet ?? '' }}</strong>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="clear: both;"></div>
    @endif

    <div class="footer">
        Hôpital MediCore Nova — Document généré le {{ date('d/m/Y à H:i') }} par IA Clinique (Llama 3.3).<br>
        Avertissement : Ce rapport est une assistance numérique à valider sous la responsabilité exclusive du praticien.
    </div>

</body>
</html>
