<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // === RECIBIR FILTROS ===
        $sucursal = $request->get('sucursal');
        $tipo = $request->get('tipo');
        $rango = $request->get('rango', 30);

        // === QUERY BASE ===
        $query = Activo::query();

        // Filtro por sucursal
        if ($sucursal && $sucursal !== '') {
            $query->where('sucursal_area', 'like', "%{$sucursal}%");
        }

        // Filtro por tipo
        if ($tipo === 'asignado') {
            $query->whereNotNull('asignado');
        } elseif ($tipo === 'sin_asignar') {
            $query->whereNull('asignado');
        }

        // === DATOS PARA LA VISTA ===
        $totalActivos = $query->count();
        $sinAsignar = Activo::whereNull('asignado')->count();

        // Vencimientos simulados (puedes cambiar por fecha real después)
        $vencimientosProximos = match((int)$rango) {
            30 => rand(3, 8),
            90 => rand(10, 20),
            365 => rand(25, 40),
            default => 6,
        };

        // Lista de sucursales (para el select)
        $sucursalesList = Activo::select('sucursal_area')
            ->distinct()
            ->orderBy('sucursal_area')
            ->pluck('sucursal_area')
            ->toArray();

        // Tipos para el select
        $tiposList = ['asignado', 'sin_asignar'];

        // Activos por sucursal (top 10) - COMPATIBLE CON ONLY_FULL_GROUP_BY
$activosPorSucursal = Activo::selectRaw('
        SUBSTRING_INDEX(sucursal_area, "/", 1) as sucursal,
        COUNT(*) as count
    ')
    ->groupBy(DB::raw('SUBSTRING_INDEX(sucursal_area, "/", 1)'))
    ->orderByDesc('count')
    ->limit(10)
    ->get();
        // Vencimientos por mes (simulado)
        $meses = ['Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago'];
        $vencimientosPorMes = [];
        foreach ($meses as $mes) {
            $vencimientosPorMes[$mes] = rand(0, 6);
        }

        // Conteo por estado
        $estadosCount = [
            'Activo' => Activo::where('estado', 'Activo')->count(),
            'En Reparación' => Activo::where('estado', 'En Reparación')->count(),
            'Obsoleto' => Activo::where('estado', 'Obsoleto')->count(),
        ];

        return view('dashboard', compact(
            'totalActivos',
            'sinAsignar',
            'vencimientosProximos',
            'sucursalesList',
            'tiposList',
            'rango',
            'activosPorSucursal',
            'vencimientosPorMes',
            'estadosCount'
        ));
    }
}