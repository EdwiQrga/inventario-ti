<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AlertaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Activo::query();

        // 🔍 FILTRO POR NOMBRE O SERIAL
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('serial', 'like', "%{$search}%");
            });
        }

        // ⚠️ FILTRAR ALERTAS (licencias próximas a vencer o vencidas, y equipos en mantenimiento)
        $query->where(function ($q) {
            $q->where(function ($q2) {
                $q2->whereNotNull('fecha_vencimiento')
                    ->where('fecha_vencimiento', '<=', Carbon::now()->addMonth())
                    ->orWhere('fecha_vencimiento', '<', Carbon::now());
            })->orWhere('estado', 'Pending');
        });

        // 🧩 FILTRO POR TIPO DE ALERTA
        if ($request->filled('tipo_alerta')) {
            if ($request->input('tipo_alerta') === 'licencia') {
                $query->whereNotNull('fecha_vencimiento')
                      ->where('fecha_vencimiento', '<=', Carbon::now()->addMonth());
            } elseif ($request->input('tipo_alerta') === 'mantenimiento') {
                $query->where('estado', 'Pending');
            }
        }

        // 📅 FILTRO POR FECHA LÍMITE
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_vencimiento', '<=', $request->input('fecha_hasta'));
        }

        // 🔁 ORDENAR (las más próximas primero)
        $alertas = $query->orderBy('fecha_vencimiento', 'asc')->paginate(10);

        // 🏷️ AGREGAR COLUMNA TIPO DE ALERTA
        $alertas->getCollection()->transform(function ($alerta) {
            $alerta->tipo_alerta = $alerta->fecha_vencimiento && (
                $alerta->fecha_vencimiento < Carbon::now() || 
                $alerta->fecha_vencimiento <= Carbon::now()->addMonth()
            )
                ? 'Licencia ' . ($alerta->fecha_vencimiento < Carbon::now() ? 'Vencida' : 'Próxima a Vencer')
                : 'Mantenimiento';
            return $alerta;
        });

        return view('alertas.index', compact('alertas'));
    }

    // ✅ Resolver una alerta
    public function resolve($id)
    {
        $activo = Activo::findOrFail($id);
        $activo->update(['estado' => 'Deployed']); 
        return redirect()->route('alertas.index')->with('success', 'Alerta resuelta exitosamente.');
    }

    // ✅ Resolver todas las alertas
    public function resolveAll(Request $request)
    {
        $activos = Activo::where(function ($q) {
            $q->whereNotNull('fecha_vencimiento')
              ->where('fecha_vencimiento', '<=', Carbon::now()->addMonth())
              ->orWhere('fecha_vencimiento', '<', Carbon::now())
              ->orWhere('estado', 'Pending');
        })->get();

        foreach ($activos as $activo) {
            $activo->update(['estado' => 'Deployed']);
        }

        return redirect()->route('alertas.index')->with('success', 'Todas las alertas resueltas exitosamente.');
    }
}
