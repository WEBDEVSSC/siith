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
        Schema::table('profesionales_cambios_nomina', function (Blueprint $table) {
            //
            $table->integer('id_nomina_pago')->after('id_profesional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_cambios_nomina', function (Blueprint $table) {
            //
            $table->dropColumn('id_nomina_pago');
        });
    }
};
