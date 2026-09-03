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
        Schema::table('cat_ocupaciones_cri_cree', function (Blueprint $table) {
            $table->string('s_area_trabajo')->nullable()->after('ocupacion');
            $table->string('s_ocupacion')->nullable()->after('s_area_trabajo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_ocupaciones_cri_cree', function (Blueprint $table) {
            $table->dropColumn([
                's_area_trabajo',
                's_ocupacion',
            ]);
        });
    }
};
