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
        Schema::table('profesionales_ocupaciones_oficina_central', function (Blueprint $table) {
            $table->string('id_catalogo_uno')->nullable()->change();
            $table->string('area_uno')->nullable()->change();
            $table->string('subarea_uno')->nullable()->change();
            $table->string('programa_uno')->nullable()->change();
            $table->string('componente_uno')->nullable()->change();
            $table->string('ocupacion_uno')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_oficina_central', function (Blueprint $table) {
            $table->string('id_catalogo_uno')->nullable(false)->change();
            $table->string('area_uno')->nullable(false)->change();
            $table->string('subarea_uno')->nullable(false)->change();
            $table->string('programa_uno')->nullable(false)->change();
            $table->string('componente_uno')->nullable(false)->change();
            $table->string('ocupacion_uno')->nullable(false)->change();
        });
    }
};
