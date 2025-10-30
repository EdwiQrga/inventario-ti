<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activo;
use App\Models\Sucursal;
use App\Models\TipoActivo;
use Carbon\Carbon;

class DashboardInventory extends Component
{
    public $sucursal_id = '';
    public $tipo_activo_id = '';
    public $fecha_inicio = '';
    public $fecha_fin = '';

    public $sucursales;
    public $tipos;

    public $total;
    public $porAsignar;
    public $vencimientosMes;
    public $porSucursal = [];
    public $porEstado = [];
    public $vencimientosPorMes = [];

    public function mount()
    {
        $this->sucursales = Sucursal::all();
        $this->tipos = TipoActivo::all();
        $this->fecha_inicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fecha_fin = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function updated($field)
    {
        $this->dispatch('updateCharts');
    }

    public function render()
    {
        $query = Activo::query();

        if ($this->sucursal_id) $query->where('sucursal_id', $this->sucursal_id);
        if ($this->tipo_activo_id) $query->where('tipo_activo_id', $this->tipo_activo_id);
        if ($this->fecha_inicio && $this->fecha_fin) {
            $query->whereBetween('fecha_adquisicion', [$this->fecha_inicio, $this->fecha_fin]);
        }

        $activos = $query->get();

        $this->total = $activos->count();
        $this->porAsignar = $activos->whereNull('user_id')->count();
        $this->vencimientosMes = Activo::whereMonth('fecha_vencimiento_garantia', now()->month)
                                       ->whereYear('fecha_vencimiento_garantia', now()->year)
                                       ->count();

        $this->porSucursal = $activos->groupBy('sucursal_id')->map->count();
        $this->porEstado = $activos->groupBy('estado')->map->count();

        // 6 meses próximos (Enero a Junio)
        $this->vencimientosPorMes = [];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'];
        foreach ($meses as $i => $mes) {
            $fecha = Carbon::now()->startOfYear()->addMonths($i);
            $count = Activo::whereMonth('fecha_vencimiento_garantia', $fecha->month)
                           ->whereYear('fecha_vencimiento_garantia', $fecha->year)
                           ->count();
            $this->vencimientosPorMes[] = [
                'mes' => $mes,
                'count' => $count,
                'height' => $count > 0 ? max(20, min(90, $count * 10)) : 5
            ];
        }

        return view('livewire.dashboard-inventory');
    }
}