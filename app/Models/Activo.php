<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $fillable = [
        'nombre', 'tipo', 'marca', 'modelo', 'sucursal', 'serial',
        'descripcion', 'ubicacion', 'fecha_compra', 'fecha_vencimiento',
        'estado', 'costo', 'user_id'
    ];

    protected $dates = ['fecha_compra', 'fecha_vencimiento'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}