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
        Schema::rename('cat_colegiacion', 'cat_colegiaciones');
    }

    public function down(): void
    {
        Schema::rename('cat_colegiaciones', 'cat_colegiacion');
    }
};
