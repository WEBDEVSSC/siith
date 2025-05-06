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
        Schema::table('profesionales_ocupaciones_psi_parras', function (Blueprint $table) {
            //
            Schema::rename('profesional_ocupaciones_psi_parras', 'profesionales_ocupaciones_psi_parras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_psi_parras', function (Blueprint $table) {
            //
            Schema::rename('profesionales_ocupaciones_psi_parras', 'profesional_ocupaciones_psi_parras');
        });
    }
};
