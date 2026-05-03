# 🏥 MediCore Pro — Hospital Management System

![MediCore Pro Banner](medicore_pro_banner_1777819233017.png)

## 📋 À propos
**MediCore Pro** est une plateforme moderne et intuitive de gestion hospitalière conçue pour simplifier les interactions entre le personnel administratif, les médecins et les patients. Le système centralise la gestion des dossiers médicaux, les rendez-vous, les prescriptions et la facturation dans une interface élégante et performante.

## ✨ Fonctionnalités Clés

### 👨‍💼 Espace Administration
- **Tableau de bord global** : Statistiques en temps réel sur l'activité hospitalière (revenus, nouveaux patients, consultations).
- **Gestion des Ressources Humaines** : CRUD complet des profils médecins et personnels.
- **Suivi des Dossiers** : Accès centralisé à l'ensemble des patients et de leurs historiques.

### 🩺 Espace Praticien (Médecin)
- **Dashboard personnalisé** : Vue immédiate sur les rendez-vous du jour.
- **Gestion des Consultations** : Saisie rapide des diagnostics, notes et traitements.
- **Ordonnances Digitales** : Génération et suivi des prescriptions médicales.
- **Base Patients** : Historique détaillé pour chaque patient suivi.

### 🗓️ Gestion des Flux
- **Système de Rendez-vous** : Planification intelligente et suivi des statuts (Confirmé, En attente, Terminé).
- **Facturation Automatisée** : Génération de factures dès la validation d'une consultation.

## 🛠️ Stack Technique
- **Framework** : Laravel 12.x
- **Frontend** : Blade Templates + Vanilla CSS (Custom Design System 3.0)
- **Base de données** : MySQL / SQLite
- **Authentification** : Laravel Breeze (Personnalisé)
- **Vite** : Pour la compilation des assets

## 🚀 Installation

1. **Cloner le projet**
   ```bash
   git clone [url-du-repo]
   cd hopital-app
   ```

2. **Installer les dépendances**
   ```bash
   composer install
   npm install
   ```

3. **Configuration de l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migration & Seed (Initialisation)**
   ```bash
   php artisan migrate --seed
   ```

5. **Lancer l'application**
   ```bash
   php artisan serve
   # Dans un autre terminal
   npm run dev
   ```

## 📂 Structure Documentée
Chaque fichier de code du projet a été mis à jour pour inclure une description détaillée de son rôle et de ses fonctionnalités, facilitant ainsi la maintenance et l'évolution du système.

---
*Développé avec ❤️ pour une gestion médicale plus efficace.*
