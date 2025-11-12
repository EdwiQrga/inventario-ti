<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->string('estado', 20)->change(); // Aumenta a 20 caracteres
        });
    }

    public function down()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->string('estado', 10)->change(); // Vuelve a 10 si haces rollback
        });
    }
};