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
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            $table->integer('mdl_grado_academico')->after('numero_cedula_dos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            $table->dropColumn('mdl_grado_academico');
        });
    }
};
