<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar formulario combinado
    public function showLoginForm()
    {
        // Si el usuario ya está autenticado, redirigir al dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    // Procesar login
    // Procesar login - CON VALIDACIÓN MEJORADA
public function login(Request $request)
{
    // Validar los campos primero
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role-selector' => 'required|in:admin,user' // Ahora validamos el rol
    ], [
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'password.required' => 'La contraseña es obligatoria.',
        'role-selector.required' => 'Debe seleccionar un rol.',
        'role-selector.in' => 'El rol seleccionado no es válido.'
    ]);

    // Verificar si el usuario existe
    $user = User::where('email', $credentials['email'])->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'El correo electrónico no está registrado.',
        ])->withInput($request->only('email', 'role-selector'));
    }

    // Verificar la contraseña
    if (!Hash::check($credentials['password'], $user->password)) {
        return back()->withErrors([
            'password' => 'La contraseña es incorrecta.',
        ])->withInput($request->only('email', 'role-selector'));
    }

    // Verificar el rol
    if ($user->role !== $credentials['role-selector']) {
        return back()->withErrors([
            'role-selector' => 'El rol seleccionado no coincide con su cuenta.',
        ])->withInput($request->only('email'));
    }

    // Si todo está correcto, iniciar sesión
    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    // Si falla por alguna razón desconocida
    return back()->withErrors([
        'email' => 'Error al iniciar sesión. Por favor, intente nuevamente.',
    ])->withInput($request->only('email', 'role-selector'));
}
    // Procesar registro
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ],
            'role' => 'required|in:admin,user',
        ], [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', '¡Cuenta creada exitosamente!');
    }

    // Enviar enlace de recuperación
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)])->withInput($request->only('email'));
    }

    // Mostrar formulario de reset de contraseña
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Procesar reset de contraseña
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ],
        ], [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // Cerrar sesión - CORREGIDO (SOLO UN MÉTODO)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirigir a login con headers para prevenir cache
        return redirect('/login')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT',
        ]);
    }
}