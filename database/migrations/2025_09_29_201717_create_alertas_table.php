<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // garantia, mantenimiento, fin_vida_util, estado_operativo
            $table->text('descripcion');
            $table->enum('prioridad', ['Crítica', 'Moderada', 'Información']);
            $table->enum('estado', ['Nueva', 'En Proceso', 'Resuelta'])->default('Nueva');
            $table->dateTime('fecha');
            $table->foreignId('activo_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained()->onDelete('cascade');
            $table->dateTime('fecha_resolucion')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index(['estado', 'prioridad']);
            $table->index(['tipo', 'fecha']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};