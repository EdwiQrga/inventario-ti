<?php

namespace App\Exports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Activo::all();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Tipo', 'Sucursal', 'Serial', 'Descripción', 'Ubicación', 'Fecha Compra', 'Fecha Vencimiento', 'Estado', 'Costo', 'User ID', 'Creado', 'Actualizado'
        ];
    }
}