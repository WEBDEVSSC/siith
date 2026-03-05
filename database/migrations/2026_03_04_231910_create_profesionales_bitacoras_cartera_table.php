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
        Schema::create('profesionales_bitacoras_cartera', function (Blueprint $table) {
             $table->id();

            // Profesional relacionado
            $table->unsignedBigInteger('id_profesional');

            // Datos de la bitácora
            $table->string('ocupacion_anterior')->nullable();

            // Datos del capturista
            $table->unsignedBigInteger('id_capturista');
            $table->string('capturista_label');

            $table->timestamps();

            // Llave foránea
            $table->foreign('id_profesional')
                ->references('id')
                ->on('profesionales_datos_generales')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_bitacoras_cartera');
    }
};
