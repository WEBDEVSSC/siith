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
        Schema::create('profesionales_datos_generales', function (Blueprint $table) {
            $table->id();
            $table->string('curp', 18)->unique(); // CURP, único y de longitud fija
            $table->string('rfc', 13)->unique(); // RFC, único y de longitud fija
            $table->string('homoclave', 3)->nullable(); // Homoclave, opcional
            $table->string('nombre'); // Nombre
            $table->string('apellido_paterno'); // Apellido paterno
            $table->string('apellido_materno'); // Apellido materno
            $table->enum('sexo', ['M', 'F']); // Sexo (M = Masculino, F = Femenino)
            $table->date('fecha_nacimiento'); // Fecha de nacimiento
            $table->string('entidad_nacimiento'); // Entidad de nacimiento
            $table->string('municipio_nacimiento'); // Municipio de nacimiento
            $table->string('pais_nacimiento'); // País de nacimiento
            $table->string('nacionalidad'); // Nacionalidad
            $table->string('estado_conyugal')->nullable(); // Estado conyugal
            $table->string('telefono_casa', 10)->nullable(); // Teléfono de casa
            $table->string('celular', 10)->nullable(); // Teléfono celular
            $table->string('email')->nullable(); // Correo electrónico
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales_datos_generales');
    }
};
