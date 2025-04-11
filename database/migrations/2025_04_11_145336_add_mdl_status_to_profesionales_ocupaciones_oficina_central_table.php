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
        Schema::table('profesionales_ocupaciones_oficina_central', function (Blueprint $table) {
            //
            $table->integer('mdl_status')->default(0)->after('ocupacion_dos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_ocupaciones_oficina_central', function (Blueprint $table) {
            //
            $table->dropColumn('mdl_status');
        });
    }
};
