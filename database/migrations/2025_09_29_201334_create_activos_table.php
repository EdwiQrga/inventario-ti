<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 255);
            $table->string('tipo', 100);
            $table->string('sucursal', 150);
            $table->string('sucursal_area', 150);
            $table->string('razon_social', 255);
            $table->string('codigo_barras', 100)->unique();
            $table->string('marca', 100);
            $table->string('modelo', 100);
            $table->string('serial', 100)->unique();

            $table->date('fecha_compra')->nullable();

            $table->enum('estado', ['Activo', 'En Reparación', 'Retirado'])->default('Activo');

            $table->string('ssd', 100)->nullable();
            $table->string('ram', 100)->nullable();
            $table->string('procesador', 100)->nullable();
            $table->string('asignado_a', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activos');
    }
};
