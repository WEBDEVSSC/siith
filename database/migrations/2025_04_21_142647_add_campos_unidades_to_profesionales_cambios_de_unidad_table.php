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
            $table->string('unidad_origen_clues')->nullable()->after('fecha_final');
            $table->string('unidad_origen_nombre')->nullable()->after('unidad_origen_clues');
            $table->integer('unidad_origen_jurisdiccion')->nullable()->after('unidad_origen_nombre');
            $table->string('unidad_destino_clues')->nullable()->after('unidad_origen_jurisdiccion');
            $table->string('unidad_destino_nombre')->nullable()->after('unidad_destino_clues');
            $table->integer('unidad_destino_jurisdiccion')->nullable()->after('unidad_destino_nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_cambios_de_unidad', function (Blueprint $table) {
            //
            $table->dropColumn([
                'unidad_origen_clues',
                'unidad_origen_nombre',
                'unidad_origen_jurisdiccion',
                'unidad_destino_clues',
                'unidad_destino_nombre',
                'unidad_destino_jurisdiccion',
            ]);
        });
    }
};
