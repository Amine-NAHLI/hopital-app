<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MediCore Nova — Enterprise Hospital Solution</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #050d14;
    --surface: #0a1726;
    --surface2: #0f2035;
    --border: rgba(0, 200, 160, 0.12);
    --border-bright: rgba(0, 200, 160, 0.3);
    --accent: #00c8a0;
    --accent2: #0090ff;
    --accent3: #ff5c7a;
    --text: #e8f4f0;
    --text-muted: #7a9e99;
    --text-dim: #3d6060;
    --red: #ff4d6d;
    --amber: #ffc246;
    --font-head: 'Syne', sans-serif;
    --font-body: 'DM Sans', sans-serif;
  }

_, _::before, \*::after { box-sizing: border-box; margin: 0; padding: 0; }

html { scroll-behavior: smooth; }

body {
background: var(--bg);
color: var(--text);
font-family: var(--font-body);
font-size: 15px;
line-height: 1.75;
overflow-x: hidden;
}

/_ Grid texture _/
body::before {
content: '';
position: fixed;
inset: 0;
background-image:
linear-gradient(rgba(0,200,160,0.03) 1px, transparent 1px),
linear-gradient(90deg, rgba(0,200,160,0.03) 1px, transparent 1px);
background-size: 40px 40px;
pointer-events: none;
z-index: 0;
}

.container {
max-width: 960px;
margin: 0 auto;
padding: 0 2rem;
position: relative;
z-index: 1;
}

/_ ── HERO ── _/
.hero {
padding: 7rem 0 5rem;
text-align: center;
position: relative;
}

.hero::after {
content: '';
position: absolute;
top: 30%;
left: 50%;
transform: translateX(-50%);
width: 600px;
height: 300px;
background: radial-gradient(ellipse, rgba(0,200,160,0.08) 0%, transparent 70%);
pointer-events: none;
}

.hero-eyebrow {
display: inline-flex;
align-items: center;
gap: 8px;
font-family: var(--font-body);
font-size: 11px;
font-weight: 500;
letter-spacing: 0.18em;
text-transform: uppercase;
color: var(--accent);
border: 1px solid var(--border-bright);
padding: 6px 16px;
border-radius: 100px;
margin-bottom: 2rem;
background: rgba(0,200,160,0.05);
}

.hero-eyebrow::before {
content: '';
width: 6px;
height: 6px;
border-radius: 50%;
background: var(--accent);
animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
0%, 100% { opacity: 1; transform: scale(1); }
50% { opacity: 0.4; transform: scale(0.7); }
}

.hero h1 {
font-family: var(--font-head);
font-size: clamp(3rem, 8vw, 5.5rem);
font-weight: 800;
line-height: 1.0;
letter-spacing: -0.03em;
margin-bottom: 1.5rem;
}

.hero h1 span.grad {
background: linear-gradient(135deg, var(--accent) 0%, var(--accent2) 100%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-clip: text;
}

.hero-sub {
max-width: 580px;
margin: 0 auto 2.5rem;
color: var(--text-muted);
font-size: 16px;
font-weight: 300;
line-height: 1.8;
}

.hero-badges {
display: flex;
flex-wrap: wrap;
justify-content: center;
gap: 10px;
margin-bottom: 3rem;
}

.badge {
font-family: var(--font-body);
font-size: 11px;
font-weight: 500;
letter-spacing: 0.08em;
padding: 5px 14px;
border-radius: 100px;
border: 1px solid;
}

.badge-laravel { color: #ff6b6b; border-color: rgba(255,107,107,0.3); background: rgba(255,107,107,0.06); }
.badge-react { color: #61dafb; border-color: rgba(97,218,251,0.3); background: rgba(97,218,251,0.06); }
.badge-tailwind { color: #38bdf8; border-color: rgba(56,189,248,0.3); background: rgba(56,189,248,0.06); }
.badge-chartjs { color: #ff6384; border-color: rgba(255,99,132,0.3); background: rgba(255,99,132,0.06); }
.badge-sec { color: var(--accent); border-color: var(--border-bright); background: rgba(0,200,160,0.06); }

.hero-cta {
display: flex;
justify-content: center;
gap: 12px;
flex-wrap: wrap;
}

.btn {
font-family: var(--font-body);
font-size: 13px;
font-weight: 500;
padding: 10px 24px;
border-radius: 8px;
text-decoration: none;
border: 1px solid;
cursor: pointer;
transition: all 0.2s;
letter-spacing: 0.03em;
}

.btn-primary {
background: var(--accent);
color: #020c0a;
border-color: var(--accent);
}

.btn-primary:hover { background: #00deb3; border-color: #00deb3; }

.btn-ghost {
background: transparent;
color: var(--text-muted);
border-color: var(--border-bright);
}

.btn-ghost:hover { color: var(--text); border-color: rgba(0,200,160,0.5); }

/_ ── DIVIDER ── _/
.divider {
height: 1px;
background: linear-gradient(90deg, transparent, var(--border-bright), transparent);
margin: 0;
}

/_ ── SECTION ── _/
section {
padding: 5rem 0;
}

.section-label {
font-family: var(--font-body);
font-size: 10px;
font-weight: 500;
letter-spacing: 0.2em;
text-transform: uppercase;
color: var(--text-dim);
margin-bottom: 0.5rem;
}

.section-title {
font-family: var(--font-head);
font-size: clamp(1.6rem, 3vw, 2.2rem);
font-weight: 700;
line-height: 1.2;
letter-spacing: -0.02em;
margin-bottom: 0.75rem;
}

.section-desc {
color: var(--text-muted);
max-width: 520px;
font-size: 14px;
font-weight: 300;
margin-bottom: 3rem;
}

/_ ── GEMS (Joyaux) ── _/
.gems-grid {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
gap: 1.5px;
background: var(--border);
border: 1px solid var(--border);
border-radius: 16px;
overflow: hidden;
}

.gem-card {
background: var(--surface);
padding: 2rem;
position: relative;
transition: background 0.3s;
}

.gem-card:hover { background: var(--surface2); }

.gem-icon {
font-size: 28px;
margin-bottom: 1rem;
display: block;
line-height: 1;
}

.gem-num {
position: absolute;
top: 1.5rem;
right: 1.5rem;
font-family: var(--font-head);
font-size: 52px;
font-weight: 800;
color: rgba(0,200,160,0.04);
line-height: 1;
user-select: none;
}

.gem-card h3 {
font-family: var(--font-head);
font-size: 1rem;
font-weight: 700;
margin-bottom: 0.6rem;
color: var(--text);
}

.gem-card p {
font-size: 13.5px;
color: var(--text-muted);
font-weight: 300;
line-height: 1.7;
}

.gem-tag {
display: inline-block;
margin-top: 1rem;
font-size: 10px;
font-weight: 500;
letter-spacing: 0.1em;
text-transform: uppercase;
padding: 3px 10px;
border-radius: 100px;
}

.tag-ai { background: rgba(0,144,255,0.1); color: var(--accent2); border: 1px solid rgba(0,144,255,0.2); }
.tag-sec { background: rgba(0,200,160,0.08); color: var(--accent); border: 1px solid var(--border-bright); }
.tag-data { background: rgba(255,194,70,0.08); color: var(--amber); border: 1px solid rgba(255,194,70,0.2); }

/_ ── FEATURES ── _/
.features-grid {
display: grid;
grid-template-columns: 1fr 1fr;
gap: 1px;
background: var(--border);
border: 1px solid var(--border);
border-radius: 16px;
overflow: hidden;
}

.feat-block {
background: var(--surface);
padding: 2.5rem 2rem;
}

.feat-block:hover { background: var(--surface2); }

.feat-header {
display: flex;
align-items: center;
gap: 12px;
margin-bottom: 1.5rem;
}

.feat-icon-wrap {
width: 40px;
height: 40px;
border-radius: 10px;
display: flex;
align-items: center;
justify-content: center;
font-size: 20px;
flex-shrink: 0;
}

.icon-admin { background: rgba(0,200,160,0.1); border: 1px solid var(--border-bright); }
.icon-doctor { background: rgba(0,144,255,0.1); border: 1px solid rgba(0,144,255,0.2); }

.feat-block h3 {
font-family: var(--font-head);
font-size: 1rem;
font-weight: 700;
color: var(--text);
}

.feat-list {
list-style: none;
}

.feat-list li {
font-size: 13.5px;
color: var(--text-muted);
font-weight: 300;
padding: 0.45rem 0;
border-bottom: 1px solid var(--border);
display: flex;
align-items: flex-start;
gap: 10px;
}

.feat-list li:last-child { border-bottom: none; }

.feat-list li::before {
content: '→';
color: var(--accent);
flex-shrink: 0;
font-size: 12px;
margin-top: 2px;
}

/_ ── STACK ── _/
.stack-grid {
display: grid;
grid-template-columns: 1fr 1fr;
gap: 1.5rem;
}

.stack-panel {
border: 1px solid var(--border);
border-radius: 14px;
padding: 1.75rem;
background: var(--surface);
}

.stack-panel h4 {
font-family: var(--font-head);
font-size: 0.85rem;
font-weight: 700;
letter-spacing: 0.03em;
color: var(--text-muted);
text-transform: uppercase;
margin-bottom: 1.25rem;
display: flex;
align-items: center;
gap: 8px;
}

.stack-panel h4::before {
content: '';
width: 3px;
height: 14px;
border-radius: 2px;
background: var(--accent);
display: block;
}

.stack-item {
display: flex;
align-items: flex-start;
gap: 10px;
padding: 0.65rem 0;
border-bottom: 1px solid var(--border);
}

.stack-item:last-child { border-bottom: none; }

.stack-dot {
width: 7px;
height: 7px;
border-radius: 50%;
background: var(--accent);
flex-shrink: 0;
margin-top: 7px;
opacity: 0.5;
}

.stack-item strong {
font-weight: 500;
font-size: 13px;
color: var(--text);
display: block;
}

.stack-item span {
font-size: 12px;
color: var(--text-muted);
font-weight: 300;
line-height: 1.5;
}

/_ ── INSTALL ── _/
.steps-timeline {
position: relative;
padding-left: 2.5rem;
}

.steps-timeline::before {
content: '';
position: absolute;
left: 14px;
top: 0;
bottom: 0;
width: 1px;
background: linear-gradient(to bottom, var(--accent), transparent);
}

.step {
position: relative;
margin-bottom: 2.5rem;
}

.step:last-child { margin-bottom: 0; }

.step-num {
position: absolute;
left: -2.5rem;
top: 0;
width: 28px;
height: 28px;
border-radius: 50%;
background: var(--surface2);
border: 1px solid var(--border-bright);
display: flex;
align-items: center;
justify-content: center;
font-family: var(--font-head);
font-size: 11px;
font-weight: 700;
color: var(--accent);
}

.step h4 {
font-family: var(--font-head);
font-size: 0.95rem;
font-weight: 700;
color: var(--text);
margin-bottom: 0.75rem;
}

.step p {
font-size: 13px;
color: var(--text-muted);
margin-bottom: 0.75rem;
font-weight: 300;
}

pre {
background: #020c0a;
border: 1px solid var(--border);
border-radius: 10px;
padding: 1rem 1.25rem;
font-size: 12px;
line-height: 1.7;
overflow-x: auto;
font-family: 'DM Mono', 'SF Mono', monospace;
}

code { color: var(--accent); }

.note-box {
margin-top: 0.75rem;
background: rgba(255,194,70,0.06);
border: 1px solid rgba(255,194,70,0.2);
border-radius: 8px;
padding: 0.75rem 1rem;
font-size: 12.5px;
color: var(--amber);
font-weight: 300;
}

.note-box strong { font-weight: 500; }

/_ ── ACCOUNTS ── _/
.accounts-grid {
display: grid;
grid-template-columns: 1fr 1fr;
gap: 1.5rem;
}

.account-card {
border: 1px solid var(--border);
border-radius: 14px;
padding: 1.75rem;
background: var(--surface);
position: relative;
overflow: hidden;
}

.account-card::before {
content: '';
position: absolute;
top: 0;
left: 0;
right: 0;
height: 2px;
}

.account-card.admin::before { background: linear-gradient(90deg, var(--accent), transparent); }
.account-card.doctor::before { background: linear-gradient(90deg, var(--accent2), transparent); }

.account-role {
display: inline-flex;
align-items: center;
gap: 6px;
font-size: 10px;
font-weight: 500;
letter-spacing: 0.12em;
text-transform: uppercase;
margin-bottom: 1.25rem;
padding: 4px 12px;
border-radius: 100px;
}

.role-admin { color: var(--accent); background: rgba(0,200,160,0.08); border: 1px solid var(--border-bright); }
.role-doctor { color: var(--accent2); background: rgba(0,144,255,0.08); border: 1px solid rgba(0,144,255,0.2); }

.account-card h3 {
font-family: var(--font-head);
font-size: 1rem;
font-weight: 700;
margin-bottom: 1.25rem;
color: var(--text);
}

.credential {
display: flex;
flex-direction: column;
gap: 0.6rem;
}

.cred-row {
display: flex;
align-items: center;
gap: 10px;
padding: 0.5rem 0.75rem;
background: rgba(0,0,0,0.3);
border: 1px solid var(--border);
border-radius: 7px;
}

.cred-label {
font-size: 10px;
font-weight: 500;
letter-spacing: 0.1em;
text-transform: uppercase;
color: var(--text-dim);
min-width: 50px;
}

.cred-value {
font-family: 'DM Mono', 'SF Mono', monospace;
font-size: 12.5px;
color: var(--text);
}

/_ ── UML SECTION ── _/
.uml-cards {
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 1.5px;
background: var(--border);
border: 1px solid var(--border);
border-radius: 16px;
overflow: hidden;
}

.uml-card {
background: var(--surface);
padding: 2rem 1.5rem;
}

.uml-card:hover { background: var(--surface2); }

.uml-num {
font-family: var(--font-head);
font-size: 2.5rem;
font-weight: 800;
color: rgba(0,200,160,0.06);
line-height: 1;
margin-bottom: 0.5rem;
}

.uml-card h3 {
font-family: var(--font-head);
font-size: 0.9rem;
font-weight: 700;
color: var(--text);
margin-bottom: 0.5rem;
}

.uml-card p {
font-size: 12.5px;
color: var(--text-muted);
font-weight: 300;
line-height: 1.6;
}

.uml-placeholder {
margin-top: 1.25rem;
border: 1px dashed var(--border-bright);
border-radius: 8px;
height: 80px;
display: flex;
align-items: center;
justify-content: center;
font-size: 11px;
color: var(--text-dim);
letter-spacing: 0.08em;
text-transform: uppercase;
}

/_ ── FOOTER ── _/
footer {
padding: 3rem 0;
text-align: center;
border-top: 1px solid var(--border);
}

footer p {
font-size: 12.5px;
color: var(--text-dim);
font-style: italic;
font-weight: 300;
}

footer span { color: var(--accent); }

/_ ── NAV ── _/
nav {
position: sticky;
top: 0;
z-index: 100;
backdrop-filter: blur(16px);
-webkit-backdrop-filter: blur(16px);
background: rgba(5,13,20,0.85);
border-bottom: 1px solid var(--border);
padding: 0.85rem 0;
}

.nav-inner {
display: flex;
align-items: center;
justify-content: space-between;
max-width: 960px;
margin: 0 auto;
padding: 0 2rem;
}

.nav-logo {
font-family: var(--font-head);
font-size: 1rem;
font-weight: 800;
color: var(--text);
text-decoration: none;
display: flex;
align-items: center;
gap: 8px;
}

.nav-logo-dot {
width: 8px;
height: 8px;
border-radius: 50%;
background: var(--accent);
animation: pulse 2s ease-in-out infinite;
}

.nav-links {
display: flex;
gap: 0;
list-style: none;
}

.nav-links a {
font-size: 12.5px;
font-weight: 400;
color: var(--text-muted);
text-decoration: none;
padding: 6px 14px;
border-radius: 6px;
transition: all 0.2s;
letter-spacing: 0.02em;
}

.nav-links a:hover { color: var(--text); background: rgba(255,255,255,0.04); }

@media (max-width: 700px) {
.features-grid, .stack-grid, .accounts-grid, .uml-cards { grid-template-columns: 1fr; }
.nav-links { display: none; }
.hero { padding: 5rem 0 3rem; }
}
</style>

</head>
<body>

<nav>
  <div class="nav-inner">
    <a href="#" class="nav-logo">
      <span class="nav-logo-dot"></span>
      MediCore Nova
    </a>
    <ul class="nav-links">
      <li><a href="#gems">Joyaux</a></li>
      <li><a href="#features">Fonctionnalités</a></li>
      <li><a href="#stack">Stack</a></li>
      <li><a href="#install">Installation</a></li>
      <li><a href="#accounts">Comptes</a></li>
    </ul>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-eyebrow">Enterprise Hospital Solution · 2026</div>
    <h1>MediCore<br><span class="grad">Nova</span></h1>
    <p class="hero-sub">
      Une solution clinique numérique de pointe combinant un backend robuste sous <strong>Laravel 12</strong> et un portail de certification autonome sous <strong>React + Vite</strong>. Automatisation IA, dashboards décisionnels, cybersécurité documentaire.
    </p>
    <div class="hero-badges">
      <span class="badge badge-laravel">Laravel 12.x</span>
      <span class="badge badge-react">React 18.x</span>
      <span class="badge badge-tailwind">Tailwind CSS 3.x</span>
      <span class="badge badge-chartjs">Chart.js 4.x</span>
      <span class="badge badge-sec">🔒 Token 6H Expiration</span>
    </div>
    <div class="hero-cta">
      <a href="#install" class="btn btn-primary">Démarrage rapide →</a>
      <a href="#gems" class="btn btn-ghost">Voir les joyaux</a>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- GEMS -->
<section id="gems">
  <div class="container">
    <div class="section-label">Highlights</div>
    <h2 class="section-title">Joyaux Techniques</h2>
    <p class="section-desc">Trois innovations au cœur de MediCore Nova, conçues pour répondre aux défis critiques du management hospitalier moderne.</p>

    <div class="gems-grid">
      <div class="gem-card">
        <span class="gem-num">01</span>
        <span class="gem-icon">🤖</span>
        <h3>Assistant Clinique IA & E-Prescription</h3>
        <p>Propulsé par <strong>Groq Llama 3</strong>, le médecin saisit ses notes en langage naturel. L'IA structure automatiquement le diagnostic, rédige l'ordonnance et génère un PDF sécurisé via DomPDF.</p>
        <span class="gem-tag tag-ai">Groq Llama 3</span>
      </div>
      <div class="gem-card">
        <span class="gem-num">02</span>
        <span class="gem-icon">🔒</span>
        <h3>QR Code Expirable — Cybersécurité Documentaire</h3>
        <p>Chaque PDF embarque un QR code vectoriel (SVG pur) avec un <strong>token cryptographique temporel</strong>. Validation verte sous 6h, écran rouge d'alerte passé ce délai. Anti-fraude aux ordonnances.</p>
        <span class="gem-tag tag-sec">6H Token · GitHub Pages</span>
      </div>
      <div class="gem-card">
        <span class="gem-num">03</span>
        <span class="gem-icon">📊</span>
        <h3>Dashboards Décisionnels Réels</h3>
        <p>Analyses interactives Chart.js pour praticiens (activité hebdo, statuts RDV) et administrateurs (revenus mensuels DH, effectifs par spécialité, taux de fréquentation).</p>
        <span class="gem-tag tag-data">Chart.js · Real-time</span>
      </div>
    </div>

  </div>
</section>

<div class="divider"></div>

<!-- FEATURES -->
<section id="features">
  <div class="container">
    <div class="section-label">Modules</div>
    <h2 class="section-title">Fonctionnalités Phares</h2>
    <p class="section-desc">Deux espaces distincts, pensés pour chaque rôle de l'établissement hospitalier.</p>

    <div class="features-grid">
      <div class="feat-block">
        <div class="feat-header">
          <div class="feat-icon-wrap icon-admin">🏛️</div>
          <div>
            <h3>Administration Centrale</h3>
          </div>
        </div>
        <ul class="feat-list">
          <li><strong>Dashboard Global</strong> — Monitorer les flux financiers, médicaux et administratifs de l'établissement en temps réel.</li>
          <li><strong>Gestion des Praticiens</strong> — Recrutement, attribution des spécialités, gestion des plannings hebdomadaires.</li>
          <li><strong>Annuaire Patients</strong> — Centralisation des dossiers informatisés de santé, recherche instantanée.</li>
          <li><strong>Rapports Financiers</strong> — Évolution des revenus mensuels, indicateurs de performance globale.</li>
        </ul>
      </div>
      <div class="feat-block">
        <div class="feat-header">
          <div class="feat-icon-wrap icon-doctor">👩‍⚕️</div>
          <div>
            <h3>Espace Praticien</h3>
          </div>
        </div>
        <ul class="feat-list">
          <li><strong>Planning du jour</strong> — Liste ordonnée des consultations et alertes d'urgences prioritaires.</li>
          <li><strong>Dossier Patient Unique (DPU)</strong> — Accès instantané aux antécédents, allergies et consultations précédentes.</li>
          <li><strong>E-Prescription IA</strong> — Rédaction assistée par Groq Llama 3, génération PDF sécurisée avec QR.</li>
          <li><strong>Module Facturation</strong> — Génération des récapitulatifs financiers instantanés par consultation.</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<div class="divider"></div>

<!-- UML -->
<section id="uml">
  <div class="container">
    <div class="section-label">Architecture</div>
    <h2 class="section-title">Modélisation UML</h2>
    <p class="section-desc">Trois diagrammes documentant la structure architecturale complète de l'écosystème MediCore Nova.</p>

    <div class="uml-cards">
      <div class="uml-card">
        <div class="uml-num">UC</div>
        <h3>Diagramme Use Case</h3>
        <p>Interactions des acteurs Admin, Médecin et Patient avec le système hospitalier.</p>
        <div class="uml-placeholder">docs/usecase.png</div>
      </div>
      <div class="uml-card">
        <div class="uml-num">CD</div>
        <h3>Diagramme de Classes</h3>
        <p>Structure de données relationnelle et ORM Eloquent gérant les entités de la base de données.</p>
        <div class="uml-placeholder">docs/class.png</div>
      </div>
      <div class="uml-card">
        <div class="uml-num">SD</div>
        <h3>Diagramme de Séquence</h3>
        <p>Cycle de vie de prise de rendez-vous et de consultation entre les composants.</p>
        <div class="uml-placeholder">docs/sequence.png</div>
      </div>
    </div>

  </div>
</section>

<div class="divider"></div>

<!-- STACK -->
<section id="stack">
  <div class="container">
    <div class="section-label">Infrastructure</div>
    <h2 class="section-title">Stack Technique</h2>
    <p class="section-desc">Un écosystème technologique choisi pour sa robustesse, sa sécurité et ses performances en environnement médical.</p>

    <div class="stack-grid">
      <div class="stack-panel">
        <h4>Backend & Système</h4>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>Laravel 12 · PHP 8.2+</strong>
            <span>Architecture MVC, sécurité renforcée, ORM Eloquent pour la gestion relationnelle.</span>
          </div>
        </div>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>Simple QRCode · SVG</strong>
            <span>Génération vectorielle légère intégrée au PDF, token cryptographique 6h.</span>
          </div>
        </div>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>MySQL / SQLite</strong>
            <span>Moteur de stockage relationnel structuré, migrations automatisées.</span>
          </div>
        </div>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>Groq Llama 3 API</strong>
            <span>Intelligence artificielle générative pour l'assistance clinique et e-prescription.</span>
          </div>
        </div>
      </div>
      <div class="stack-panel">
        <h4>Frontend & Interaction</h4>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>React 18 + Vite + Tailwind CSS</strong>
            <span>Portail de vérification QR autonome, hébergé sur GitHub Pages.</span>
          </div>
        </div>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>Blade + Vanilla CSS 3.0</strong>
            <span>Nova Theme épuré, design system cohérent sans dépendance CSS lourde.</span>
          </div>
        </div>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>Chart.js 4.x</strong>
            <span>Rendu graphique vectoriel interactif pour les dashboards décisionnels.</span>
          </div>
        </div>
        <div class="stack-item">
          <span class="stack-dot"></span>
          <div>
            <strong>DomPDF</strong>
            <span>Génération de documents PDF sécurisés avec QR code embarqué.</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<div class="divider"></div>

<!-- INSTALL -->
<section id="install">
  <div class="container">
    <div class="section-label">Pré-requis: PHP ≥ 8.2 · Composer · Node.js & NPM</div>
    <h2 class="section-title">Installation & Démarrage</h2>
    <p class="section-desc">Quatre étapes pour un environnement local opérationnel.</p>

    <div class="steps-timeline">
      <div class="step">
        <span class="step-num">1</span>
        <h4>Clone & Dépendances</h4>
        <pre><code>git clone https://github.com/Amine-NAHLI/hopital-app.git

cd hopital-app
composer install
npm install</code></pre>
</div>
<div class="step">
<span class="step-num">2</span>
<h4>Environnement & Clé de sécurité</h4>
<pre><code>cp .env.example .env
php artisan key:generate</code></pre>
<div class="note-box">
<strong>Important :</strong> Dans votre <code>.env</code>, configurez <code>GROQ_API_KEY</code> pour activer l'assistant IA, et <code>TUNNEL_URL</code> pour pointer vers le portail de confirmation React.
</div>
</div>
<div class="step">
<span class="step-num">3</span>
<h4>Migration & Base de Données</h4>
<pre><code>php artisan migrate --seed</code></pre>
</div>
<div class="step">
<span class="step-num">4</span>
<h4>Lancement des serveurs</h4>
<pre><code># Terminal 1 — Serveur Laravel
php artisan serve

# Terminal 2 — Compilation assets

npm run dev</code></pre>
</div>
</div>

  </div>
</section>

<div class="divider"></div>

<!-- ACCOUNTS -->
<section id="accounts">
  <div class="container">
    <div class="section-label">Démo</div>
    <h2 class="section-title">Comptes de Test</h2>
    <p class="section-desc">Profils pré-générés pour une connexion instantanée lors de la démonstration.</p>

    <div class="accounts-grid">
      <div class="account-card admin">
        <div class="account-role role-admin">🛡️ Administrateur</div>
        <h3>Espace Administration</h3>
        <div class="credential">
          <div class="cred-row">
            <span class="cred-label">Email</span>
            <span class="cred-value">admin@hopital.com</span>
          </div>
          <div class="cred-row">
            <span class="cred-label">Mot de passe</span>
            <span class="cred-value">password</span>
          </div>
        </div>
      </div>
      <div class="account-card doctor">
        <div class="account-role role-doctor">👩‍⚕️ Médecin</div>
        <h3>Dr. Karim Bennani</h3>
        <div class="credential">
          <div class="cred-row">
            <span class="cred-label">Email</span>
            <span class="cred-value">medecin@hopital.com</span>
          </div>
          <div class="cred-row">
            <span class="cred-label">Mot de passe</span>
            <span class="cred-value">password</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<div class="divider"></div>

<footer>
  <div class="container">
    <p>Propulsé par la rigueur scientifique et l'innovation — <span>MediCore Nova</span> © 2026</p>
  </div>
</footer>

</body>
</html>
