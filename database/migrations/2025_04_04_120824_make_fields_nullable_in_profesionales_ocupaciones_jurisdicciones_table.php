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
        Schema::table('profesionales_ocupaciones_jurisdicciones', function (Blueprint $table) {
            //
            $table->integer('id_catalogo_uno')->nullable()->change();
            $table->string('unidad_uno')->nullable()->change();
            $table->string('area_uno')->nullable()->change();
            $table->string('subarea_uno')->nullable()->change();
            $table->string('servicio_uno')->nullable()->change();
            $table->string('ocupacion_uno')->nullable()->change();
            $table->integer('id_catalogo_dos')->nullable()->change();
            $table->string('unidad_dos')->nullable()->change();
            $table->string('area_dos')->nullable()->change();
            $table->string('subarea_dos')->nullable()->change();
            $table->string('servicio_dos')->nullable()->change();
            $table->string('ocupacion_dos')->nullable()->change();
            $table->integer('mdl_status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_jurisdicciones', function (Blueprint $table) {
            //
            $table->integer('id_catalogo_uno')->nullable(false)->change();
            $table->string('unidad_uno')->nullable(false)->change();
            $table->string('area_uno')->nullable(false)->change();
            $table->string('subarea_uno')->nullable(false)->change();
            $table->string('servicio_uno')->nullable(false)->change();
            $table->string('ocupacion_uno')->nullable(false)->change();
            $table->integer('id_catalogo_dos')->nullable(false)->change();
            $table->string('unidad_dos')->nullable(false)->change();
            $table->string('area_dos')->nullable(false)->change();
            $table->string('subarea_dos')->nullable(false)->change();
            $table->string('servicio_dos')->nullable(false)->change();
            $table->string('ocupacion_dos')->nullable(false)->change();
            $table->integer('mdl_status')->nullable(false)->change();
        });
    }
};
