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
            $table->string('ciudad')->nullable()->after('estado');
            $table->string('tipo_asentamiento')->nullable()->after('ciudad');
            $table->string('zona')->nullable()->after('tipo_asentamiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_direcciones', function (Blueprint $table) {
            //
            $table->dropColumn([
                'ciudad',
                'tipo_asentamiento',
                'zona',
            ]);
        });
    }
};
