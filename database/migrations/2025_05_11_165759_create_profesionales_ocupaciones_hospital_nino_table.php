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
        Schema::create('profesionales_ocupaciones_hospital_nino', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_profesional');
            
            $table->integer('id_catalogo_uno');
            $table->string('unidad_uno');
            $table->string('area_uno');
            $table->string('subarea_uno');
            $table->string('ocupacion_uno');

            $table->integer('id_catalogo_dos');
            $table->string('unidad_dos');
            $table->string('area_dos');
            $table->string('subarea_dos');
            $table->string('ocupacion_dos');

            $table->unsignedTinyInteger('mdl_status')->default(0);

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
        Schema::dropIfExists('profesionales_ocupaciones_hospital_nino');
    }
};
