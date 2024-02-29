<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TellerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->profile_type === 'teller') {
            return $next($request);
        }

        abort(403, 'Accès non autorisé');
    }
}

