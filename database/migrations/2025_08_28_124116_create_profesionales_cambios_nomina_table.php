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
        Schema::create('profesionales_cambios_nomina', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_profesional'); // Relación con profesionales_datos_generales
            $table->string('nomina_pago')->nullable();
            $table->string('tipo_contrato')->nullable();
            $table->string('tipo_plaza')->nullable();
            $table->string('seguro_salud')->nullable();
            $table->string('codigo_puesto')->nullable();

            // Clave foránea
            $table->foreign('id_profesional')
                  ->references('id')
                  ->on('profesionales_datos_generales')
                  ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_cambios_nomina');
    }
};
