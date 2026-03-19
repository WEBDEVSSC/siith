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
        Schema::table('profesionales_bitacoras_cartera', function (Blueprint $table) {
            //
            $table->string('ocupacion_actual')
                  ->after('ocupacion_anterior')
                  ->nullable(); // opcional, por si ya hay datos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_bitacoras_cartera', function (Blueprint $table) {
            //
            $table->dropColumn('ocupacion_actual');
        });
    }
};
