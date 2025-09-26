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
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            //
            // Campos _tres después de reg_nac_prof_dos
            $table->string('cve_grado_tres')->nullable()->after('reg_nac_prof_dos');
            $table->string('grado_academico_tres')->nullable()->after('cve_grado_tres');
            $table->unsignedBigInteger('titulo_tres_id')->nullable()->after('grado_academico_tres');
            $table->string('titulo_tres')->nullable()->after('titulo_tres_id');
            $table->string('institucion_educativa_tres')->nullable()->after('titulo_tres');
            $table->unsignedBigInteger('institucion_educativa_tres_id')->nullable()->after('institucion_educativa_tres');
            $table->string('cedula_tres')->nullable()->after('institucion_educativa_tres_id');
            $table->string('numero_cedula_tres')->nullable()->after('cedula_tres');
            $table->string('reg_nac_prof_tres')->nullable()->after('numero_cedula_tres');

            // Campos _cuatro después de reg_nac_prof_tres
            $table->string('cve_grado_cuatro')->nullable()->after('reg_nac_prof_tres');
            $table->string('grado_academico_cuatro')->nullable()->after('cve_grado_cuatro');
            $table->unsignedBigInteger('titulo_cuatro_id')->nullable()->after('grado_academico_cuatro');
            $table->string('titulo_cuatro')->nullable()->after('titulo_cuatro_id');
            $table->string('institucion_educativa_cuatro')->nullable()->after('titulo_cuatro');
            $table->unsignedBigInteger('institucion_educativa_cuatro_id')->nullable()->after('institucion_educativa_cuatro');
            $table->string('cedula_cuatro')->nullable()->after('institucion_educativa_cuatro_id');
            $table->string('numero_cedula_cuatro')->nullable()->after('cedula_cuatro');
            $table->string('reg_nac_prof_cuatro')->nullable()->after('numero_cedula_cuatro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_grados_academicos', function (Blueprint $table) {
            //
            // Eliminamos los campos _tres
            $table->dropColumn([
                'cve_grado_tres',
                'grado_academico_tres',
                'titulo_tres_id',
                'titulo_tres',
                'institucion_educativa_tres',
                'institucion_educativa_tres_id',
                'cedula_tres',
                'numero_cedula_tres',
                'reg_nac_prof_tres',
            ]);

            // Eliminamos los campos _cuatro
            $table->dropColumn([
                'cve_grado_cuatro',
                'grado_academico_cuatro',
                'titulo_cuatro_id',
                'titulo_cuatro',
                'institucion_educativa_cuatro',
                'institucion_educativa_cuatro_id',
                'cedula_cuatro',
                'numero_cedula_cuatro',
                'reg_nac_prof_cuatro',
            ]);
        });
    }
};
