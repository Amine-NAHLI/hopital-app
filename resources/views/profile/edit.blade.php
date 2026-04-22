@extends('layouts.app')
@section('title', 'Mon Profil')
@section('page-title', 'Paramètres du Compte')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <!-- Section Informations Personnelles -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-person-circle text-primary me-2"></i> Informations du Profil
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Mettez à jour vos informations personnelles et votre adresse email.</p>
                </div>
                <div class="card-body p-4">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Section Mot de Passe -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-shield-lock text-primary me-2"></i> Sécurité du Compte
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Assurez-vous d'utiliser un mot de passe complexe pour protéger votre accès.</p>
                </div>
                <div class="card-body p-4">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Section Suppression de Compte (Danger Zone) -->
            <div class="card border-0 shadow-sm border-start border-danger border-4">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <h5 class="mb-0 fw-bold text-danger">
                        <i class="bi bi-exclamation-octagon me-2"></i> Zone de Danger
                    </h5>
                    <p class="text-muted small mb-0 mt-1">La suppression de votre compte est définitive et entraînera la perte de toutes vos données.</p>
                </div>
                <div class="card-body p-4">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Ajustements pour les formulaires Breeze dans notre layout */
        .max-w-xl { max-width: 36rem; }
        input[type="text"], input[type="email"], input[type="password"], select, textarea {
            display: block;
            width: 100%;
            padding: 0.625rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
            color: #1e293b;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        input:focus {
            border-color: #4f46e5;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.1);
        }
        .btn-primary-breeze {
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.2s;
        }
        .btn-primary-breeze:hover { background-color: #4338ca; }
    </style>
@endsection
