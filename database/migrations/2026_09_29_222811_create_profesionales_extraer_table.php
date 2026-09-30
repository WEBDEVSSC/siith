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
        Schema::create('profesionales_extraer', function (Blueprint $table) {
            $table->id();
            $table->text('archivo')->nullable();
            $table->text('tipo')->nullable();
            $table->text('curp')->nullable();
            $table->text('seccion')->nullable();
            $table->text('vigencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_extraer');
    }
};
