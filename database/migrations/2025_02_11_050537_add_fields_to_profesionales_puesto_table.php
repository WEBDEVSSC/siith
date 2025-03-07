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
            $table->string('actividad')->after('fiel_vigencia');
            $table->string('adicional')->after('actividad');
            $table->string('tipo_personal')->after('adicional');
            $table->string('codigo_puesto')->after('tipo_personal');
            $table->string('clues_nomina')->after('codigo_puesto');
            $table->string('clues_nomina_nombre')->after('clues_nomina');
            $table->string('clues_nomina_municipio')->after('clues_nomina_nombre');
            $table->integer('clues_nomina_jurisdiccion')->after('clues_nomina_municipio');
            $table->string('clues_adscripcion')->after('clues_nomina_jurisdiccion');
            $table->string('clues_adscripcion_nombre')->after('clues_adscripcion');
            $table->string('clues_adscripcion_municipio')->after('clues_adscripcion_nombre');
            $table->integer('clues_adscripcion_jurisdiccion')->after('clues_adscripcion_municipio');
            $table->string('area_trabajo')->after('clues_adscripcion_jurisdiccion');
            $table->string('ocupacion')->after('area_trabajo');
            $table->string('nomina_pago')->after('ocupacion');
            $table->string('tipo_contrato')->after('nomina_pago');
            $table->date('fecha_ingreso')->nullable()->after('tipo_contrato');
            $table->string('tipo_plaza')->after('fecha_ingreso');
            $table->string('institucion_puesto')->after('tipo_plaza');
            $table->string('vigencia')->after('institucion_puesto');
            $table->string('vigencia_motivo')->after('vigencia');
            $table->string('temporalidad')->after('vigencia_motivo');
            $table->string('licencia_maternidad')->nullable()->after('temporalidad');
            $table->string('seguro_salud')->after('licencia_maternidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_puesto', function (Blueprint $table) {
            $table->dropColumn([
                'actividad', 'adicional', 'tipo_personal', 'codigo_puesto', 'clues_nomina', 
                'clues_nomina_nombre', 'clues_nomina_municipio', 'clues_nomina_jurisdiccion', 
                'clues_adscripcion', 'clues_adscripcion_nombre', 'clues_adscripcion_municipio', 
                'clues_adscripcion_jurisdiccion', 'area_trabajo', 'ocupacion', 'nomina_pago', 
                'tipo_contrato', 'fecha_ingreso', 'tipo_plaza', 'institucion_puesto', 'vigencia', 
                'vigencia_motivo', 'temporalidad', 'licencia_maternidad', 'seguro_salud'
            ]);
        });
    }
};
