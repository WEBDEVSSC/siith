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
        Schema::table('profesionales_puesto', function (Blueprint $table) {
            $table->string('fiel')->nullable()->change();
            $table->string('actividad')->nullable()->change();
            $table->string('adicional')->nullable()->change();
            $table->string('tipo_personal')->nullable()->change();
            $table->string('codigo_puesto')->nullable()->change();
            $table->string('clues_nomina')->nullable()->change();
            $table->string('clues_nomina_nombre')->nullable()->change();
            $table->string('clues_nomina_municipio')->nullable()->change();
            $table->string('clues_nomina_jurisdiccion')->nullable()->change();
            $table->string('clues_adscripcion')->nullable()->change();
            $table->string('clues_adscripcion_nombre')->nullable()->change();
            $table->string('clues_adscripcion_municipio')->nullable()->change();
            $table->string('clues_adscripcion_jurisdiccion')->nullable()->change();
            $table->string('area_trabajo')->nullable()->change();
            $table->string('ocupacion')->nullable()->change();
            $table->string('nomina_pago')->nullable()->change();
            $table->string('tipo_contrato')->nullable()->change();
            $table->string('tipo_plaza')->nullable()->change();
            $table->string('institucion_puesto')->nullable()->change();
            $table->string('vigencia')->nullable()->change();
            $table->string('vigencia_motivo')->nullable()->change();
            $table->string('temporalidad')->nullable()->change();
            $table->string('seguro_salud')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_puesto', function (Blueprint $table) {
            $table->string('fiel')->nullable(false)->change();
            $table->string('actividad')->nullable(false)->change();
            $table->string('adicional')->nullable(false)->change();
            $table->string('tipo_personal')->nullable(false)->change();
            $table->string('codigo_puesto')->nullable(false)->change();
            $table->string('clues_nomina')->nullable(false)->change();
            $table->string('clues_nomina_nombre')->nullable(false)->change();
            $table->string('clues_nomina_municipio')->nullable(false)->change();
            $table->string('clues_nomina_jurisdiccion')->nullable(false)->change();
            $table->string('clues_adscripcion')->nullable(false)->change();
            $table->string('clues_adscripcion_nombre')->nullable(false)->change();
            $table->string('clues_adscripcion_municipio')->nullable(false)->change();
            $table->string('clues_adscripcion_jurisdiccion')->nullable(false)->change();
            $table->string('area_trabajo')->nullable(false)->change();
            $table->string('ocupacion')->nullable(false)->change();
            $table->string('nomina_pago')->nullable(false)->change();
            $table->string('tipo_contrato')->nullable(false)->change();
            $table->string('tipo_plaza')->nullable(false)->change();
            $table->string('institucion_puesto')->nullable(false)->change();
            $table->string('vigencia')->nullable(false)->change();
            $table->string('vigencia_motivo')->nullable(false)->change();
            $table->string('temporalidad')->nullable(false)->change();
            $table->string('seguro_salud')->nullable(false)->change();
        });
    }
};