<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'asset_tag',
        'serial',
        'model_id',
        'category_id',
        'status',
        'assigned_to',
        'image',
    ];

    public $timestamps = true;

    // Relaciones
    public function model()
    {
        return $this->belongsTo(DeviceModel::class, 'model_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
