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
        //
        Schema::table('cat_ocupaciones_centros_salud', function (Blueprint $table) {
            $table->decimal('orden', 13, 8)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('cat_ocupaciones_centros_salud', function (Blueprint $table) {
            // Ajusta esto al tipo original (integer) por si necesitas hacer rollback
            $table->integer('orden')->change();
        });
    }
};
