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
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('emergencia_relacion_uno_id')->nullable()->after('emergencia_nombre_uno');
            $table->unsignedBigInteger('emergencia_relacion_dos_id')->nullable()->after('emergencia_nombre_dos');
            $table->unsignedBigInteger('emergencia_relacion_tres_id')->nullable()->after('emergencia_nombre_tres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
             $table->dropColumn([
            'emergencia_relacion_uno_id',
            'emergencia_relacion_dos_id',
            'emergencia_relacion_tres_id',
        ]);
        });
    }
};
