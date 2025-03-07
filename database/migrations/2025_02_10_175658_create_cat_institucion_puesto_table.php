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
        Schema::create('cat_institucion_puesto', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('abreviatura')->unique(); // Campo abreviatura único
            $table->string('nombre'); // Campo nombre
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_institucion_puesto');
    }
};
