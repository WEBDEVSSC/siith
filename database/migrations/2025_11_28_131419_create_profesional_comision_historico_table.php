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
        Schema::create('profesional_comision_historico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesional');
            $table->string('documento');
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
        Schema::dropIfExists('profesional_comision_historico');
    }
};
