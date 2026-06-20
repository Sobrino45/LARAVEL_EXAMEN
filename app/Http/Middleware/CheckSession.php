<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('concesionario')) {
            return redirect()->route('login')->withErrors('Debes iniciar sesión con un concesionario válido.');
        }
        
        return $next($request);
    }
}