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
        Schema::table('cat_vigencias_motivos', function (Blueprint $table) {
            $table->string('label_vigencia')->after('id_vigencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_vigencias_motivos', function (Blueprint $table) {
            $table->dropColumn('label_vigencia');
        });
    }
};
