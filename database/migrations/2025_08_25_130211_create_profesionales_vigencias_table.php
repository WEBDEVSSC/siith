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
        Schema::create('profesionales_vigencias', function (Blueprint $table) {
            $table->id();

            // Relación con profesionales_datos_generales
            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')
                  ->references('id')
                  ->on('profesionales_datos_generales')
                  ->onDelete('cascade');

            // Campos adicionales
            $table->string('vigencia');
            $table->string('vigencia_motivo');
            $table->date('fecha_inicio');
            $table->date('fecha_final')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_vigencias');
    }
};
