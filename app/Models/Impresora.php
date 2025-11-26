<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    protected $table = 'impresoras'; // o cambia el nombre si prefieres

    protected $fillable = [
        'proveedor',
        'sucursal',
        'nombre_fiscal',
        'marca',
        'modelo',
        'numero_serial',
        'direccion_ip',
        'estatus', // Rentada, Comprada, En reparación, etc.
        'observaciones',
    ];
}