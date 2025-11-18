<?php
// =============================================================================
// ARCHIVO: app/Http/Controllers/ReportesController.php
// CREA ESTE ARCHIVO EN LA RUTA EXACTA
// =============================================================================

namespace App\Http\Controllers;

use App\Exports\InventarioGeneralExport;
use App\Exports\ActivosPorUsuarioExport;
use App\Exports\GarantiasVencidasExport;
use App\Exports\HistorialMantenimientoExport;
use App\Models\Activo;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportesController extends Controller
{
    /**
     * Muestra la vista de reportes
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * Exporta el reporte seleccionado
     */
    public function export(Request $request)
    {
        // Obtener parámetros del request
        $tipoReporte = $request->input('reporte', 'activos_usuario');
        $formato = $request->input('formato', 'xlsx');
        $usuarioId = $request->input('usuario');
        $fechaRango = $request->input('fecha_rango');

        // Procesar rango de fechas
        $fechaInicio = null;
        $fechaFin = null;
        
        if ($fechaRango) {
            $fechas = explode(' to ', $fechaRango);
            $fechaInicio = $fechas[0] ?? null;
            $fechaFin = $fechas[1] ?? $fechas[0] ?? null;
        }

        // Generar nombre de archivo con timestamp
        $timestamp = now()->format('Y-m-d_His');
        $nombreArchivo = "reporte_{$tipoReporte}_{$timestamp}";

        // Ejecutar exportación según tipo de reporte
        try {
            switch ($tipoReporte) {
                case 'inventario_general':
                    return $this->exportarInventarioGeneral($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin);
                
                case 'activos_usuario':
                    return $this->exportarActivosPorUsuario($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin);
                
                case 'garantias_vencidas':
                    return $this->exportarGarantiasVencidas($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin);
                
                case 'mantenimiento':
                    return $this->exportarHistorialMantenimiento($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin);
                
                default:
                    return redirect()->back()->with('error', 'Tipo de reporte no válido');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al generar reporte: ' . $e->getMessage());
        }
    }

    /**
     * Exporta inventario general
     */
    private function exportarInventarioGeneral($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin)
    {
        $export = new InventarioGeneralExport($usuarioId, $fechaInicio, $fechaFin);

        if ($formato === 'pdf') {
            $data = $export->collection();
            $pdf = PDF::loadView('reportes.pdf.inventario_general', compact('data'));
            return $pdf->download("{$nombreArchivo}.pdf");
        }

        if ($formato === 'csv') {
            return Excel::download($export, "{$nombreArchivo}.csv", \Maatwebsite\Excel\Excel::CSV);
        }

        return Excel::download($export, "{$nombreArchivo}.xlsx");
    }

    /**
     * Exporta activos por usuario
     */
    private function exportarActivosPorUsuario($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin)
    {
        $export = new ActivosPorUsuarioExport($usuarioId, $fechaInicio, $fechaFin);

        if ($formato === 'pdf') {
            $data = $export->getData();
            $pdf = PDF::loadView('reportes.pdf.activos_usuario', compact('data'));
            return $pdf->download("{$nombreArchivo}.pdf");
        }

        if ($formato === 'csv') {
            return Excel::download($export, "{$nombreArchivo}.csv", \Maatwebsite\Excel\Excel::CSV);
        }

        return Excel::download($export, "{$nombreArchivo}.xlsx");
    }

    /**
     * Exporta garantías vencidas
     */
    private function exportarGarantiasVencidas($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin)
    {
        $export = new GarantiasVencidasExport($usuarioId, $fechaInicio, $fechaFin);

        if ($formato === 'pdf') {
            $data = $export->collection();
            $pdf = PDF::loadView('reportes.pdf.garantias_vencidas', compact('data'));
            return $pdf->download("{$nombreArchivo}.pdf");
        }

        if ($formato === 'csv') {
            return Excel::download($export, "{$nombreArchivo}.csv", \Maatwebsite\Excel\Excel::CSV);
        }

        return Excel::download($export, "{$nombreArchivo}.xlsx");
    }

    /**
     * Exporta historial de mantenimiento
     */
    private function exportarHistorialMantenimiento($formato, $nombreArchivo, $usuarioId, $fechaInicio, $fechaFin)
    {
        $export = new HistorialMantenimientoExport($usuarioId, $fechaInicio, $fechaFin);

        if ($formato === 'pdf') {
            $data = $export->collection();
            $pdf = PDF::loadView('reportes.pdf.mantenimiento', compact('data'));
            return $pdf->download("{$nombreArchivo}.pdf");
        }

        if ($formato === 'csv') {
            return Excel::download($export, "{$nombreArchivo}.csv", \Maatwebsite\Excel\Excel::CSV);
        }

        return Excel::download($export, "{$nombreArchivo}.xlsx");
    }
}
