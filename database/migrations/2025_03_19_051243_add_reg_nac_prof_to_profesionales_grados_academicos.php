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
            //
            $table->string('reg_nac_prof_uno')->nullable()->after('numero_cedula_uno');
            $table->string('reg_nac_prof_dos')->nullable()->after('numero_cedula_dos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            //
            $table->dropColumn(['reg_nac_prof_uno', 'reg_nac_prof_dos']);
        });
    }
};
