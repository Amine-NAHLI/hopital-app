# 🏥 MediCore Nova — Enterprise Hospital Solution

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![React](https://img.shields.io/badge/React-18.x-61DAFB?style=for-the-badge&logo=react&logoColor=black)](https://react.dev)
[![ChartJS](https://img.shields.io/badge/Chart.js-4.x-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)](https://www.chartjs.org/)
[![TailwindCSS](https://img.shields.io/badge/Tailwind--CSS-3.x-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Status](https://img.shields.io/badge/Security-6H--Token--Expiration-emerald?style=for-the-badge&logo=securityscorecard&logoColor=white)]()

<p align="center">
  <img src="banner.png" width="100%" alt="MediCore Nova Banner" style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); transition: transform 0.3s ease;">
</p>

**MediCore Nova** est une solution clinique numérique de pointe. En combinant un backend robuste sous **Laravel 12 (MVC)** et un portail de certification autonome sous **React (Vite + Tailwind)**, elle résout les défis réels du management de la santé : automatisation par l'IA, dashboards décisionnels et cybersécurité documentaire.

[🚀 Tester l'Application](#-installation--démarrage) · [📊 Voir les Diagrammes](#-conception--modélisation-uml) · [🔒 Portabilité QR Code](#-joyaux-techniques)

</div>

---

## 📑 Sommaire
- [✨ Joyaux Techniques](#-joyaux-techniques)
- [🎨 Fonctionnalités Phares](#-fonctionnalités-phares)
- [📐 Conception & Modélisation UML](#-conception--modélisation-uml)
- [🛠️ Stack Technique & Architecture](#️-stack-technique--architecture)
- [🚀 Installation & Démarrage](#-installation--démarrage)
- [👤 Comptes de Test (Démo)](#-comptes-de-test-démo)

---

## 💎 Joyaux Techniques

### 1. 🤖 Assistant Clinique IA & E-Prescription
Propulsé par les modèles d'IA générative (via **Groq Llama 3**), le médecin saisit ses notes en langage naturel. L'IA structure automatiquement le diagnostic, rédige l'ordonnance clinique et génère le livrable sous format **PDF sécurisé** via DomPDF.

### 2. 🔒 Cybersécurité Documentaire : QR Code Expirable (6h Max)
Pour contrer la fraude aux ordonnances, chaque PDF dispose d'un QR code vectoriel (SVG pure) intégrant un **token temporel cryptographique**. 
* Scanné sur mobile, il redirige vers le portail autonome **React** hébergé sur GitHub Pages.
* Si le scan s'effectue dans les **6 heures** suivant la création, le portail valide l'authenticité (affichage Vert Émeraude).
* Si le scan a lieu **plus de 6 heures après**, le portail React applique une politique d'auto-destruction des données et affiche instantanément un **écran rouge d'alerte de sécurité**.

### 3. 📊 Dashboards Décisionnels Réels (Chart.js)
Fini les données statiques ! Les espaces Administrateur et Médecin intègrent désormais de véritables analyses décisionnelles interactives :
* **Praticien :** Activité hebdomadaire, répartition des statuts des rendez-vous et analyse comparative de volume d'activité.
* **Administrateur :** Évolution des revenus financiers mensuels (DH), effectifs par spécialité médicale et taux de fréquentation globale.

---

## 🎨 Fonctionnalités Phares

### 🏛️ Administration Centrale
* **Dashboard Global** : Monitorer les flux financiers, médicaux et administratifs de l'établissement.
* **Gestion des Praticiens** : Recrutement, attribution des spécialités et plannings.
* **Annuaire Patients** : Centralisation des dossiers informatisés de santé.

### 👩‍⚕️ Espace Praticien (Médecin)
* **Planning du jour** : Liste ordonnée des consultations et alertes d'urgences.
* **Dossier Patient Unique (DPU)** : Accès instantané aux antécédents, allergies et anciennes consultations.
* **Module Facturation** : Génération des récapitulatifs financiers instantanés.

---

## 📐 Conception & Modélisation UML

Les diagrammes de modélisation ci-dessous représentent la structure architecturale de l'écosystème **MediCore Nova** :

### 1. 🎯 Diagramme de Cas d'Utilisation (Use Case)
*Ce diagramme présente les interactions des acteurs (Admin, Médecin, Patient) avec le système hospitalier.*
<p align="center">
  <img src="docs/usecase.png" width="85%" alt="Use Case Diagram" style="border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
</p>

### 2. 🗂️ Diagramme de Classes (Class Diagram)
*Il décrit la structure de données relationnelle et l'ORM (Eloquent) gérant les entités de la base de données.*
<p align="center">
  <img src="docs/class.png" width="95%" alt="Class Diagram" style="border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
</p>

### 3. ⏱️ Diagramme de Séquence (Sequence Diagram)
*Ce diagramme illustre le cycle de vie de prise de rendez-vous et de consultation entre les différents composants.*
<p align="center">
  <img src="docs/sequence.png" width="90%" alt="Sequence Diagram" style="border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
</p>

---

## 🛠️ Stack Technique & Architecture

<table align="center" style="width: 100%;">
  <tr>
    <td style="width: 50%; vertical-align: top;">
      <h4>🖥️ Core Backend & Système</h4>
      <ul>
        <li><b>Laravel 12 (PHP 8.2+)</b> : Architecture MVC robuste, sécurité et ORM Eloquent.</li>
        <li><b>Simple QRCode (Format SVG)</b> : Génération vectorielle légère intégrée au PDF.</li>
        <li><b>MySQL / SQLite</b> : Moteur de stockage relationnel structuré.</li>
      </ul>
    </td>
    <td style="width: 50%; vertical-align: top;">
      <h4>🎨 Frontend & Interaction</h4>
      <ul>
        <li><b>React 18 & Tailwind CSS</b> : Interface mobile de vérification sécurisée, réactive et autonome.</li>
        <li><b>Vanilla CSS 3.0 & Blade</b> : Design system épuré (Nova Theme) sans framework CSS lourd.</li>
        <li><b>Chart.js</b> : Rendu graphique vectoriel interactif et dynamique.</li>
      </ul>
    </td>
  </tr>
</table>

---

## 🚀 Installation & Démarrage

### Pré-requis
* PHP `>= 8.2`
* Composer
* Node.js & NPM

### Étape 1 : Clone & Dépendances Backend
```bash
git clone https://github.com/Amine-NAHLI/hopital-app.git
cd hopital-app
composer install
npm install
```

### Étape 2 : Fichier d'environnement & Clé de sécurité
```bash
cp .env.example .env
php artisan key:generate
```
> [!IMPORTANT]
> Dans votre fichier `.env`, configurez votre clé API Groq `GROQ_API_KEY` pour activer l'assistant IA, et configurez `TUNNEL_URL` pour pointer vers le portail de confirmation.

### Étape 3 : Migration & Base de Données
```bash
php artisan migrate --seed
```

### Étape 4 : Lancement
```bash
# Lancer le serveur local
php artisan serve

# Dans un terminal séparé : Compiler les assets
npm run dev
```

---

## 👤 Comptes de Test (Démo)

Pour vous connecter instantanément lors de la démo, utilisez les profils pré-générés suivants :

### 1. 🛡️ Espace Administrateur
* **Email :** `admin@hopital.com`
* **Mot de passe :** `password`

### 2. 👩‍⚕️ Espace Médecin (Dr. Karim Bennani)
* **Email :** `medecin@hopital.com`
* **Mot de passe :** `password`

---

<div align="center">
  <i>Propulsé par la rigueur scientifique et l'innovation — MediCore Nova © 2026</i>
</div>
