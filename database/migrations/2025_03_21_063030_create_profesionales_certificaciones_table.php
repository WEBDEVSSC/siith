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
        Schema::create('profesionales_certificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesional');
            $table->integer('colegiacion_id');
            $table->string('colegiacion_label');
            $table->integer('certificacion_id');
            $table->string('certificacion_label');
            $table->integer('idioma_id');
            $table->string('idioma_label');
            $table->string('idioma_nivel_de_dominio');
            $table->integer('lengua_indigena_id');
            $table->string('lengua_indigena_label');
            $table->string('lengua_nivel_de_dominio');
            $table->integer('mdl_certificacion');
            $table->foreign('id_profesional')->references('id')->on('profesionales_datos_generales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_certificaciones');
    }
};
