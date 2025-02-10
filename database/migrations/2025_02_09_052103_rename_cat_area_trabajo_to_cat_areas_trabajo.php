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
        Schema::rename('cat_area_trabajo', 'cat_areas_trabajo');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('cat_areas_trabajo', 'cat_area_trabajo');
    }
};
