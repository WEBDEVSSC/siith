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
            $table->dropUnique('cat_tipos_contrato_tipo_contrato_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_tipos_contrato', function (Blueprint $table) {
            //
            $table->unique('tipo_contrato', 'cat_tipos_contrato_tipo_contrato_unique');
        });
    }
};
