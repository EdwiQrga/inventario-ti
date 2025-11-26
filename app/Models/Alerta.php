<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alerta extends Model
{
    use HasFactory;

    protected $fillable = [
        'activo_id',
        'tipo',
        'titulo',
        'descripcion',
        'fecha_alerta',
        'fecha_vencimiento',
        'estado',
        'prioridad'
    ];

    protected $casts = [
        'fecha_alerta' => 'date',
        'fecha_vencimiento' => 'date',
    ];

    public function activo(): BelongsTo
    {
        return $this->belongsTo(Activo::class);
    }
}