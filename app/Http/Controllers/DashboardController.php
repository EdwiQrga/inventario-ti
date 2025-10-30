<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalActivos = Activo::count();
        $totalUsuarios = User::count();

        // Contamos categorías únicas basadas en 'tipo'
        $totalCategorias = Activo::select('tipo')->distinct()->count('tipo');

        // No hay tabla 'Modelos' en tu esquema, así que lo omitimos
        $totalModelos = 0; // Placeholder, ajusta si añades una tabla 'modelos'

        $ultimosActivos = Activo::latest()->take(5)->get(); // Incluye todas las columnas

        // Datos para gráfica de categorías (usamos 'tipo')
        $nombresCategorias = Activo::select('tipo')->distinct()->pluck('tipo');
        $conteoCategorias = $nombresCategorias->map(fn($tipo) => Activo::where('tipo', $tipo)->count());

        // Datos para gráfica de estados (usamos el enum 'estado')
        $estados = ['Deployed', 'Ready to Deploy', 'Pending']; // Valores del enum
        $conteoEstados = array_map(fn($estado) => Activo::where('estado', $estado)->count(), $estados);

        return view('dashboard', compact(
            'totalActivos', 'totalCategorias', 'totalModelos', 'totalUsuarios',
            'ultimosActivos', 'nombresCategorias', 'conteoCategorias',
            'estados', 'conteoEstados'
        ));
    }
}