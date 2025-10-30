<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Constructor: solo los invitados pueden acceder al login
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Función para autenticar
    public function authenticate(Request $request)
    {
        // Validación del formulario
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $role = $request->input('role-selector'); // admin o user

        // Intento de login con rol
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => $role // asegúrate de tener columna 'role' en users
        ])) {
            $request->session()->regenerate();

            // Redirección al dashboard
            return redirect()->intended('/activos'); // redirige al dashboard
        }

        // Si falla, regresar con error
        return back()->withErrors([
            'email' => 'El usuario, la contraseña o el rol son incorrectos.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}