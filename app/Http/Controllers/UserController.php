<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Mostrar lista de usuarios con búsqueda y filtro
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Búsqueda por nombre o correo
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // Filtro por rol
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        $usuarios = $query->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Guardar un nuevo usuario
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'rol' => 'required|in:Administrador,Técnico,Usuario',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['estado'] = 'Activo';

        User::create($validated);

        return back()->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Mostrar datos del usuario (AJAX)
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'rol' => $user->rol,
        ]);
    }

    /**
     * Actualizar usuario existente
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol' => 'required|in:Administrador,Técnico,Usuario',
        ];

        if ($request->filled('password')) {
            $rules['password'] = [
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ];
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar usuario
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['No puedes eliminar tu propia cuenta.']);
        }

        $user->delete();

        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
