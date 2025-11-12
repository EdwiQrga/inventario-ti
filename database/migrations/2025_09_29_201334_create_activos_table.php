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
    $table->string('tipo');
    $table->enum('estado', ['Activo', 'En Reparación', 'Retirado'])->default('Activo');
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
    $table->date('fecha_compra');
    $table->string('ubicacion')->nullable();
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
