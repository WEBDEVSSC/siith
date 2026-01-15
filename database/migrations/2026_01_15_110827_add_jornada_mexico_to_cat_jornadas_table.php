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
        Schema::table('cat_jornadas', function (Blueprint $table) {
            //
            $table->text('jornada_mexico')->nullable()->after('jornada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_jornadas', function (Blueprint $table) {
            //
            $table->dropColumn('jornada_mexico');
        });
    }
};
