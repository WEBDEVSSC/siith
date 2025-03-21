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
        Schema::table('profesionales_certificaciones', function (Blueprint $table) {
            $table->string('colegiacion_id')->nullable()->change();
            $table->string('colegiacion_label')->nullable()->change();
            $table->string('certificacion_id')->nullable()->change();
            $table->string('certificacion_label')->nullable()->change();
            $table->string('idioma_id')->nullable()->change();
            $table->string('idioma_label')->nullable()->change();
            $table->string('idioma_nivel_de_dominio')->nullable()->change();
            $table->string('lengua_indigena_id')->nullable()->change();
            $table->string('lengua_indigena_label')->nullable()->change();
            $table->string('lengua_nivel_de_dominio')->nullable()->change();
            $table->string('mdl_certificacion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('profesionales_certificaciones', function (Blueprint $table) {
            $table->string('colegiacion_id')->nullable(false)->change();
            $table->string('colegiacion_label')->nullable(false)->change();
            $table->string('certificacion_id')->nullable(false)->change();
            $table->string('certificacion_label')->nullable(false)->change();
            $table->string('idioma_id')->nullable(false)->change();
            $table->string('idioma_label')->nullable(false)->change();
            $table->string('idioma_nivel_de_dominio')->nullable(false)->change();
            $table->string('lengua_indigena_id')->nullable(false)->change();
            $table->string('lengua_indigena_label')->nullable(false)->change();
            $table->string('lengua_nivel_de_dominio')->nullable(false)->change();
            $table->string('mdl_certificacion')->nullable(false)->change();
        });
    }
};
