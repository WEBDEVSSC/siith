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
        Schema::table('cat_ocupaciones_psi_parras', function (Blueprint $table) {
            //
            Schema::rename('cat_ocupacion_psi_parras', 'cat_ocupaciones_psi_parras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_ocupaciones_psi_parras', function (Blueprint $table) {
            //
            Schema::rename('cat_ocupaciones_psi_parras', 'cat_ocupacion_psi_parras');
        });
    }
};
