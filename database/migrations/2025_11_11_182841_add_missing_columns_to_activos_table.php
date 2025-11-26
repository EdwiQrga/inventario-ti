<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activos', function (Blueprint $table) {
            // Columnas para alertas (agregar después de la última columna existente)
            $table->date('fecha_adquisicion')->nullable()->after('Estado');
            $table->date('fecha_vencimiento_garantia')->nullable()->after('fecha_adquisicion');
            $table->string('proveedor_garantia')->nullable()->after('fecha_vencimiento_garantia');
            $table->date('ultimo_mantenimiento')->nullable()->after('proveedor_garantia');
            $table->date('proximo_mantenimiento')->nullable()->after('ultimo_mantenimiento');
            $table->integer('frecuencia_mantenimiento_meses')->default(6)->after('proximo_mantenimiento');
            $table->enum('estado_operativo', ['optimo', 'degradado', 'critico'])->default('optimo')->after('frecuencia_mantenimiento_meses');
            $table->date('fecha_fin_vida_util')->nullable()->after('estado_operativo');
            $table->integer('vida_util_anos')->default(5)->after('fecha_fin_vida_util');
            $table->text('observaciones')->nullable()->after('vida_util_anos');
        });
    }

    public function down(): void
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};