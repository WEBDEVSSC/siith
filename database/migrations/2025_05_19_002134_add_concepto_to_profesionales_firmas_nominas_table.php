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
        Schema::table('profesionales_firmas_nominas', function (Blueprint $table) {
            //
            $table->string('concepto')->after('quincena_numero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_firmas_nominas', function (Blueprint $table) {
            //
            $table->dropColumn('concepto');
        });
    }
};
