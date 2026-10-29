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
            $table->dropColumn([
                'seccion',
                'vigencia',
                'clave_elector',
                'dl_vota',
                'df_vota',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_direcciones', function (Blueprint $table) {
            $table->string('clave_elector')->nullable();
            $table->string('seccion')->nullable();
            $table->string('vigencia')->nullable();
            $table->string('dl_vota')->nullable();
            $table->string('df_vota')->nullable();
        });
    }
};
