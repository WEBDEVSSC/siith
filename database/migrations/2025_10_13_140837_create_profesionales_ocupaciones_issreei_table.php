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
        Schema::create('profesionales_ocupaciones_issreei', function (Blueprint $table) {
            $table->id();

            // Llave foránea a profesionales_datos_generales
            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')->references('id')->on('profesionales_datos_generales')->onDelete('cascade');

            $table->integer('id_catalogo_uno')->nullable();
            $table->string('unidad_uno')->nullable();
            $table->string('area_uno')->nullable();
            $table->string('subarea_uno')->nullable();
            $table->string('ocupacion_uno')->nullable();
            $table->integer('mdl_status')->nullable(); // si quieres un valor por defecto

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_issreei');
    }
};
