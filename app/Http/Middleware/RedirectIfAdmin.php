<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Si es admin y trata de acceder a /home, redirigir a /activos
        if (Auth::check() && Auth::user()->role === 'admin' && $request->is('home')) {
            return redirect('/activos');
        }

        return $next($request);
    }
}
