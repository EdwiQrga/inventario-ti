<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';

    protected $fillable = [
        'activo_id', 'tipo', 'descripcion', 'fecha_realizado',
        'proxima_fecha', 'costo', 'proveedor', 'estado'
    ];

    protected $dates = ['fecha_realizado', 'proxima_fecha'];

    public function activo()
    {
        return $this->belongsTo(Activo::class);
    }
}