<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activo;
use Livewire\WithPagination;

class InventarioActivos extends Component
{
    use WithPagination;

    public $search = '';
    public $tipo = '';
    public $estado = '';
    public $ubicacion = '';
    public $marca = '';
    public $modelo = '';

    // Modal
    public $showModal = false;
    public $nombre, $tipo_modal, $marca, $modelo, $sucursal, $serial,
           $descripcion, $ubicacion_modal, $fecha_compra, $fecha_vencimiento,
           $estado_modal = 'Activo', $costo, $user_id;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['nombre','tipo_modal','marca','modelo','sucursal','serial','descripcion','ubicacion_modal','fecha_compra','fecha_vencimiento','costo','user_id']);
        $this->estado_modal = 'Activo';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'tipo_modal' => 'required',
            'sucursal' => 'required',
            'serial' => 'required|unique:activos,serial',
            'fecha_compra' => 'required|date',
            'estado_modal' => 'required',
        ]);

        Activo::create([
            'nombre' => $this->nombre,
            'tipo' => $this->tipo_modal,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'sucursal' => $this->sucursal,
            'serial' => $this->serial,
            'descripcion' => $this->descripcion,
            'ubicacion' => $this->ubicacion_modal,
            'fecha_compra' => $this->fecha_compra,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'estado' => $this->estado_modal,
            'costo' => $this->costo,
            'user_id' => $this->user_id ?: null,
        ]);

        $this->closeModal();
        $this->dispatch('notify', 'Activo creado con éxito');
    }

    public function render()
    {
        $query = Activo::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nombre', 'like', "%{$this->search}%")
                  ->orWhere('serial', 'like', "%{$this->search}%")
                  ->orWhere('marca', 'like', "%{$this->search}%")
                  ->orWhere('modelo', 'like', "%{$this->search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$this->search}%"));
            });
        }

        if ($this->tipo) $query->where('tipo', $this->tipo);
        if ($this->estado) $query->where('estado', $this->estado);
        if ($this->ubicacion) $query->where('ubicacion', $this->ubicacion);
        if ($this->marca) $query->where('marca', $this->marca);
        if ($this->modelo) $query->where('modelo', $this->modelo);

        $activos = $query->latest()->paginate(10);

        // Opciones para filtros
        $tipos = Activo::distinct('tipo')->pluck('tipo');
        $estados = ['Activo', 'En Reparación', 'Retirado'];
        $ubicaciones = Activo::distinct('ubicacion')->whereNotNull('ubicacion')->pluck('ubicacion');
        $marcas = Activo::distinct('marca')->whereNotNull('marca')->pluck('marca');
        $modelos = Activo::distinct('modelo')->whereNotNull('modelo')->pluck('modelo');

        return view('livewire.inventario-activos', compact(
            'activos', 'tipos', 'estados', 'ubicaciones', 'marcas', 'modelos'
        ));
    }
}