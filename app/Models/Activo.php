<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    // app/Models/Activo.php
protected $fillable = [
        'nombre', 'tipo', 'marca', 'modelo', 'sucursal', 'sucursal_area',
        'razon_social', 'codigo_barras', 'serial', 'ssd', 'ram', 'procesador',
        'descripcion', 'ubicacion', 'fecha_compra', 'fecha_vencimiento',
        'estado', 'costo', 'user_id', 'asignado_a'
    ];
    // ¡¡LARAVEL 12: Usa 'date' sin formato si es Y-m-d!!
    protected $casts = [
        'fecha_compra' => 'date',           // ← 2023-01-15 → Carbon
        'fecha_vencimiento' => 'date',      // ← 2025-12-31 → Carbon
        'costo' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}