<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profesionales_ocupaciones_cors', function (Blueprint $table) {
            //
            $table->string('unidad_uno')->change();
            $table->string('area_uno')->change();
            $table->string('ocupacion_uno')->change();

            $table->string('unidad_dos')->change();
            $table->string('area_dos')->change();
            $table->string('ocupacion_dos')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_cors', function (Blueprint $table) {
            //
            $table->integer('unidad_uno')->change();
            $table->integer('area_uno')->change();
            $table->integer('ocupacion_uno')->change();

            $table->integer('unidad_dos')->change();
            $table->integer('area_dos')->change();
            $table->integer('ocupacion_dos')->change();
        });
    }
};
