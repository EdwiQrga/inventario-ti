<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activo extends Model
{
    use HasFactory;

    protected $fillable = [
        'sucursal_area',
        'razon_social', 
        'codigo_barras',
        'marca',
        'modelo',
        'sd',
        'ram',
        'procesador',
        'asignado',
        'estado',
        'asignado_a',
        'fecha_compra',
        'sucursal',
        'tipo',
        // Nuevos campos para reportes y alertas
        'fecha_adquisicion',
        'fecha_vencimiento_garantia',
        'proveedor_garantia',
        'ultimo_mantenimiento',
        'proximo_mantenimiento',
        'frecuencia_mantenimiento_meses',
        'estado_operativo',
        'fecha_fin_vida_util',
        'vida_util_anos',
        'observaciones'
    ];

    protected $casts = [
        'fecha_adquisicion' => 'date',
        'fecha_vencimiento_garantia' => 'date',
        'ultimo_mantenimiento' => 'date',
        'proximo_mantenimiento' => 'date',
        'fecha_fin_vida_util' => 'date',
        'fecha_compra' => 'date',
    ];

    /**
     * Relación con las alertas
     */
    public function alertas(): HasMany
    {
        return $this->hasMany(Alerta::class);
    }
}