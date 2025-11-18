<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\Mantenimiento;
use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    public function index(Request $request)
    {
        // === LICENCIAS POR VENCER (próximos 60 días) ===
        $licenciasPorVencer = Licencia::whereNotNull('fecha_vencimiento')
            ->whereBetween('fecha_vencimiento', [now(), now()->addDays(60)])
            ->with('activo') // Relación con el modelo Activo
            ->orderBy('fecha_vencimiento')
            ->get();

        // === MANTENIMIENTOS PRÓXIMOS (en los siguientes 30 días) ===
        $mantenimientosProximos = Mantenimiento::whereNotNull('proxima_fecha')
            ->whereBetween('proxima_fecha', [now(), now()->addDays(30)])
            ->with('activo') // Relación con el modelo Activo
            ->orderBy('proxima_fecha')
            ->get();

        // === ALERTAS (con búsqueda por descripción, prioridad o activo relacionado) ===
        $query = Alerta::with('activo');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('descripcion', 'like', "%{$search}%")
                  ->orWhere('prioridad', 'like', "%{$search}%")
                  ->orWhereHas('activo', function ($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%");
                  });
            });
        }

        // Paginación de alertas
        $alertas = $query->orderBy('created_at', 'desc')->paginate(10);

        // === DEVOLVER TODO A LA VISTA ===
        return view('alertas.index', compact('licenciasPorVencer', 'mantenimientosProximos', 'alertas'));
    }
}
