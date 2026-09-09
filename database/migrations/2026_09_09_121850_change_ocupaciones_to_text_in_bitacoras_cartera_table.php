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
        Schema::table('profesionales_bitacoras_cartera', function (Blueprint $table) {
            //
            $table->text('ocupacion_anterior')->nullable()->change();
            $table->text('ocupacion_actual')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_bitacoras_cartera', function (Blueprint $table) {
            //
            $table->string('ocupacion_anterior', 191)->nullable()->change();
            $table->string('ocupacion_actual', 191)->nullable()->change();
        });
    }
};
