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
            $table->string('observaciones_uno')->nullable()->after('reg_nac_prof_uno');
            $table->string('observaciones_dos')->nullable()->after('reg_nac_prof_dos');
            $table->string('observaciones_tres')->nullable()->after('reg_nac_prof_tres');
            $table->string('observaciones_cuatro')->nullable()->after('reg_nac_prof_cuatro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            //
            $table->dropColumn([
                'observaciones_uno',
                'observaciones_dos',
                'observaciones_tres',
                'observaciones_cuatro',
            ]);
        });
    }
};
