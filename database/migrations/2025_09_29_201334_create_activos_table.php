<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
      Schema::create('activos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->string('codigo')->unique();
    $table->foreignId('sucursal_id')->constrained();
    $table->foreignId('tipo_activo_id')->constrained();
    $table->foreignId('user_id')->nullable()->constrained();
    $table->enum('estado', ['activo', 'en_reparacion', 'obsoleto'])->default('activo');
    $table->date('fecha_adquisicion');
    $table->date('fecha_vencimiento_garantia')->nullable();
    $table->timestamps();
});
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('activos');
    }
};
