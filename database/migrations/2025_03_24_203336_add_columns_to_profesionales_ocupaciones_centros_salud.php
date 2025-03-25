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
        Schema::table('profesionales_ocupaciones_centros_salud', function (Blueprint $table) {
            //
            $table->integer('id_catalogo_dos')->after('ocupacion_uno')->nullable();
            $table->string('unidad_dos')->after('id_catalogo_dos')->nullable();
            $table->string('area_dos')->after('unidad_dos')->nullable();
            $table->string('subarea_dos')->after('area_dos')->nullable();
            $table->string('ocupacion_dos')->after('subarea_dos')->nullable();
            $table->integer('mdl_status')->after('ocupacion_dos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_centros_salud', function (Blueprint $table) {
            //
            $table->dropColumn(['id_catalogo_dos', 'unidad_dos', 'area_dos', 'subarea_dos', 'ocupacion_dos', 'mdl_status']);
        });
    }
};
