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
        Schema::create('profesionales_ocupaciones_ceam', function (Blueprint $table) {
            $table->id();

            // Relación con profesionales_datos_generales.id
            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')->references('id')->on('profesionales_datos_generales')->onDelete('cascade');

            // Datos del primer catálogo
            $table->integer('id_catalogo_uno');
            $table->string('unidad_uno');
            $table->string('area_uno');
            $table->string('subarea_servicio_uno');
            $table->string('componente_uno');
            $table->string('ocupacion_uno');

            // Datos del segundo catálogo
            $table->integer('id_catalogo_dos');
            $table->string('unidad_dos');
            $table->string('area_dos');
            $table->string('subarea_servicio_dos');
            $table->string('componente_dos');
            $table->string('ocupacion_dos');

            // Estado
            $table->integer('mdl_status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_ceam');
    }
};
