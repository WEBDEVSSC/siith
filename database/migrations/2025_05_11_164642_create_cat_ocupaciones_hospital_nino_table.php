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
        Schema::create('cat_ocupaciones_hospital_nino', function (Blueprint $table) {
            $table->id();
            $table->string('unidad');
            $table->string('area');
            $table->string('subarea');
            $table->string('ocupacion');
            $table->decimal('orden', 8, 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_ocupaciones_hospital_nino');
    }
};
