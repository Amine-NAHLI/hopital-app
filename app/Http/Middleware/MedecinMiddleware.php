<?php

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