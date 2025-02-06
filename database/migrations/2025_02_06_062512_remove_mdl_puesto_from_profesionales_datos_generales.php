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
            $table->dropColumn('mdl_puesto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            $table->integer('mdl_puesto')->after('fiel_vigencia'); // O la posición que desees
        });
    }
};
