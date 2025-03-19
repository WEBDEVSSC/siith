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
            $table->integer('mdl_area_medica')->after('duracion_formacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_areas_medicas', function (Blueprint $table) {
            //
            $table->dropColumn('mdl_area_medica');
        });
    }
};
