<?php 
namespace App\Exports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventarioGeneralExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
        $query = Activo::with('usuario', 'categoria');

        if ($this->usuarioId) {
            $query->where('usuario_id', $this->usuarioId);
        }

        if ($this->fechaInicio && $this->fechaFin) {
            $query->whereBetween('fecha_adquisicion', [$this->fechaInicio, $this->fechaFin]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Categoría',
            'Marca',
            'Modelo',
            'Número de Serie',
            'Usuario Asignado',
            'Estado',
            'Ubicación',
            'Fecha de Adquisición',
            'Valor',
            'Garantía Hasta'
        ];
    }

    public function map($activo): array
    {
        return [
            $activo->id,
            $activo->nombre,
            $activo->categoria->nombre ?? 'N/A',
            $activo->marca,
            $activo->modelo,
            $activo->numero_serie,
            $activo->usuario->name ?? 'Sin asignar',
            $activo->estado,
            $activo->ubicacion,
            $activo->fecha_adquisicion ? $activo->fecha_adquisicion->format('d/m/Y') : 'N/A',
            '$' . number_format($activo->valor, 2),
            $activo->garantia_hasta ? $activo->garantia_hasta->format('d/m/Y') : 'N/A'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}