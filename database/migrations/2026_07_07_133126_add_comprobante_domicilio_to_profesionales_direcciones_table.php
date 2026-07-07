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
            $table->string('comprobante_domicilio')->nullable()->after('ine');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_direcciones', function (Blueprint $table) {
            $table->dropColumn('comprobante_domicilio');
        });
    }
};
