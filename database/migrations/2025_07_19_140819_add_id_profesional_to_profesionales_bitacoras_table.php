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
        Schema::table('profesionales_bitacoras', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_profesional')
            
            ->references('id')->on('profesionales_datos_generales')->onDelete('cascade')
            ->after('accion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_bitacoras', function (Blueprint $table) {
            //
            $table->dropColumn('id_profesional');
        });
    }
};
