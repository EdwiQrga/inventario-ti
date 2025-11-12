<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AlertaController extends Controller
{
    public function index(Request $request)
    {
        // ================================
        // 🔔 ALERTAS DE LICENCIAS POR VENCER
        // ================================
        $alertasLicencias = Activo::whereNotNull('fecha_vencimiento')
            ->where('fecha_vencimiento', '<=', now()->addDays(60)) // Próximos 60 días
            ->with('user')
            ->get();

        // Licencias que vencen en menos de 30 días (aún vigentes)
        $licenciasProximas = $alertasLicencias->filter(function ($licencia) {
            $dias = now()->diffInDays(Carbon::parse($licencia->fecha_vencimiento), false);
            return $dias <= 30 && $dias >= 0;
        });

        // ================================
        // 🛠️ ALERTAS DE MANTENIMIENTOS PROGRAMADOS
        // ================================
        $alertasMantenimiento = Activo::whereNotNull('fecha_mantenimiento')
            ->where('fecha_mantenimiento', '>=', now()->subDays(30)) // últimos 30 días o próximos
            ->get();

        // Si tienes un campo `tipo_mantenimiento`, lo usamos para filtrar los programados
        $mantenimientosProgramados = $alertasMantenimiento->filter(function ($activo) {
            return strtolower($activo->tipo_mantenimiento) === 'programado';
        });

        // ================================
        // 📊 RETORNO A LA VISTA
        // ================================
        return view('alertas.index', compact(
            'alertasLicencias',
            'licenciasProximas',
            'alertasMantenimiento',
            'mantenimientosProgramados'
        ));
    }
}
