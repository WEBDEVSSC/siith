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
        Schema::table('profesionales_horario', function (Blueprint $table) {
            //
            Schema::rename('profesionales_horario', 'profesionales_horarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_horario', function (Blueprint $table) {
            //
            Schema::rename('profesionales_horarios', 'profesionales_horario');
        });
    }
};
