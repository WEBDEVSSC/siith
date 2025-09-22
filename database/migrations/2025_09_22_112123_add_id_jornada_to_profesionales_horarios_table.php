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
        Schema::table('profesionales_horarios', function (Blueprint $table) {
            //
            $table->integer('id_jornada')->after('id_profesional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_horarios', function (Blueprint $table) {
            //
            $table->dropColumn('id_jornada');
        });
    }
};
