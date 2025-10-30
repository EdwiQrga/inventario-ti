<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo; // No olvides importar el modelo

class ReporteController extends Controller
{
    public function index()
    {
        // Obtener todos los activos
        $activos = Activo::all(); // Trae todos los registros

        // Pasar los activos a la vista
        return view('reportes.index', compact('activos'));
    }

    public function exportarPDF()
    {
        // Código para generar PDF
    }

    public function exportarExcel()
    {
        // Código para generar Excel
    }

    public function exportarCSV()
    {
        // Código para generar CSV
    }
}
