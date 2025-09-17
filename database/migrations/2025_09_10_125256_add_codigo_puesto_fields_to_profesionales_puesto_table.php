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
            // Agrega codigo_puesto_id después de tipo_personal
            $table->integer('codigo_puesto_id')->after('tipo_personal');

            // Agrega codigo_puesto_label después de codigo_puesto
            $table->string('codigo_puesto_label')->after('codigo_puesto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_puesto', function (Blueprint $table) {
            //
            $table->dropColumn('codigo_puesto_id');
            $table->dropColumn('codigo_puesto_label');
        });
    }
};
