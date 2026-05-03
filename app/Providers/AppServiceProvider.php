<?php

/**
 * Fichier : AppServiceProvider.php
 * Description : Fournisseur de services principal.
 * Rôle : Permet d'enregistrer et de démarrer les services de l'application, comme les schémas de base de données ou les variables globales.
 */


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
