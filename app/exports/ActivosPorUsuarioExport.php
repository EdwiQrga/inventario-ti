<?php
// app/Exports/ActivosPorUsuarioExport.php
namespace App\Exports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivosPorUsuarioExport implements FromCollection, WithHeadings
{
    protected $usuario;
    protected $fecha;

    public function __construct($usuario = null, $fecha = null)
    {
        $this->usuario = $usuario;
        $this->fecha = $fecha;
    }

    public function collection()
    {
        $query = Activo::query();

        if ($this->usuario) {
            $query->where('asignado_a', \App\Models\User::find($this->usuario)->name);
        }

        if ($this->fecha) {
            [$inicio, $fin] = explode(' to ', $this->fecha);
            $query->whereBetween('fecha_compra', [$inicio, $fin]);
        }

        return $query->get()->map(fn($a) => [
            'ID' => $a->id,
            'Nombre' => $a->nombre,
            'Tipo' => $a->tipo,
            'Usuario' => $a->asignado_a ?? 'Bodega',
            'Fecha Compra' => $a->fecha_compra,
            'Estado' => $a->estado,
        ]);
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Tipo', 'Usuario', 'Fecha Compra', 'Estado'];
    }
}