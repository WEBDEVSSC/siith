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
            $table->string('emergencia_codigo_postal_uno')->after('emergencia_colonia_uno');
            $table->string('emergencia_codigo_postal_dos')->after('emergencia_colonia_dos');
            $table->string('emergencia_codigo_postal_tres')->after('emergencia_colonia_tres');
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
                'emergencia_codigo_postal_uno',
                'emergencia_codigo_postal_dos',
                'emergencia_codigo_postal_tres',
            ]);
        });
    }
};
