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
        Schema::create('profesionales_horario', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')->references('id')->on('profesionales_datos_generales')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('jornada');
            $table->time('entrada_lunes')->nullable();
            $table->time('salida_lunes')->nullable();
            $table->time('entrada_martes')->nullable();
            $table->time('salida_martes')->nullable();
            $table->time('entrada_miercoles')->nullable();
            $table->time('salida_miercoles')->nullable();
            $table->time('entrada_jueves')->nullable();
            $table->time('salida_jueves')->nullable();
            $table->time('entrada_viernes')->nullable();
            $table->time('salida_viernes')->nullable();
            $table->time('entrada_sabado')->nullable();
            $table->time('salida_sabado')->nullable();
            $table->time('entrada_domingo')->nullable();
            $table->time('salida_domingo')->nullable();
            $table->time('entrada_festivo')->nullable();
            $table->time('salida_festivo')->nullable();
            
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_horario');
    }
};
