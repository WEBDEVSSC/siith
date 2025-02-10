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
        Schema::create('cat_clues', function (Blueprint $table) {
            $table->id();
            $table->string('clues');
            $table->string('municipio');
            $table->string('clave_municipio');
            $table->string('localidad');
            $table->string('clave_localidad');
            $table->string('jurisdiccion');
            $table->string('clave_jurisdiccion');
            $table->string('nombre');
            $table->string('clave_establecimiento');
            $table->string('tipologia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_clues');
    }
};
