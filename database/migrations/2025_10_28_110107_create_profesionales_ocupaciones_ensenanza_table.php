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
        Schema::create('profesionales_ocupaciones_ensenanza', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla profesionales_datos_generales
            $table->foreignId('id_profesional')
                ->constrained('profesionales_datos_generales')
                ->onDelete('cascade');

            $table->integer('id_catalogo')->nullable();
            $table->string('unidad')->nullable();
            $table->string('area')->nullable();
            $table->string('subarea')->nullable();
            $table->string('ocupacion')->nullable();
            $table->integer('mdl_status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_ensenanza');
    }
};
