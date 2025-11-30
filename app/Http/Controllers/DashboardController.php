<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Impresora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // === RECIBIR FILTROS ===
        $sucursal = $request->get('sucursal');
        $tipo = $request->get('tipo'); // 'computadoras', 'impresoras', o vacío para todos
        $rango = $request->get('rango', 30);

        // === INICIALIZAR VARIABLES ===
        $totalActivos = 0;
        $sinAsignar = 0;
        $totalImpresoras = 0;
        $impresorasActivas = 0;
        $impresorasMantenimiento = 0;
        $activosPorSucursal = collect();
        $impresorasPorMarca = collect();
        $estadosCount = [];
        $estadosImpresoras = [];

        // === FILTRAR POR TIPO ===
        if ($tipo === 'computadoras' || empty($tipo)) {
            // === QUERY BASE PARA ACTIVOS (COMPUTADORAS) ===
            $queryActivos = Activo::query();

            // Filtro por sucursal para activos
            if ($sucursal && $sucursal !== '') {
                $queryActivos->where('sucursal_area', 'like', "%{$sucursal}%");
            }

            // === DATOS DE ACTIVOS ===
            $totalActivos = $queryActivos->count();
            $sinAsignar = Activo::when($sucursal, function($query) use ($sucursal) {
                $query->where('sucursal_area', 'like', "%{$sucursal}%");
            })->whereNull('asignado')->count();

            // Activos por sucursal
            $activosPorSucursal = Activo::selectRaw('
                SUBSTRING_INDEX(sucursal_area, "/", 1) as sucursal,
                COUNT(*) as count
            ')
            ->when($sucursal, function($query) use ($sucursal) {
                $query->where('sucursal_area', 'like', "%{$sucursal}%");
            })
            ->groupBy(DB::raw('SUBSTRING_INDEX(sucursal_area, "/", 1)'))
            ->orderByDesc('count')
            ->limit(10)
            ->get();

            // Conteo por estado de activos
            $estadosCount = [
                'Activo' => Activo::when($sucursal, function($query) use ($sucursal) {
                    $query->where('sucursal_area', 'like', "%{$sucursal}%");
                })->where('estado', 'Activo')->count(),
                'En Reparación' => Activo::when($sucursal, function($query) use ($sucursal) {
                    $query->where('sucursal_area', 'like', "%{$sucursal}%");
                })->where('estado', 'En Reparación')->count(),
                'Obsoleto' => Activo::when($sucursal, function($query) use ($sucursal) {
                    $query->where('sucursal_area', 'like', "%{$sucursal}%");
                })->where('estado', 'Obsoleto')->count(),
            ];
        }

        if ($tipo === 'impresoras' || empty($tipo)) {
            // === QUERY BASE PARA IMPRESORAS ===
            $queryImpresoras = Impresora::query();

            // === DATOS DE IMPRESORAS ===
            $totalImpresoras = $queryImpresoras->count();
            $impresorasActivas = Impresora::where('estado', 'Activa')->count();
            $impresorasMantenimiento = Impresora::where('estado', 'En Mantenimiento')->count();

            // Impresoras por marca
            $impresorasPorMarca = Impresora::selectRaw('marca, COUNT(*) as count')
                ->groupBy('marca')
                ->orderByDesc('count')
                ->get();

            // Estados de impresoras
            $estadosImpresoras = [
                'Activas' => $impresorasActivas,
                'En Mantenimiento' => $impresorasMantenimiento,
                'Inactivas' => $totalImpresoras - $impresorasActivas - $impresorasMantenimiento,
            ];
        }

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

        // Tipos para el select - ACTUALIZADO
        $tiposList = [
            '' => 'Todos',
            'computadoras' => 'Computadoras',
            'impresoras' => 'Impresoras'
        ];

        // Vencimientos por mes (simulado)
        $meses = ['Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago'];
        $vencimientosPorMes = [];
        foreach ($meses as $mes) {
            $vencimientosPorMes[$mes] = rand(0, 6);
        }

        // === RETURN ACTUALIZADO CON HEADERS ANTI-CACHE ===
        return response()
            ->view('dashboard', compact(
                'totalActivos',
                'sinAsignar',
                'vencimientosProximos',
                'sucursalesList',
                'tiposList',
                'rango',
                'activosPorSucursal',
                'vencimientosPorMes',
                'estadosCount',
                'totalImpresoras',
                'impresorasActivas',
                'impresorasMantenimiento',
                'impresorasPorMarca',
                'estadosImpresoras',
                'tipo'
            ))
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT',
            ]);
    }
}