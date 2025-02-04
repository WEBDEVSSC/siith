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
        Schema::create('cat_municipios', function (Blueprint $table) {
            $table->id(); // ID auto-incremental
            $table->string('nombre'); // Campo para el nombre del municipio
            $table->integer('relacion'); // Campo para la relación (entero)
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_municipios');
    }
};
