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
        Schema::table('cat_codigos_puesto', function (Blueprint $table) {
            //
            $table->integer('personal_formacion')->default(0)->after('grupo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_codigos_puesto', function (Blueprint $table) {
            //
            $table->dropColumn('personal_formacion');
        });
    }
};
