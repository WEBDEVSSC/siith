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
        Schema::table('profesionales_puesto', function (Blueprint $table) {
            //
            $table->integer('codigo_puesto_id')->nullable()->change();
            $table->string('codigo_puesto_label')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_puesto', function (Blueprint $table) {
            //
            $table->integer('codigo_puesto_id')->nullable(false)->change();
            $table->string('codigo_puesto_label')->nullable(false)->change();
        });
    }
};
