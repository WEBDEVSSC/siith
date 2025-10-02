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
        Schema::table('profesionales_cambios_de_unidad', function (Blueprint $table) {
            //
            $table->date('fecha_final')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_cambios_de_unidad', function (Blueprint $table) {
            //
            $table->date('fecha_final')->nullable(false)->change();
        });
    }
};
