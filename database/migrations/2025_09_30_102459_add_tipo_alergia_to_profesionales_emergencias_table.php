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
            $table->string('tipo_alergia')->nullable()->after('tipo_alergia_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
            $table->dropColumn('tipo_alergia');
        });
    }
};
