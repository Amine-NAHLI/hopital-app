<?php

/**
 * Fichier : AdminMiddleware.php
 * Description : Middleware de sécurité pour les administrateurs.
 * Rôle : Vérifie si l'utilisateur connecté possède le rôle 'admin' avant de permettre l'accès aux routes protégées.
 */


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}