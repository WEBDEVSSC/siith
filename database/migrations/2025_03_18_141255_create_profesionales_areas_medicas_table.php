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
        Schema::create('profesionales_areas_medicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesional');
            $table->string('tipo_formacion')->nullable();
            $table->integer('carrera_id')->nullable();
            $table->string('carrera_label')->nullable();
            $table->integer('institucion_educativa_id')->nullable();
            $table->string('institucion_educativa_label')->nullable();
            $table->string('anio_cursa')->nullable();
            $table->string('duracion_formacion')->nullable();
            $table->foreign('id_profesional')->references('id')->on('profesionales_datos_generales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_areas_medicas');
    }
};
