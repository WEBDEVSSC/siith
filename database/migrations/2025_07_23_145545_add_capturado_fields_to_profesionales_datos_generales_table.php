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
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('capturado_id')->nullable()->after('padre_madre_familia');
            $table->string('capturado_label')->nullable()->after('capturado_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_datos_generales', function (Blueprint $table) {
            //
            $table->dropColumn(['capturado_id', 'capturado_label']);
        });
    }
};
