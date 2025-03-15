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
            $table->string('cve_grado_uno')->nullable()->after('id_profesional');
            $table->string('cve_grado_dos')->nullable()->after('numero_cedula_uno');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            $table->dropColumn(['cve_grado_uno', 'cve_grado_dos']);
        });
    }
};
