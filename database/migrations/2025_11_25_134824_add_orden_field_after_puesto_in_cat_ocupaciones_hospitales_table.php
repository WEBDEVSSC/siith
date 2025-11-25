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
        Schema::table('cat_ocupaciones_hospitales', function (Blueprint $table) {
            //
            $table->decimal('orden', 10, 5)->after('puesto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_ocupaciones_hospitales', function (Blueprint $table) {
            //
            $table->dropColumn('orden');
        });
    }
};
