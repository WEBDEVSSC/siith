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
        Schema::create('profesionales_emergencias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_profesional');
            $table->string('tipo_sangre', 3)->nullable();
            $table->unsignedBigInteger('tipo_alergia_id')->nullable();
            $table->text('alergia_descripcion')->nullable();
            $table->text('enfermedad')->nullable();
            $table->text('medicamentos')->nullable();
            $table->string('medico_nombre')->nullable();
            $table->string('medico_telefono')->nullable();
            $table->string('emergencia_nombre')->nullable();
            $table->string('emergencia_relacion')->nullable();
            $table->string('emergencia_telefono_uno')->nullable();
            $table->string('emergencia_telefono_dos')->nullable();
            $table->string('emergencia_email')->nullable();
            $table->string('emergencia_calle')->nullable();
            $table->string('emergencia_numero')->nullable();
            $table->string('emergencia_colonia')->nullable();
            $table->unsignedBigInteger('emergencia_municipio_id')->nullable();
            $table->string('emergencia_municipio_label')->nullable();
            $table->decimal('mdl_emergencia', 8, 2)->default(0);

            $table->timestamps();

             // Llaves foráneas
            $table->foreign('id_profesional')
                ->references('id')->on('profesionales_datos_generales')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_emergencias');
    }
};
