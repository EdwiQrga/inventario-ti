<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // → CONVERTIR A ENTERO
        $rango = (int) $request->get('rango', 30);
        $sucursal = $request->get('sucursal');
        $tipo = $request->get('tipo');

        $query = Activo::query();

        if ($sucursal) $query->where('sucursal', $sucursal);
        if ($tipo) $query->where('tipo', $tipo);

        // Totales
        $totalActivos = $query->count();
        $sinAsignar = $query->whereNull('asignado_a')->orWhere('asignado_a', '')->count();

        // Vencimientos próximos
        $hoy = Carbon::today();
        $fin = $hoy->copy()->addDays($rango); // ← Ahora es INT
        $vencimientosProximos = $query->whereBetween('fecha_compra', [$hoy, $fin])->count();

        // Por mes (próximos 6 meses)
        $meses = [];
        $mesesNombres = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];
        for ($i = 0; $i < 6; $i++) {
            $mes = $hoy->copy()->addMonths($i);
            $count = (clone $query)->whereMonth('fecha_compra', $mes->month)
                                  ->whereYear('fecha_compra', $mes->year)
                                  ->count();
            $meses[$mesesNombres[$i]] = $count;
        }

        // Por sucursal
        $activosPorSucursal = Activo::selectRaw('sucursal, COUNT(*) as count')
            ->when($sucursal, fn($q) => $q->where('sucursal', $sucursal))
            ->when($tipo, fn($q) => $q->where('tipo', $tipo))
            ->groupBy('sucursal')
            ->orderByDesc('count')
            ->get();

        // Estados
        $estadosCount = Activo::selectRaw('estado, COUNT(*) as count')
            ->when($sucursal, fn($q) => $q->where('sucursal', $sucursal))
            ->when($tipo, fn($q) => $q->where('tipo', $tipo))
            ->groupBy('estado')
            ->pluck('count', 'estado')
            ->toArray();

        $estadosCount = collect(['Activo' => 0, 'En Reparación' => 0, 'Retirado' => 0])
            ->merge($estadosCount)
            ->toArray();

        return view('dashboard', [
            'totalActivos' => $totalActivos,
            'sinAsignar' => $sinAsignar,
            'vencimientosProximos' => $vencimientosProximos,
            'vencimientosPorMes' => $meses,
            'activosPorSucursal' => $activosPorSucursal,
            'estadosCount' => $estadosCount,
            'sucursalesList' => Activo::distinct('sucursal')->pluck('sucursal'),
            'tiposList' => Activo::distinct('tipo')->pluck('tipo'),
            'rango' => $rango, // ← Para mostrar en la vista
        ]);
    }
}