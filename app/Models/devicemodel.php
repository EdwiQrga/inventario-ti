<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $table = 'device_models';

    protected $fillable = [
        'name',
    ];

    public $timestamps = true;
}
