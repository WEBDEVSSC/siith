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
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
            $table->string('emergencia_codigo_postal_uno')->nullable()->change();
            $table->string('emergencia_codigo_postal_dos')->nullable()->change();
            $table->string('emergencia_codigo_postal_tres')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
            $table->string('emergencia_codigo_postal_uno')->nullable(false)->change();
            $table->string('emergencia_codigo_postal_dos')->nullable(false)->change();
            $table->string('emergencia_codigo_postal_tres')->nullable(false)->change();
        });
    }
};
