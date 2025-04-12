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
        Schema::create('profesionales_ocupaciones_almacen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesional');
        
            $table->integer('id_catalogo_uno');
            $table->string('area_uno');
            $table->string('subarea_uno');
            $table->string('jefatura_uno');
            $table->string('departamento_uno');
            $table->string('ocupacion_uno');

            $table->integer('id_catalogo_dos')->nullable();
            $table->string('area_dos')->nullable();
            $table->string('subarea_dos')->nullable();
            $table->string('jefatura_dos')->nullable();
            $table->string('departamento_dos')->nullable();
            $table->string('ocupacion_dos')->nullable();

            $table->integer('mdl_status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_ocupaciones_almacen');
    }
};
