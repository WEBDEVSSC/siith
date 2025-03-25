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
            $table->renameColumn('id_catalogo', 'id_catalogo_uno');
            $table->renameColumn('unidad', 'unidad_uno');
            $table->renameColumn('area', 'area_uno');
            $table->renameColumn('subarea', 'subarea_uno');
            $table->renameColumn('ocupacion', 'ocupacion_uno');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_centros_salud', function (Blueprint $table) {
            //
            $table->renameColumn('id_catalogo_uno', 'id_catalogo');
            $table->renameColumn('unidad_uno', 'unidad');
            $table->renameColumn('area_uno', 'area');
            $table->renameColumn('subarea_uno', 'subarea');
            $table->renameColumn('ocupacion_uno', 'ocupacion');
        });
    }
};
