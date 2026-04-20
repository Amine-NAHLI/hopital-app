<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MedecinMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role === null) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}