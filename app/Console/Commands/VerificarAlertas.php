<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activo;
use App\Http\Controllers\ActivoController;

class VerificarAlertas extends Command
{
    protected $signature = 'alertas:verificar';
    protected $description = 'Verificar y generar alertas para activos';

    public function handle()
    {
        $activos = Activo::whereNotNull('proximo_mantenimiento')
            ->orWhereNotNull('fecha_vencimiento_garantia')
            ->orWhereNotNull('fecha_fin_vida_util')
            ->get();

        $controller = new ActivoController();
        $totalAlertas = 0;

        foreach ($activos as $activo) {
            $alertas = $controller->generarAlertas($activo);
            $totalAlertas += count($alertas);
        }

        $this->info("Generadas {$totalAlertas} alertas.");
    }
}