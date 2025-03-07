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
        Schema::create('cat_vigencias_motivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vigencia');
            $table->string('motivo');
            $table->timestamps();

            $table->foreign('id_vigencia')->references('id')->on('cat_vigencias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_vigencias_motivos');
    }
};
