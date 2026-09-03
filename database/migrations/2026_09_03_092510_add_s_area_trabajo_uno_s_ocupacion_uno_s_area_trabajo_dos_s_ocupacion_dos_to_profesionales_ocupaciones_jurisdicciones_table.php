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
        Schema::table('profesionales_ocupaciones_jurisdicciones', function (Blueprint $table) {
            $table->string('s_area_trabajo_uno')->nullable()->after('ocupacion_uno');
            $table->string('s_ocupacion_uno')->nullable()->after('s_area_trabajo_uno');

            $table->string('s_area_trabajo_dos')->nullable()->after('ocupacion_dos');
            $table->string('s_ocupacion_dos')->nullable()->after('s_area_trabajo_dos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_jurisdicciones', function (Blueprint $table) {
            $table->dropColumn([
                's_area_trabajo_uno',
                's_ocupacion_uno',
                's_area_trabajo_dos',
                's_ocupacion_dos',
            ]);
        });
    }
};
