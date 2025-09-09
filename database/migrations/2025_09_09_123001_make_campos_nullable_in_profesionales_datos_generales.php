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
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            //
            $table->string('padre_madre_familia')->nullable()->change();
            $table->unsignedBigInteger('capturado_id')->nullable()->change();
            $table->string('capturado_label')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            //
            $table->string('padre_madre_familia')->nullable()->change();
            $table->unsignedBigInteger('capturado_id')->nullable()->change();
            $table->string('capturado_label')->nullable()->change();
        });
    }
};
