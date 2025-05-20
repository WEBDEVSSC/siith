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
        Schema::create('profesionales_firmas_nominas', function (Blueprint $table) {
            $table->id();

            $table->string('curp');
            $table->foreign('curp')->references('curp')->on('profesionales_datos_generales')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2);
            $table->integer('quincena_numero');
            $table->year('anio');
            $table->string('firma')->nullable(); // ruta de la imagen
            $table->integer('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_firmas_nominas');
    }
};
