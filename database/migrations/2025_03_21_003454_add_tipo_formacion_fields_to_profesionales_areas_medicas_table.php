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
            $table->after('tipo_formacion', function ($table) {
                $table->integer('tipo_formacion_id')->nullable();
                $table->string('tipo_formacion_label')->nullable();
            });
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_areas_medicas', function (Blueprint $table) {
            //
            $table->dropColumn(['tipo_formacion_id', 'tipo_formacion_label']);
        });
    }
};
