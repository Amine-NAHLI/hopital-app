<?php

/**
 * Fichier : MedecinMiddleware.php
 * Description : Middleware de sécurité pour les médecins.
 * Rôle : Vérifie si l'utilisateur connecté possède le rôle 'medecin' avant de permettre l'accès aux routes réservées aux praticiens.
 */


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MedecinMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isMedecin()) {
            abort(403, 'Accès réservé aux médecins praticiens.');
        }

        return $next($request);
    }
}