<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Maneja la comprobación de rol.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Si no está autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Si el rol no coincide, redirigir según su rol real
        $user = Auth::user();

        if ($user->role !== $role) {
            // Si es admin
            if ($user->role === 'admin') {
                return redirect('/activos');
            }

            // Si es usuario normal
            if ($user->role === 'user') {
                return redirect('/dashboard');
            }

            // Rol desconocido
            Auth::logout();
            return redirect('/login')->withErrors(['role' => 'Rol no autorizado.']);
        }

        return $next($request);
    }
}

