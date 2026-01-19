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
        Schema::create('profesionales_ocupaciones_cecosama', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->unsignedBigInteger('id_profesional');
            $table->unsignedBigInteger('id_catalogo');

            // Datos descriptivos
            $table->string('area')->nullable();
            $table->string('subarea')->nullable();
            $table->string('ocupacion')->nullable();

            // Estado
            $table->integer('mdl_status')->default(0);

            $table->timestamps();

            // Llaves foráneas
            $table->foreign('id_profesional')
                  ->references('id')
                  ->on('profesionales_datos_generales')
                  ->onDelete('cascade');

            $table->foreign('id_catalogo')
                  ->references('id')
                  ->on('cat_ocupaciones_cecosama')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_cecosama');
    }
};
