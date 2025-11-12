<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            // Solo agregar si NO existe
            if (!Schema::hasColumn('activos', 'sucursal_area')) {
                $table->string('sucursal_area')->after('sucursal');
            }
            if (!Schema::hasColumn('activos', 'razon_social')) {
                $table->string('razon_social')->after('sucursal_area');
            }
            if (!Schema::hasColumn('activos', 'codigo_barras')) {
                $table->string('codigo_barras')->unique()->after('razon_social');
            }
            if (!Schema::hasColumn('activos', 'ssd')) {
                $table->string('ssd')->nullable()->after('serial');
            }
            if (!Schema::hasColumn('activos', 'ram')) {
                $table->string('ram')->nullable()->after('ssd');
            }
            if (!Schema::hasColumn('activos', 'procesador')) {
                $table->string('procesador')->nullable()->after('ram');
            }
            if (!Schema::hasColumn('activos', 'asignado_a')) {
                $table->string('asignado_a')->nullable()->after('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('activos', function (Blueprint $table) {
            $columns = ['sucursal_area', 'razon_social', 'codigo_barras', 'ssd', 'ram', 'procesador', 'asignado_a'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('activos', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};