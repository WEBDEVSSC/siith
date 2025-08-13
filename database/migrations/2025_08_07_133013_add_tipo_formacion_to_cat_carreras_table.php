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
        Schema::table('cat_carreras', function (Blueprint $table) {
            //
            $table->integer('tipo_formacion')->after('carrera');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_carreras', function (Blueprint $table) {
            //
            $table->dropColumn('tipo_formacion');
        });
    }
};
