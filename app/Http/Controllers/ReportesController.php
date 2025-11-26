<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\Alerta;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteActivosExport;
use PDF;

class ReporteController extends Controller
{
    /**
     * 📊 Página principal de reportes
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * 📤 Exportar reportes
     */
    public function exportar(Request $request)
    {
        $request->validate([
            'reporte' => 'required|string',
            'formato' => 'required|in:xlsx,csv,pdf',
            'usuario' => 'nullable|exists:users,id',
            'fecha_rango' => 'nullable|string',
        ]);

        $reporte = $request->reporte;
        $formato = $request->formato;
        $usuarioId = $request->usuario;
        $fechaRango = $request->fecha_rango;

        // Procesar rango de fechas
        $fechas = $this->procesarRangoFechas($fechaRango);

        try {
            switch ($reporte) {
                case 'inventario_general':
                    $data = $this->generarReporteInventarioGeneral();
                    $nombreArchivo = 'inventario_general_' . date('Y-m-d');
                    break;

                case 'activos_usuario':
                    $data = $this->generarReporteActivosUsuario($usuarioId);
                    $nombreArchivo = 'activos_por_usuario_' . date('Y-m-d');
                    break;

                case 'garantias_vencidas':
                    $data = $this->generarReporteGarantiasVencidas($fechas);
                    $nombreArchivo = 'garantias_vencidas_' . date('Y-m-d');
                    break;

                case 'mantenimiento':
                    $data = $this->generarReporteMantenimiento($fechas);
                    $nombreArchivo = 'historial_mantenimiento_' . date('Y-m-d');
                    break;

                default:
                    return back()->with('error', 'Tipo de reporte no válido');
            }

            // Exportar según formato
            if ($formato === 'pdf') {
                return $this->exportarPDF($data, $nombreArchivo, $reporte);
            } else {
                return Excel::download(new ReporteActivosExport($data, $this->getColumnasReporte($reporte)), $nombreArchivo . '.' . $formato);
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }

    /**
     * 📋 Reporte: Inventario General
     */
    private function generarReporteInventarioGeneral()
    {
        return Activo::with('alertas')
            ->orderBy('sucursal_area')
            ->orderBy('marca')
            ->get()
            ->map(function ($activo) {
                return [
                    'Código Barras' => $activo->codigo_barras,
                    'Marca' => $activo->marca,
                    'Modelo' => $activo->modelo,
                    'Sucursal/Área' => $activo->sucursal_area,
                    'Asignado a' => $activo->asignado,
                    'Estado' => $activo->estado,
                    'Estado Operativo' => $activo->estado_operativo,
                    'Proveedor Garantía' => $activo->proveedor_garantia,
                    'Vida Útil (años)' => $activo->vida_util_anos,
                    'Alertas Activas' => $activo->alertas->where('estado', 'pendiente')->count(),
                    'Fecha Adquisición' => $activo->fecha_adquisicion?->format('d/m/Y'),
                    'Fin Vida Útil' => $activo->fecha_fin_vida_util?->format('d/m/Y'),
                ];
            });
    }

    /**
     * 👤 Reporte: Activos por Usuario
     */
    private function generarReporteActivosUsuario($usuarioId = null)
    {
        $query = Activo::whereNotNull('asignado')
            ->where('asignado', '!=', '')
            ->orderBy('asignado')
            ->orderBy('marca');

        if ($usuarioId) {
            $usuario = User::find($usuarioId);
            $query->where('asignado', 'LIKE', "%{$usuario->name}%");
        }

        return $query->get()
            ->map(function ($activo) {
                return [
                    'Usuario' => $activo->asignado,
                    'Código Barras' => $activo->codigo_barras,
                    'Marca' => $activo->marca,
                    'Modelo' => $activo->modelo,
                    'Sucursal/Área' => $activo->sucursal_area,
                    'Estado' => $activo->estado,
                    'Estado Operativo' => $activo->estado_operativo,
                    'RAM' => $activo->ram,
                    'Procesador' => $activo->procesador,
                    'Almacenamiento' => $activo->sd,
                    'Fecha Asignación' => $activo->updated_at->format('d/m/Y'),
                ];
            });
    }

    /**
     * ⚠️ Reporte: Garantías Vencidas
     */
    private function generarReporteGarantiasVencidas($fechas = null)
    {
        $query = Activo::whereNotNull('fecha_vencimiento_garantia')
            ->whereNotNull('proveedor_garantia')
            ->orderBy('fecha_vencimiento_garantia');

        if ($fechas) {
            $query->whereBetween('fecha_vencimiento_garantia', [$fechas['inicio'], $fechas['fin']]);
        } else {
            // Por defecto, mostrar garantías que vencen en los próximos 60 días
            $query->where('fecha_vencimiento_garantia', '>=', now())
                  ->where('fecha_vencimiento_garantia', '<=', now()->addDays(60));
        }

        return $query->get()
            ->map(function ($activo) {
                $diasRestantes = now()->diffInDays(Carbon::parse($activo->fecha_vencimiento_garantia), false);
                
                return [
                    'Código Barras' => $activo->codigo_barras,
                    'Marca' => $activo->marca,
                    'Modelo' => $activo->modelo,
                    'Proveedor Garantía' => $activo->proveedor_garantia,
                    'Vencimiento Garantía' => $activo->fecha_vencimiento_garantia?->format('d/m/Y'),
                    'Días Restantes' => $diasRestantes > 0 ? $diasRestantes : 'VENCIDA',
                    'Estado' => $activo->estado,
                    'Sucursal/Área' => $activo->sucursal_area,
                    'Asignado a' => $activo->asignado,
                ];
            });
    }

    /**
     * 🔧 Reporte: Historial de Mantenimiento
     */
    private function generarReporteMantenimiento($fechas = null)
    {
        $query = Activo::where(function($q) {
                $q->whereNotNull('ultimo_mantenimiento')
                 ->orWhereNotNull('proximo_mantenimiento');
            })
            ->orderBy('proximo_mantenimiento', 'ASC')
            ->orderBy('sucursal_area');

        if ($fechas) {
            $query->where(function($q) use ($fechas) {
                $q->whereBetween('ultimo_mantenimiento', [$fechas['inicio'], $fechas['fin']])
                  ->orWhereBetween('proximo_mantenimiento', [$fechas['inicio'], $fechas['fin']]);
            });
        }

        return $query->get()
            ->map(function ($activo) {
                $diasProximo = $activo->proximo_mantenimiento ? 
                    now()->diffInDays(Carbon::parse($activo->proximo_mantenimiento), false) : null;

                return [
                    'Código Barras' => $activo->codigo_barras,
                    'Marca' => $activo->marca,
                    'Modelo' => $activo->modelo,
                    'Sucursal/Área' => $activo->sucursal_area,
                    'Último Mantenimiento' => $activo->ultimo_mantenimiento?->format('d/m/Y'),
                    'Próximo Mantenimiento' => $activo->proximo_mantenimiento?->format('d/m/Y'),
                    'Días para Próximo' => $diasProximo,
                    'Frecuencia (meses)' => $activo->frecuencia_mantenimiento_meses,
                    'Estado Operativo' => $activo->estado_operativo,
                    'Asignado a' => $activo->asignado,
                ];
            });
    }

    /**
     * 📅 Procesar rango de fechas
     */
    private function procesarRangoFechas($fechaRango)
    {
        if (!$fechaRango) return null;

        $fechas = explode(' to ', $fechaRango);
        
        return [
            'inicio' => Carbon::parse($fechas[0])->startOfDay(),
            'fin' => isset($fechas[1]) ? Carbon::parse($fechas[1])->endOfDay() : Carbon::parse($fechas[0])->endOfDay()
        ];
    }

    /**
     * 📑 Obtener columnas según tipo de reporte
     */
    private function getColumnasReporte($reporte)
    {
        $columnas = [
            'inventario_general' => [
                'Código Barras', 'Marca', 'Modelo', 'Sucursal/Área', 'Asignado a', 
                'Estado', 'Estado Operativo', 'Proveedor Garantía', 'Vida Útil (años)',
                'Alertas Activas', 'Fecha Adquisición', 'Fin Vida Útil'
            ],
            'activos_usuario' => [
                'Usuario', 'Código Barras', 'Marca', 'Modelo', 'Sucursal/Área',
                'Estado', 'Estado Operativo', 'RAM', 'Procesador', 'Almacenamiento',
                'Fecha Asignación'
            ],
            'garantias_vencidas' => [
                'Código Barras', 'Marca', 'Modelo', 'Proveedor Garantía', 
                'Vencimiento Garantía', 'Días Restantes', 'Estado', 'Sucursal/Área', 'Asignado a'
            ],
            'mantenimiento' => [
                'Código Barras', 'Marca', 'Modelo', 'Sucursal/Área', 
                'Último Mantenimiento', 'Próximo Mantenimiento', 'Días para Próximo',
                'Frecuencia (meses)', 'Estado Operativo', 'Asignado a'
            ],
        ];

        return $columnas[$reporte] ?? [];
    }

    /**
     * 📄 Exportar a PDF
     */
    private function exportarPDF($data, $nombreArchivo, $tipoReporte)
    {
        $pdf = PDF::loadView('reportes.pdf', [
            'data' => $data,
            'titulo' => $this->getTituloReporte($tipoReporte),
            'columnas' => $this->getColumnasReporte($tipoReporte),
            'fechaGeneracion' => now()->format('d/m/Y H:i:s')
        ]);

        return $pdf->download($nombreArchivo . '.pdf');
    }

    /**
     * 🏷️ Obtener título del reporte
     */
    private function getTituloReporte($reporte)
    {
        $titulos = [
            'inventario_general' => 'Inventario General de Activos',
            'activos_usuario' => 'Activos por Usuario',
            'garantias_vencidas' => 'Reporte de Garantías Vencidas/Próximas a Vencer',
            'mantenimiento' => 'Historial de Mantenimiento de Activos',
        ];

        return $titulos[$reporte] ?? 'Reporte de Activos';
    }
}