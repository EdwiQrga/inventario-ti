<?php 
namespace App\Exports;

use App\Models\Mantenimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistorialMantenimientoExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $usuarioId;
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($usuarioId = null, $fechaInicio = null, $fechaFin = null)
    {
        $this->usuarioId = $usuarioId;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function collection()
    {
        $query = Mantenimiento::with('activo.usuario');

        if ($this->usuarioId) {
            $query->whereHas('activo', function($q) {
                $q->where('usuario_id', $this->usuarioId);
            });
        }

        if ($this->fechaInicio && $this->fechaFin) {
            $query->whereBetween('fecha_mantenimiento', [$this->fechaInicio, $this->fechaFin]);
        }

        return $query->orderBy('fecha_mantenimiento', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Activo',
            'Tipo de Mantenimiento',
            'Descripción',
            'Fecha',
            'Costo',
            'Realizado Por',
            'Estado'
        ];
    }

    public function map($mantenimiento): array
    {
        return [
            $mantenimiento->id,
            $mantenimiento->activo->nombre ?? 'N/A',
            $mantenimiento->tipo,
            $mantenimiento->descripcion,
            $mantenimiento->fecha_mantenimiento ? $mantenimiento->fecha_mantenimiento->format('d/m/Y') : 'N/A',
            '$' . number_format($mantenimiento->costo, 2),
            $mantenimiento->realizado_por,
            $mantenimiento->estado
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}