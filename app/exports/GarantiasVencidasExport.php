<?php

namespace App\Exports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class GarantiasVencidasExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
        $fechaLimite = Carbon::now()->addMonths(3);
        
        $query = Activo::with('usuario', 'categoria')
            ->whereNotNull('garantia_hasta')
            ->where('garantia_hasta', '<=', $fechaLimite);

        if ($this->usuarioId) {
            $query->where('usuario_id', $this->usuarioId);
        }

        return $query->orderBy('garantia_hasta', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Categoría',
            'Marca',
            'Modelo',
            'Usuario Asignado',
            'Garantía Hasta',
            'Días Restantes',
            'Estado de Garantía'
        ];
    }

    public function map($activo): array
    {
        $garantiaHasta = Carbon::parse($activo->garantia_hasta);
        $diasRestantes = Carbon::now()->diffInDays($garantiaHasta, false);
        $estadoGarantia = $diasRestantes < 0 ? 'VENCIDA' : ($diasRestantes <= 30 ? 'POR VENCER' : 'VIGENTE');

        return [
            $activo->id,
            $activo->nombre,
            $activo->categoria->nombre ?? 'N/A',
            $activo->marca,
            $activo->modelo,
            $activo->usuario->name ?? 'Sin asignar',
            $garantiaHasta->format('d/m/Y'),
            $diasRestantes,
            $estadoGarantia
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}