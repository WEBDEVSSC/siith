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
            $table->integer('mdl_emergencia')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
             $table->string('mdl_emergencia')->default(null)->change();
        });
    }
};
