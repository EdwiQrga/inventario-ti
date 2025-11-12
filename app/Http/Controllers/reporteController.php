<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivosExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $query = Activo::query();

        if ($request->filled('search')) {
            $query->where('nombre', 'like', "%{$request->search}%")
                  ->orWhere('codigo', 'like', "%{$request->search}%");
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_compra', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_compra', '<=', $request->fecha_hasta);
        }

        if ($request->filled('tipo')) $query->where('tipo', $request->tipo);
        if ($request->filled('ubicacion')) $query->where('ubicacion', $request->ubicacion);
        if ($request->filled('estado')) $query->where('estado', $request->estado);

        $activos = $query->paginate(10);

        return view('reportes.index', compact('activos'));
    }

    public function export(Request $request)
    {
        $format = $request->query('format');
        $query = Activo::query();

        // Aplicar mismos filtros
        // ... (igual que en index)

        $activos = $query->get();

        return match ($format) {
            'pdf' => Pdf::loadView('reportes.pdf', compact('activos'))->download('inventario.pdf'),
            'excel' => Excel::download(new ActivosExport($activos), 'inventario.xlsx'),
            'csv' => Excel::download(new ActivosExport($activos), 'inventario.csv', \Maatwebsite\Excel\Excel::CSV),
            default => redirect()->back(),
        };
    }
}