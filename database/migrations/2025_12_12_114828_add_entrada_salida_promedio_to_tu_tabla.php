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
        Schema::table('profesionales_horarios', function (Blueprint $table) {
            //
            $table->time('entrada_promedio')->nullable()->after('jornada');
            $table->time('salida_promedio')->nullable()->after('entrada_promedio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_horarios', function (Blueprint $table) {
            //
            $table->dropColumn(['entrada_promedio', 'salida_promedio']);
        });
    }
};
