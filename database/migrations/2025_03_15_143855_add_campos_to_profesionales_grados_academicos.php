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
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            $table->unsignedBigInteger('titulo_uno_id')->nullable()->after('grado_academico_uno');
            $table->unsignedBigInteger('institucion_educativa_uno_id')->nullable()->after('institucion_educativa_uno');
            $table->unsignedBigInteger('titulo_dos_id')->nullable()->after('grado_academico_dos');
            $table->unsignedBigInteger('institucion_educativa_dos_id')->nullable()->after('institucion_educativa_dos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            $table->dropColumn([
                'titulo_uno_id', 
                'institucion_educativa_uno_id', 
                'titulo_dos_id', 
                'institucion_educativa_dos_id'
            ]);
        });
    }
};
