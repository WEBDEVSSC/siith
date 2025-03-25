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
        Schema::create('cat_ocupaciones_centros_salud', function (Blueprint $table) {
            $table->id();
            $table->string('unidad')->nullable();
            $table->string('area')->nullable();
            $table->string('subarea')->nullable();
            $table->string('ocupacion')->nullable();
            $table->integer('orden')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_ocupaciones_centros_salud');
    }
};
