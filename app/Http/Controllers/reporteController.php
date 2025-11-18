<?php
// =============================================================================
// ARCHIVO: app/Http/Controllers/ReportesController.php
// COPIA TODO ESTE CONTENIDO Y REEMPLAZA EL ARCHIVO COMPLETO
// =============================================================================

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Log para debug
        Log::info('=== EXPORTANDO REPORTE ===');
        Log::info('Parámetros recibidos:', $request->all());

        $tipoReporte = $request->input('reporte', 'activos_usuario');
        $formato = $request->input('formato', 'xlsx');
        $usuarioId = $request->input('usuario');
        $fechaRango = $request->input('fecha_rango');

        Log::info("Tipo: {$tipoReporte}, Formato: {$formato}");

        try {
            // Generar nombre de archivo
            $timestamp = now()->format('Y-m-d_His');
            $nombreArchivo = "reporte_{$tipoReporte}_{$timestamp}";

            // Ejecutar según formato
            switch ($formato) {
                case 'csv':
                    return $this->exportarCSV($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango);
                
                case 'xlsx':
                    return $this->exportarExcel($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango);
                
                case 'pdf':
                    return $this->exportarPDF($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango);
                
                default:
                    return redirect()->back()->with('error', 'Formato no válido');
            }

        } catch (\Exception $e) {
            Log::error('Error en export: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Exportar a CSV (más simple, sin dependencias complejas)
     */
    private function exportarCSV($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango)
    {
        Log::info('Generando CSV...');

        // Obtener datos según tipo de reporte
        $datos = $this->obtenerDatos($tipoReporte, $usuarioId, $fechaRango);

        // Crear contenido CSV
        $csv = '';
        
        // Headers según tipo de reporte
        switch ($tipoReporte) {
            case 'inventario_general':
                $csv .= "ID,Nombre,Categoría,Marca,Modelo,Usuario,Estado,Ubicación,Valor\n";
                foreach ($datos as $item) {
                    $csv .= $this->escaparCSV([
                        $item->id,
                        $item->nombre,
                        $item->categoria->nombre ?? 'N/A',
                        $item->marca ?? '',
                        $item->modelo ?? '',
                        $item->usuario->name ?? 'Sin asignar',
                        $item->estado ?? '',
                        $item->ubicacion ?? '',
                        '$' . number_format($item->valor ?? 0, 2)
                    ]);
                }
                break;

            case 'activos_usuario':
                $csv .= "Usuario,Email,Activo,Categoría,Marca,Modelo,Estado\n";
                foreach ($datos as $item) {
                    $csv .= $this->escaparCSV([
                        $item->usuario->name ?? 'Sin usuario',
                        $item->usuario->email ?? '',
                        $item->nombre,
                        $item->categoria->nombre ?? 'N/A',
                        $item->marca ?? '',
                        $item->modelo ?? '',
                        $item->estado ?? ''
                    ]);
                }
                break;

            case 'garantias_vencidas':
                $csv .= "ID,Nombre,Marca,Modelo,Usuario,Garantía Hasta,Estado\n";
                foreach ($datos as $item) {
                    $garantiaHasta = $item->garantia_hasta ? date('d/m/Y', strtotime($item->garantia_hasta)) : 'N/A';
                    $csv .= $this->escaparCSV([
                        $item->id,
                        $item->nombre,
                        $item->marca ?? '',
                        $item->modelo ?? '',
                        $item->usuario->name ?? 'Sin asignar',
                        $garantiaHasta,
                        $item->estado ?? ''
                    ]);
                }
                break;

            case 'mantenimiento':
                $csv .= "ID,Activo,Tipo,Descripción,Fecha,Costo,Estado\n";
                foreach ($datos as $item) {
                    $csv .= $this->escaparCSV([
                        $item->id ?? '',
                        $item->activo->nombre ?? 'N/A',
                        $item->tipo ?? '',
                        $item->descripcion ?? '',
                        isset($item->fecha_mantenimiento) ? date('d/m/Y', strtotime($item->fecha_mantenimiento)) : 'N/A',
                        '$' . number_format($item->costo ?? 0, 2),
                        $item->estado ?? ''
                    ]);
                }
                break;
        }

        // Retornar como descarga
        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$nombreArchivo}.csv\"",
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    /**
     * Exportar a Excel usando Laravel Excel
     */
    private function exportarExcel($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango)
    {
        Log::info('Generando Excel...');

        // Verificar que Laravel Excel esté disponible
        if (!class_exists(\Maatwebsite\Excel\Facades\Excel::class)) {
            Log::error('Laravel Excel no disponible');
            return $this->exportarCSV($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango);
        }

        // Obtener datos
        $datos = $this->obtenerDatos($tipoReporte, $usuarioId, $fechaRango);

        // Crear export dinámico
        $export = new class($datos, $tipoReporte) implements 
            \Maatwebsite\Excel\Concerns\FromCollection,
            \Maatwebsite\Excel\Concerns\WithHeadings,
            \Maatwebsite\Excel\Concerns\WithStyles
        {
            private $datos;
            private $tipo;

            public function __construct($datos, $tipo)
            {
                $this->datos = $datos;
                $this->tipo = $tipo;
            }

            public function collection()
            {
                return $this->datos;
            }

            public function headings(): array
            {
                switch ($this->tipo) {
                    case 'inventario_general':
                        return ['ID', 'Nombre', 'Categoría', 'Marca', 'Modelo', 'Usuario', 'Estado', 'Valor'];
                    case 'activos_usuario':
                        return ['Usuario', 'Email', 'Activo', 'Categoría', 'Estado'];
                    case 'garantias_vencidas':
                        return ['ID', 'Nombre', 'Usuario', 'Garantía Hasta'];
                    default:
                        return ['ID', 'Nombre', 'Descripción'];
                }
            }

            public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
            {
                return [
                    1 => ['font' => ['bold' => true, 'size' => 12]]
                ];
            }
        };

        return \Maatwebsite\Excel\Facades\Excel::download($export, "{$nombreArchivo}.xlsx");
    }

    /**
     * Exportar a PDF usando DomPDF
     */
    private function exportarPDF($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango)
    {
        Log::info('Generando PDF...');

        // Verificar que DomPDF esté disponible
        if (!class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            Log::error('DomPDF no disponible');
            return $this->exportarCSV($tipoReporte, $nombreArchivo, $usuarioId, $fechaRango);
        }

        // Obtener datos
        $datos = $this->obtenerDatos($tipoReporte, $usuarioId, $fechaRango);

        // HTML simple para PDF
        $html = $this->generarHTMLParaPDF($tipoReporte, $datos);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        return $pdf->download("{$nombreArchivo}.pdf");
    }

    /**
     * Obtener datos según tipo de reporte
     */
    private function obtenerDatos($tipoReporte, $usuarioId, $fechaRango)
    {
        Log::info("Obteniendo datos para: {$tipoReporte}");

        $query = Activo::query();

        // Eager loading
        if (method_exists(Activo::class, 'usuario')) {
            $query->with('usuario');
        }
        if (method_exists(Activo::class, 'categoria')) {
            $query->with('categoria');
        }

        // Filtrar por usuario si se especifica
        if ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        }

        // Filtrar por fechas si se especifica
        if ($fechaRango) {
            $fechas = explode(' to ', $fechaRango);
            if (count($fechas) == 2) {
                $query->whereBetween('created_at', [$fechas[0], $fechas[1]]);
            }
        }

        // Filtros específicos según tipo de reporte
        switch ($tipoReporte) {
            case 'activos_usuario':
                $query->whereNotNull('usuario_id');
                break;

            case 'garantias_vencidas':
                $query->whereNotNull('garantia_hasta')
                      ->where('garantia_hasta', '<=', now()->addMonths(3));
                break;

            case 'mantenimiento':
                // Si existe tabla mantenimientos
                if (class_exists(\App\Models\Mantenimiento::class)) {
                    return \App\Models\Mantenimiento::with('activo.usuario')->get();
                }
                return collect([]); // Colección vacía si no existe
        }

        $resultado = $query->get();
        Log::info("Registros encontrados: " . $resultado->count());

        return $resultado;
    }

    /**
     * Escapar valores para CSV
     */
    private function escaparCSV($campos)
    {
        $linea = '';
        foreach ($campos as $campo) {
            $campo = str_replace('"', '""', $campo); // Escapar comillas
            $linea .= '"' . $campo . '",';
        }
        return rtrim($linea, ',') . "\n";
    }

    /**
     * Generar HTML simple para PDF
     */
    private function generarHTMLParaPDF($tipoReporte, $datos)
    {
        $titulo = match($tipoReporte) {
            'inventario_general' => 'Inventario General',
            'activos_usuario' => 'Activos por Usuario',
            'garantias_vencidas' => 'Garantías Vencidas',
            'mantenimiento' => 'Historial de Mantenimiento',
            default => 'Reporte'
        };

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <title>{$titulo}</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 11px; }
                h1 { color: #005850; text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
                th { background-color: #005850; color: white; }
                .fecha { text-align: right; font-size: 9px; color: #666; }
            </style>
        </head>
        <body>
            <h1>{$titulo}</h1>
            <p class='fecha'>Generado: " . now()->format('d/m/Y H:i:s') . "</p>
            <table>
                <thead><tr>
                    <th>ID</th><th>Nombre</th><th>Usuario</th><th>Estado</th>
                </tr></thead>
                <tbody>";

        foreach ($datos as $item) {
            $html .= "<tr>
                <td>{$item->id}</td>
                <td>" . ($item->nombre ?? 'N/A') . "</td>
                <td>" . ($item->usuario->name ?? 'Sin asignar') . "</td>
                <td>" . ($item->estado ?? 'N/A') . "</td>
            </tr>";
        }

        $html .= "</tbody></table></body></html>";

        return $html;
    }
}