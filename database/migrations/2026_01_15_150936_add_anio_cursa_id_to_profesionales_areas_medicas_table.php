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
        Schema::table('profesionales_areas_medicas', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('anio_cursa_id')
                  ->nullable()
                  ->after('institucion_educativa_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_areas_medicas', function (Blueprint $table) {
            //
            $table->dropColumn('anio_cursa_id');
        });
    }
};
