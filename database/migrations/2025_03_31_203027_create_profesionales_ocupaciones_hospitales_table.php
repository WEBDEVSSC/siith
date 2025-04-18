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
        Schema::create('profesionales_ocupaciones_hospitales', function (Blueprint $table) {
            $table->id();
            $table->integer('id_profesional');
            $table->integer('id_catalogo_uno')->nullable();
            $table->string('unidad_uno')->nullable();
            $table->string('area_uno')->nullable();
            $table->string('subarea_uno')->nullable();
            $table->string('puesto_uno')->nullable();
            $table->integer('id_catalogo_dos')->nullable();
            $table->string('unidad_dos')->nullable();
            $table->string('area_dos')->nullable();
            $table->string('subarea_dos')->nullable();
            $table->string('puesto_dos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_hospitales');
    }
};
