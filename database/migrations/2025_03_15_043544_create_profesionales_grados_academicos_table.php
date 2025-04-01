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
        Schema::create('profesionales_grados_academicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesional');
            $table->string('grado_academico_uno')->nullable();
            $table->string('titulo_uno')->nullable();
            $table->string('institucion_educativa_uno')->nullable();
            $table->string('cedula_uno')->nullable();
            $table->string('numero_cedula_uno')->nullable();
            $table->string('grado_academico_dos')->nullable();
            $table->string('titulo_dos')->nullable();
            $table->string('institucion_educativa_dos')->nullable();
            $table->string('cedula_dos')->nullable();
            $table->string('numero_cedula_dos')->nullable();
            $table->foreign('id_profesional')->references('id')->on('profesionales_datos_generales')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_grados_academicos');
    }
};
