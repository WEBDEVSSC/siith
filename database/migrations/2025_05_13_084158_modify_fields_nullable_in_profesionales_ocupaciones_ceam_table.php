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
        Schema::table('profesionales_ocupaciones_ceam', function (Blueprint $table) {
            //
            $table->integer('id_catalogo_dos')->nullable()->change();
            $table->string('unidad_dos')->nullable()->change();
            $table->string('area_dos')->nullable()->change();
            $table->string('subarea_servicio_dos')->nullable()->change();
            $table->string('componente_dos')->nullable()->change();
            $table->string('ocupacion_dos')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_ceam', function (Blueprint $table) {
            //
            $table->integer('id_catalogo_dos')->nullable(false)->change();
            $table->string('unidad_dos')->nullable(false)->change();
            $table->string('area_dos')->nullable(false)->change();
            $table->string('subarea_servicio_dos')->nullable(false)->change();
            $table->string('componente_dos')->nullable(false)->change();
            $table->string('ocupacion_dos')->nullable(false)->change();
        });
    }
};
