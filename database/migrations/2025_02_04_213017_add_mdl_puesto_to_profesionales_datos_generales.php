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
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            // Agregamos el campo mdl_puesto como entero y nulo
            $table->integer('mdl_puesto')->nullable()->after('mdl_datos_generales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            // Eliminar el campo mdl_puesto
            $table->dropColumn('mdl_puesto');
        });
    }
};
