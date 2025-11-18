<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       // database/migrations/xxxx_create_activos_table.php
Schema::create('activos', function (Blueprint $table) {
    $table->id();
    $table->string('sucursal_area');
    $table->string('razon_social');
    $table->string('codigo_barras')->unique();
    $table->string('marca');
    $table->string('modelo');
    $table->string('sd');
    $table->string('ram');
    $table->string('procesador');
    $table->string('asignado')->nullable();
    $table->string('estado')->default('Activo');
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('activos');
    }
};
