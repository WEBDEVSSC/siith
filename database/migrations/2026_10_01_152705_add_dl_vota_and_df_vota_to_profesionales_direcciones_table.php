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
            $table->string('dl_vota')->nullable()->after('clave_elector');
            $table->string('df_vota')->nullable()->after('dl_vota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_direcciones', function (Blueprint $table) {
            $table->dropColumn(['dl_vota', 'df_vota']);
        });
    }
};
