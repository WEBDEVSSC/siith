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
        Schema::table('profesionales_direcciones', function (Blueprint $table) {
            //
            $table->unsignedInteger('seccion')->nullable()->after('zona');
            $table->year('vigencia')->nullable()->after('seccion');
            $table->string('clave_elector')->nullable()->after('vigencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_direcciones', function (Blueprint $table) {
            //
            $table->dropColumn(['seccion','vigencia','clave_elector']);
        });
    }
};
