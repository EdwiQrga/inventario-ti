<?php

namespace App\Exports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActivosExport implements FromCollection, WithHeadings, WithMapping
{
    protected $usuarioId, $inicio, $fin;

    public function __construct($usuarioId = null, $inicio = null, $fin = null)
    {
        $this->usuarioId = $usuarioId;
        $this->inicio = $inicio;
        $this->fin = $fin;
    }

    public function collection()
    {
        $query = Activo::with('user');

        if ($this->usuarioId) {
            $query->where('user_id', $this->usuarioId);
        }

        if ($this->inicio && $this->fin) {
            $query->whereBetween('fecha_compra', [$this->inicio, $this->fin]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Tipo', 'Marca', 'Modelo', 'Serial', 'Código Barras',
            'Sucursal', 'Área', 'Razón Social', 'Estado', 'Asignado A', 'Fecha Compra'
        ];
    }

    public function map($activo): array
    {
        return [
            $activo->id,
            $activo->nombre,
            $activo->tipo,
            $activo->marca,
            $activo->modelo,
            $activo->serial,
            $activo->codigo_barras,
            $activo->sucursal,
            $activo->sucursal_area,
            $activo->razon_social,
            $activo->estado,
            $activo->asignado_a ?? $activo->user?->name ?? 'Sin asignar',
            $activo->fecha_compra,
        ];
    }
}