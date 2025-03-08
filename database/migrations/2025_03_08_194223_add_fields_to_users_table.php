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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_unidad')->nullable()->after('password');
            $table->string('clues_unidad')->nullable()->after('id_unidad');
            $table->string('nombre_unidad')->nullable()->after('clues_unidad');
            $table->string('role')->default('user')->after('nombre_unidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id_unidad', 'clues_unidad', 'nombre_unidad', 'role']);
        });
    }
};
