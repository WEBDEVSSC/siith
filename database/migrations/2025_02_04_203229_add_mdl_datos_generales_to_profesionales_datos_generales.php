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
            // Agregamos la columna 'mdl_datos_generales' después del campo 'email'
            $table->integer('mdl_datos_generales')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            // Si revertimos la migración, eliminamos la columna 'mdl_datos_generales'
            $table->dropColumn('mdl_datos_generales');
        });
    }
};
