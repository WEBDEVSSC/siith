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
        Schema::create('cat_tipos_contrato', function (Blueprint $table) {
            $table->id(); // Campo id autoincremental
            $table->string('tipo_contrato')->unique(); // Campo tipo_contrato con valores únicos
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_tipos_contrato');
    }
};
