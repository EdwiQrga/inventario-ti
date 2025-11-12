<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->string('serial')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->string('serial')->nullable(false)->change();
        });
    }
};