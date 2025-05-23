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
        Schema::create('profesionales_ocupaciones_cesame', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')->references('id')->on('profesionales_datos_generales')->onDelete('cascade');

            $table->unsignedInteger('id_catalogo_uno');
            $table->string('unidad_uno');
            $table->string('area_uno');
            $table->string('subarea_servicio_uno');
            $table->string('componente_uno');
            $table->string('ocupacion_uno');

            $table->unsignedInteger('id_catalogo_dos')->nullable();
            $table->string('unidad_dos')->nullable();
            $table->string('area_dos')->nullable();
            $table->string('subarea_servicio_dos')->nullable();
            $table->string('componente_dos')->nullable();
            $table->string('ocupacion_dos')->nullable();

            $table->unsignedInteger('mdl_status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_cesame');
    }
};
