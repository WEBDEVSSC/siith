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
        Schema::create('profesionales_bitacoras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_capturista')->references('id')->on('users')->onDelete('cascade');
            $table->string('capturista_label');
            $table->string('accion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_bitacoras');
    }
};
