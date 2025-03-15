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
            $table->integer('mdl_sueldo')->after('total')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_sueldos', function (Blueprint $table) {
            $table->integer('mdl_sueldo')->after('id_profesional')->change();
        });
    }
};
