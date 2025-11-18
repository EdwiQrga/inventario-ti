<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MantenimientoExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Cambia por tu modelo de mantenimiento
        return \DB::table('mantenimientos')
            ->join('activos', 'mantenimientos.activo_id', '=', 'activos.id')
            ->select('activos.nombre', 'mantenimientos.fecha', 'mantenimientos.descripcion')
            ->get();
    }

    public function headings(): array
    {
        return ['Activo', 'Fecha', 'Descripción'];
    }
}