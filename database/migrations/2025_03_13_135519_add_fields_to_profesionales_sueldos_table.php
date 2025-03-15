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
        Schema::table('profesionales_sueldos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_profesional')->after('id');
            $table->foreign('id_profesional')->references('id')->on('profesionales')->onDelete('cascade');
            $table->integer('mdl_sueldo')->after('id_profesional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_sueldos', function (Blueprint $table) {
            $table->dropForeign(['id_profesional']);
            $table->dropColumn(['id_profesional', 'mdl_sueldo']);
        });
    }
};
