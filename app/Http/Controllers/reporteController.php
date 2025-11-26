<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\Alerta;
use App\Models\User;
use App\Models\Impresora;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteActivosExport;
use PDF;
use Illuminate\Support\Facades\Log;

class ReporteController extends Controller
{
    /**
     * 📊 Página principal de reportes - MÉTODO INDEX
     */
    public function index()
    {
        Log::info('Accediendo a página de reportes');
        return view('reportes.index');
    }

    /**
     * 📤 Exportar reportes
     */
    public function exportar(Request $request)
    {
        Log::info('=== INICIANDO EXPORTACIÓN DE REPORTE ===');
        Log::info('Datos recibidos:', $request->all());
        Log::info('URL completa: ' . $request->fullUrl());

        // Validación básica
        $request->validate([
            'reporte' => 'required|string',
            'formato' => 'required|in:xlsx,csv,pdf',
            'usuario' => 'nullable|exists:users,id',
            'fecha_rango' => 'nullable|string',
        ]);

        try {
            $reporte = $request->reporte;
            $formato = $request->formato;
            $usuarioId = $request->usuario;
            $fechaRango = $request->fecha_rango;

            Log::info("Parámetros recibidos:", [
                'reporte' => $reporte,
                'formato' => $formato,
                'usuario' => $usuarioId,
                'fecha_rango' => $fechaRango
            ]);

            // Generar datos según el tipo de reporte
            $data = $this->generarDatosReporte($reporte, $usuarioId, $fechaRango);
            
            if ($data->isEmpty()) {
                Log::warning('No se encontraron datos para el reporte');
                return back()->with('error', 'No se encontraron datos para generar el reporte.');
            }

            $nombreArchivo = $this->getNombreArchivo($reporte);

            // Exportar según formato
            if ($formato === 'pdf') {
                return $this->exportarPDF($data, $nombreArchivo, $reporte);
            } else {
                $columnas = $this->getColumnasReporte($reporte);
                return Excel::download(new ReporteActivosExport($data, $columnas), $nombreArchivo . '.' . $formato);
            }

        } catch (\Exception $e) {
            Log::error('Error al exportar reporte: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }

    /**
     * 📋 Generar datos para el reporte
     */
    private function generarDatosReporte($reporte, $usuarioId = null, $fechaRango = null)
    {
        Log::info("Generando datos para reporte: $reporte");

        switch ($reporte) {
            case 'inventario_general':
                return $this->generarReporteInventarioGeneral();
            
            case 'activos_usuario':
                return $this->generarReporteActivosUsuario($usuarioId);
            
            case 'garantias_vencidas':
                $fechas = $this->procesarRangoFechas($fechaRango);
                return $this->generarReporteGarantiasVencidas($fechas);
            
            case 'mantenimiento':
                $fechas = $this->procesarRangoFechas($fechaRango);
                return $this->generarReporteMantenimiento($fechas);
            
            case 'inventario_impresoras':
                return $this->generarReporteImpresoras();
            
            default:
                Log::warning("Tipo de reporte no válido: $reporte");
                return collect();
        }
    }

    /**
     * 📋 Reporte: Inventario General (ACTUALIZADO con sucursal)
     */
    private function generarReporteInventarioGeneral()
    {
        Log::info('Generando reporte de inventario general');
        
        // Obtener activos de computo
        $activos = Activo::withCount(['alertas' => function($q) {
            $q->where('estado', 'pendiente');
        }])->orderBy('sucursal')->orderBy('marca')->get(); // ← Cambiado a sucursal

        // Obtener impresoras
        $impresoras = Impresora::orderBy('sucursal')->orderBy('marca')->get(); // ← Cambiado a sucursal

        Log::info("Encontrados {$activos->count()} activos y {$impresoras->count()} impresoras");

        $dataActivos = $activos->map(function ($activo) {
            return [
                'Tipo' => 'Equipo de Cómputo',
                'Código Barras' => $activo->codigo_barras ?? 'N/A',
                'Marca' => $activo->marca ?? 'N/A',
                'Modelo' => $activo->modelo ?? 'N/A',
                'Sucursal' => $activo->sucursal ?? 'N/A', // ← Cambiado a sucursal
                'Asignado a' => $activo->asignado ?? 'No asignado',
                'Estado' => $activo->estado ?? 'N/A',
                'Estado Operativo' => $activo->estado_operativo ?? 'N/A',
                'Proveedor Garantía' => $activo->proveedor_garantia ?? 'N/A',
                'Vida Útil (años)' => $activo->vida_util_anos ?? 'N/A',
                'Alertas Activas' => $activo->alertas_count ?? 0,
                'Fecha Adquisición' => $activo->fecha_adquisicion?->format('d/m/Y') ?? 'N/A',
                'Fin Vida Útil' => $activo->fecha_fin_vida_util?->format('d/m/Y') ?? 'N/A',
                'RAM' => $activo->ram ?? 'N/A',
                'Procesador' => $activo->procesador ?? 'N/A',
                'Almacenamiento' => $activo->sd ?? 'N/A',
            ];
        });

        $dataImpresoras = $impresoras->map(function ($impresora) {
            return [
                'Tipo' => 'Impresora',
                'Código Barras' => $impresora->codigo_barras ?? 'N/A',
                'Marca' => $impresora->marca ?? 'N/A',
                'Modelo' => $impresora->modelo ?? 'N/A',
                'Sucursal' => $impresora->sucursal ?? 'N/A', // ← Cambiado a sucursal
                'Asignado a' => $impresora->asignado ?? 'No asignado',
                'Estado' => $impresora->estado ?? 'N/A',
                'Estado Operativo' => $impresora->estado_operativo ?? 'N/A',
                'Proveedor Garantía' => $impresora->proveedor_garantia ?? 'N/A',
                'Vida Útil (años)' => $impresora->vida_util_anos ?? 'N/A',
                'Alertas Activas' => 0,
                'Fecha Adquisición' => $impresora->fecha_adquisicion?->format('d/m/Y') ?? 'N/A',
                'Fin Vida Útil' => $impresora->fecha_fin_vida_util?->format('d/m/Y') ?? 'N/A',
                'Tipo Impresora' => $impresora->tipo_impresora ?? 'N/A',
                'IP' => $impresora->ip ?? 'N/A',
                'Conectividad' => $impresora->conectividad ?? 'N/A',
            ];
        });

        // Combinar ambos tipos de equipos
        return $dataActivos->merge($dataImpresoras);
    }

    /**
     * 👤 Reporte: Activos por Usuario (ACTUALIZADO con sucursal)
     */
    private function generarReporteActivosUsuario($usuarioId = null)
    {
        Log::info('Generando reporte de activos por usuario');

        $query = Activo::whereNotNull('asignado')
            ->where('asignado', '!=', '')
            ->orderBy('asignado')
            ->orderBy('marca');

        if ($usuarioId) {
            $usuario = User::find($usuarioId);
            if ($usuario) {
                $query->where('asignado', 'LIKE', "%{$usuario->name}%");
                Log::info("Filtrando por usuario: {$usuario->name}");
            }
        }

        $activos = $query->get();
        Log::info("Encontrados {$activos->count()} activos asignados");

        return $activos->map(function ($activo) {
            return [
                'Usuario' => $activo->asignado ?? 'N/A',
                'Código Barras' => $activo->codigo_barras ?? 'N/A',
                'Marca' => $activo->marca ?? 'N/A',
                'Modelo' => $activo->modelo ?? 'N/A',
                'Sucursal' => $activo->sucursal ?? 'N/A', // ← Cambiado a sucursal
                'Estado' => $activo->estado ?? 'N/A',
                'Estado Operativo' => $activo->estado_operativo ?? 'N/A',
                'RAM' => $activo->ram ?? 'N/A',
                'Procesador' => $activo->procesador ?? 'N/A',
                'Almacenamiento' => $activo->sd ?? 'N/A',
                'Fecha Asignación' => $activo->updated_at->format('d/m/Y'),
            ];
        });
    }

    /**
     * ⚠️ Reporte: Garantías Vencidas (ACTUALIZADO con sucursal)
     */
    private function generarReporteGarantiasVencidas($fechas = null)
    {
        Log::info('Generando reporte de garantías vencidas');

        $query = Activo::whereNotNull('fecha_vencimiento_garantia')
            ->whereNotNull('proveedor_garantia')
            ->orderBy('fecha_vencimiento_garantia');

        if ($fechas) {
            $query->whereBetween('fecha_vencimiento_garantia', [$fechas['inicio'], $fechas['fin']]);
            Log::info("Filtrando por rango de fechas: {$fechas['inicio']} - {$fechas['fin']}");
        } else {
            // Por defecto, mostrar garantías que vencen en los próximos 60 días
            $query->where('fecha_vencimiento_garantia', '>=', now())
                  ->where('fecha_vencimiento_garantia', '<=', now()->addDays(60));
            Log::info('Mostrando garantías próximas a vencer (60 días)');
        }

        $activos = $query->get();
        Log::info("Encontradas {$activos->count()} garantías");

        return $activos->map(function ($activo) {
            $diasRestantes = $activo->fecha_vencimiento_garantia ? 
                now()->diffInDays(Carbon::parse($activo->fecha_vencimiento_garantia), false) : null;
            
            return [
                'Código Barras' => $activo->codigo_barras ?? 'N/A',
                'Marca' => $activo->marca ?? 'N/A',
                'Modelo' => $activo->modelo ?? 'N/A',
                'Proveedor Garantía' => $activo->proveedor_garantia ?? 'N/A',
                'Vencimiento Garantía' => $activo->fecha_vencimiento_garantia?->format('d/m/Y') ?? 'N/A',
                'Días Restantes' => $diasRestantes > 0 ? $diasRestantes : 'VENCIDA',
                'Estado' => $activo->estado ?? 'N/A',
                'Sucursal' => $activo->sucursal ?? 'N/A', // ← Cambiado a sucursal
                'Asignado a' => $activo->asignado ?? 'No asignado',
            ];
        });
    }

    /**
     * 🔧 Reporte: Historial de Mantenimiento (ACTUALIZADO con sucursal)
     */
    private function generarReporteMantenimiento($fechas = null)
    {
        Log::info('Generando reporte de mantenimiento');

        $query = Activo::where(function($q) {
                $q->whereNotNull('ultimo_mantenimiento')
                 ->orWhereNotNull('proximo_mantenimiento');
            })
            ->orderBy('proximo_mantenimiento', 'ASC')
            ->orderBy('sucursal'); // ← Cambiado a sucursal

        if ($fechas) {
            $query->where(function($q) use ($fechas) {
                $q->whereBetween('ultimo_mantenimiento', [$fechas['inicio'], $fechas['fin']])
                  ->orWhereBetween('proximo_mantenimiento', [$fechas['inicio'], $fechas['fin']]);
            });
            Log::info("Filtrando mantenimientos por rango de fechas");
        }

        $activos = $query->get();
        Log::info("Encontrados {$activos->count()} activos con mantenimiento");

        return $activos->map(function ($activo) {
            $diasProximo = $activo->proximo_mantenimiento ? 
                now()->diffInDays(Carbon::parse($activo->proximo_mantenimiento), false) : null;

            return [
                'Código Barras' => $activo->codigo_barras ?? 'N/A',
                'Marca' => $activo->marca ?? 'N/A',
                'Modelo' => $activo->modelo ?? 'N/A',
                'Sucursal' => $activo->sucursal ?? 'N/A', // ← Cambiado a sucursal
                'Último Mantenimiento' => $activo->ultimo_mantenimiento?->format('d/m/Y') ?? 'N/A',
                'Próximo Mantenimiento' => $activo->proximo_mantenimiento?->format('d/m/Y') ?? 'N/A',
                'Días para Próximo' => $diasProximo ?? 'N/A',
                'Frecuencia (meses)' => $activo->frecuencia_mantenimiento_meses ?? 'N/A',
                'Estado Operativo' => $activo->estado_operativo ?? 'N/A',
                'Asignado a' => $activo->asignado ?? 'No asignado',
            ];
        });
    }

    /**
     * 🖨️ Reporte: Inventario de Impresoras (ACTUALIZADO con sucursal)
     */
    private function generarReporteImpresoras()
    {
        Log::info('Generando reporte de inventario de impresoras');
        
        // Ordenar por sucursal y marca
        $impresoras = Impresora::orderBy('sucursal')->orderBy('marca')->get(); // ← Cambiado a sucursal

        Log::info("Encontradas {$impresoras->count()} impresoras");

        return $impresoras->map(function ($impresora) {
            return [
                'Código Barras' => $impresora->codigo_barras ?? 'N/A',
                'Marca' => $impresora->marca ?? 'N/A',
                'Modelo' => $impresora->modelo ?? 'N/A',
                'Tipo Impresora' => $impresora->tipo_impresora ?? 'N/A',
                'Sucursal' => $impresora->sucursal ?? 'N/A', // ← Cambiado a sucursal
                'Asignado a' => $impresora->asignado ?? 'No asignado',
                'Estado' => $impresora->estado ?? 'N/A',
                'Estado Operativo' => $impresora->estado_operativo ?? 'N/A',
                'Dirección IP' => $impresora->ip ?? 'N/A',
                'Conectividad' => $impresora->conectividad ?? 'N/A',
                'Proveedor Garantía' => $impresora->proveedor_garantia ?? 'N/A',
                'Vencimiento Garantía' => $impresora->fecha_vencimiento_garantia?->format('d/m/Y') ?? 'N/A',
                'Vida Útil (años)' => $impresora->vida_util_anos ?? 'N/A',
                'Fecha Adquisición' => $impresora->fecha_adquisicion?->format('d/m/Y') ?? 'N/A',
                'Fin Vida Útil' => $impresora->fecha_fin_vida_util?->format('d/m/Y') ?? 'N/A',
                'Último Mantenimiento' => $impresora->ultimo_mantenimiento?->format('d/m/Y') ?? 'N/A',
                'Próximo Mantenimiento' => $impresora->proximo_mantenimiento?->format('d/m/Y') ?? 'N/A',
                'Observaciones' => $impresora->observaciones ?? 'N/A',
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
        Log::info("Procesando rango de fechas: " . $fechaRango);
        
        return [
            'inicio' => Carbon::parse($fechas[0])->startOfDay(),
            'fin' => isset($fechas[1]) ? Carbon::parse($fechas[1])->endOfDay() : Carbon::parse($fechas[0])->endOfDay()
        ];
    }

    /**
     * 🏷️ Obtener nombre del archivo
     */
    private function getNombreArchivo($reporte)
    {
        $nombres = [
            'inventario_general' => 'inventario_general',
            'activos_usuario' => 'activos_por_usuario',
            'garantias_vencidas' => 'garantias_vencidas',
            'mantenimiento' => 'historial_mantenimiento',
            'inventario_impresoras' => 'inventario_impresoras',
        ];

        return ($nombres[$reporte] ?? 'reporte') . '_' . date('Y-m-d_H-i-s');
    }

    /**
     * 📑 Obtener columnas según tipo de reporte (ACTUALIZADO con Sucursal)
     */
    private function getColumnasReporte($reporte)
    {
        $columnas = [
            'inventario_general' => [
                'Tipo', 'Código Barras', 'Marca', 'Modelo', 'Sucursal', 'Asignado a', // ← Cambiado a Sucursal
                'Estado', 'Estado Operativo', 'Proveedor Garantía', 'Vida Útil (años)',
                'Alertas Activas', 'Fecha Adquisición', 'Fin Vida Útil', 'RAM', 'Procesador', 'Almacenamiento'
            ],
            'activos_usuario' => [
                'Usuario', 'Código Barras', 'Marca', 'Modelo', 'Sucursal', // ← Cambiado a Sucursal
                'Estado', 'Estado Operativo', 'RAM', 'Procesador', 'Almacenamiento',
                'Fecha Asignación'
            ],
            'garantias_vencidas' => [
                'Código Barras', 'Marca', 'Modelo', 'Proveedor Garantía', 
                'Vencimiento Garantía', 'Días Restantes', 'Estado', 'Sucursal', 'Asignado a' // ← Cambiado a Sucursal
            ],
            'mantenimiento' => [
                'Código Barras', 'Marca', 'Modelo', 'Sucursal', // ← Cambiado a Sucursal
                'Último Mantenimiento', 'Próximo Mantenimiento', 'Días para Próximo',
                'Frecuencia (meses)', 'Estado Operativo', 'Asignado a'
            ],
            'inventario_impresoras' => [
                'Código Barras', 'Marca', 'Modelo', 'Tipo Impresora', 'Sucursal', // ← Cambiado a Sucursal
                'Asignado a', 'Estado', 'Estado Operativo', 'Dirección IP', 'Conectividad',
                'Proveedor Garantía', 'Vencimiento Garantía', 'Vida Útil (años)',
                'Fecha Adquisición', 'Fin Vida Útil', 'Último Mantenimiento', 
                'Próximo Mantenimiento', 'Observaciones'
            ],
        ];

        return $columnas[$reporte] ?? [];
    }

    /**
     * 📄 Exportar a PDF
     */
   /**
 * 📄 Exportar a PDF - MEJORADO
 */
/**
 * 📄 Exportar a PDF - CON HTML INLINE
 */
private function exportarPDF($data, $nombreArchivo, $tipoReporte)
{
    Log::info("Exportando a PDF: $nombreArchivo - Registros: " . count($data));

    try {
        // HTML directo como fallback
        $html = $this->generarHTMLParaPDF($data, $tipoReporte);
        
        $pdf = PDF::loadHTML($html);
        return $pdf->download($nombreArchivo . '.pdf');

    } catch (\Exception $e) {
        Log::error('Error al generar PDF: ' . $e->getMessage());
        throw new \Exception('Error al generar el archivo PDF: ' . $e->getMessage());
    }
}

/**
 * 📝 Generar HTML para PDF
 */
private function generarHTMLParaPDF($data, $tipoReporte)
{
    $titulo = $this->getTituloReporte($tipoReporte);
    $columnas = $this->getColumnasReporte($tipoReporte);
    $fechaGeneracion = now()->format('d/m/Y H:i:s');

    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <title>{$titulo}</title>
        <style>
            body { font-family: Arial, sans-serif; font-size: 12px; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #005850; color: white; }
            tr:nth-child(even) { background-color: #f9f9f9; }
        </style>
    </head>
    <body>
        <h1>{$titulo}</h1>
        <p>Generado: {$fechaGeneracion}</p>
        <p>Total registros: " . count($data) . "</p>
        
        <table>
            <thead>
                <tr>
    ";
    
    foreach ($columnas as $columna) {
        $html .= "<th>{$columna}</th>";
    }
    
    $html .= "
                </tr>
            </thead>
            <tbody>
    ";
    
    foreach ($data as $fila) {
        $html .= "<tr>";
        foreach ($fila as $valor) {
            $html .= "<td>{$valor}</td>";
        }
        $html .= "</tr>";
    }
    
    $html .= "
            </tbody>
        </table>
    </body>
    </html>
    ";
    
    return $html;
}
    /**
     * 🏷️ Obtener título del reporte
     */
    private function getTituloReporte($reporte)
    {
        $titulos = [
            'inventario_general' => 'Inventario General (Equipos + Impresoras)',
            'activos_usuario' => 'Activos por Usuario',
            'garantias_vencidas' => 'Reporte de Garantías Vencidas/Próximas a Vencer',
            'mantenimiento' => 'Historial de Mantenimiento de Activos',
            'inventario_impresoras' => 'Inventario de Impresoras',
        ];

        return $titulos[$reporte] ?? 'Reporte de Activos';
    }
}
