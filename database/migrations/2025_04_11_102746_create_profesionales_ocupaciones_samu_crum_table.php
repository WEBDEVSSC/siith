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
        Schema::create('profesionales_ocupaciones_samu_crum', function (Blueprint $table) {
            $table->id();

            $table->integer('id_profesional');

            $table->integer('id_catalogo_uno');            
            $table->string('unidad_uno');
            $table->string('area_uno');
            $table->string('subarea_uno');
            $table->string('componente_uno');
            $table->string('ocupacion_uno');

            $table->integer('id_catalogo_dos')->nullable();
            $table->string('unidad_dos')->nullable();
            $table->string('area_dos')->nullable();
            $table->string('subarea_dos')->nullable();
            $table->string('componente_dos')->nullable();
            $table->string('ocupacion_dos')->nullable();

            $table->integer('mdl_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_samu_crum');
    }
};
