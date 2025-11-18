<?php

namespace App\Exports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActivosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Activo::all();
    }
}
