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
        Schema::create('profesionales_pases_de_salida', function (Blueprint $table) {
            $table->id();
            
            // Relación con profesionales_datos_generales
            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')
                  ->references('id')
                  ->on('profesionales_datos_generales')
                  ->onDelete('cascade');
            
            // Datos del profesional
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nomina');
            
            // Autorización
            $table->unsignedBigInteger('id_autoriza');
            $table->string('nombre_autoriza');
            
            // Detalles del pase
            $table->string('tipo');
            $table->date('fecha');
            $table->string('tiempo_autorizado');
            $table->time('hora_inicio');
            $table->time('hora_final');
            
            // Estado del pase
            $table->boolean('status')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_pases_de_salida');
    }
};
