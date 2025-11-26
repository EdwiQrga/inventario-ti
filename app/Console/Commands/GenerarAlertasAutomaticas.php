<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activo;
use App\Models\Alerta;

class GenerarAlertasAutomaticas extends Command
{
    protected $signature = 'alertas:generar';
    protected $description = 'Genera alertas automáticas para garantías, mantenimiento y fin de vida útil';

    public function handle()
    {
        $this->info('Iniciando generación de alertas automáticas...');
        
        $alertasGeneradas = 0;

        // 1. Alertas de garantía (30 días antes)
        $activosGarantia = Activo::garantiaProximaVencer(30)->get();
        foreach ($activosGarantia as $activo) {
            if (!$this->existeAlertaSimilar($activo->id, 'garantia')) {
                Alerta::create([
                    'tipo' => 'garantia',
                    'descripcion' => "Garantía próxima a vencer: {$activo->Código} - {$activo->Marca} {$activo->Modelo} - Vence en {$activo->dias_restantes_garantia} días",
                    'prioridad' => $activo->prioridad_garantia,
                    'estado' => 'Nueva',
                    'fecha' => now(),
                    'activo_id' => $activo->id,
                    'usuario_id' => 1,
                ]);
                $alertasGeneradas++;
                $this->info("Alerta de garantía: {$activo->Código}");
            }
        }

        // 2. Alertas de mantenimiento (15 días antes)
        $activosMantenimiento = Activo::mantenimientoPendiente(15)->get();
        foreach ($activosMantenimiento as $activo) {
            if (!$this->existeAlertaSimilar($activo->id, 'mantenimiento')) {
                Alerta::create([
                    'tipo' => 'mantenimiento',
                    'descripcion' => "Mantenimiento programado: {$activo->Código} - {$activo->Marca} {$activo->Modelo} - Próximo en {$activo->dias_para_mantenimiento} días",
                    'prioridad' => $activo->dias_para_mantenimiento <= 7 ? 'Crítica' : 'Moderada',
                    'estado' => 'Nueva',
                    'fecha' => now(),
                    'activo_id' => $activo->id,
                    'usuario_id' => 1,
                ]);
                $alertasGeneradas++;
                $this->info("Alerta de mantenimiento: {$activo->Código}");
            }
        }

        // 3. Alertas de fin de vida útil (6 meses antes)
        $activosFinVida = Activo::finVidaUtilProximo(6)->get();
        foreach ($activosFinVida as $activo) {
            if (!$this->existeAlertaSimilar($activo->id, 'fin_vida_util')) {
                Alerta::create([
                    'tipo' => 'fin_vida_util',
                    'descripcion' => "Fin de vida útil próximo: {$activo->Código} - {$activo->Marca} {$activo->Modelo} - {$activo->meses_restantes_vida_util} meses restantes",
                    'prioridad' => $activo->meses_restantes_vida_util <= 3 ? 'Crítica' : 'Moderada',
                    'estado' => 'Nueva',
                    'fecha' => now(),
                    'activo_id' => $activo->id,
                    'usuario_id' => 1,
                ]);
                $alertasGeneradas++;
                $this->info("Alerta de fin vida útil: {$activo->Código}");
            }
        }

        // 4. Alertas de estado operativo crítico
        $activosCriticos = Activo::estadoCritico()->get();
        foreach ($activosCriticos as $activo) {
            if (!$this->existeAlertaSimilar($activo->id, 'estado_operativo')) {
                Alerta::create([
                    'tipo' => 'estado_operativo',
                    'descripcion' => "Estado operativo crítico: {$activo->Código} - {$activo->Marca} {$activo->Modelo} requiere atención inmediata",
                    'prioridad' => 'Crítica',
                    'estado' => 'Nueva',
                    'fecha' => now(),
                    'activo_id' => $activo->id,
                    'usuario_id' => 1,
                ]);
                $alertasGeneradas++;
                $this->info("Alerta de estado crítico: {$activo->Código}");
            }
        }

        $this->info("✅ Proceso completado. Total alertas generadas: {$alertasGeneradas}");
        return 0;
    }

    private function existeAlertaSimilar($activoId, $tipo)
    {
        return Alerta::where('activo_id', $activoId)
            ->where('tipo', $tipo)
            ->whereIn('estado', ['Nueva', 'En Proceso'])
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->exists();
    }
}