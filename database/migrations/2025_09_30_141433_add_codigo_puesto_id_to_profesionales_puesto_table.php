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
            //
            $table->unsignedBigInteger('codigo_puesto_id')->nullable()->after('tipo_personal');
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
        });
    }
};
