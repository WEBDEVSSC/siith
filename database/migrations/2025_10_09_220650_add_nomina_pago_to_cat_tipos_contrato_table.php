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
        Schema::table('cat_tipos_contrato', function (Blueprint $table) {
            //
            $table->integer('nomina_pago')->after('tipo_contrato')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_tipos_contrato', function (Blueprint $table) {
            //
            $table->dropColumn('nomina_pago');
        });
    }
};
