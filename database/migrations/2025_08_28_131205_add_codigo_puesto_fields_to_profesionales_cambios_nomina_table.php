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
            $table->unsignedBigInteger('codigo_puesto_id')->after('seguro_salud');
            $table->string('codigo_puesto_label')->after('codigo_puesto_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_cambios_nomina', function (Blueprint $table) {
            //
            $table->dropColumn(['codigo_puesto_id', 'codigo_puesto_label']);
        });
    }
};
