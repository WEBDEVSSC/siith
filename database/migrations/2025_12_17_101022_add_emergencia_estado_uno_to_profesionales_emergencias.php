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
            $table->unsignedBigInteger('emergencia_estado_uno_id')->after('emergencia_codigo_postal_uno')->nullable();
            $table->string('emergencia_estado_uno_label')->after('emergencia_estado_uno_id')->nullable();

            $table->unsignedBigInteger('emergencia_estado_dos_id')->after('emergencia_codigo_postal_dos')->nullable();
            $table->string('emergencia_estado_dos_label')->after('emergencia_estado_dos_id')->nullable();

            $table->unsignedBigInteger('emergencia_estado_tres_id')->after('emergencia_codigo_postal_tres')->nullable();
            $table->string('emergencia_estado_tres_label')->after('emergencia_estado_tres_id')->nullable();
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
                'emergencia_estado_uno_id',
                'emergencia_estado_uno_label',
                'emergencia_estado_dos_id',
                'emergencia_estado_dos_label',
                'emergencia_estado_tres_id',
                'emergencia_estado_tres_label',
            ]);
        });
    }
};
