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
            $table->renameColumn('emergencia_nombre', 'emergencia_nombre_uno');
            $table->renameColumn('emergencia_relacion', 'emergencia_relacion_uno');
            $table->renameColumn('emergencia_telefono_uno', 'emergencia_telefono_uno_uno');
            $table->renameColumn('emergencia_telefono_dos', 'emergencia_telefono_dos_uno');
            $table->renameColumn('emergencia_email', 'emergencia_email_uno');
            $table->renameColumn('emergencia_calle', 'emergencia_calle_uno');
            $table->renameColumn('emergencia_numero', 'emergencia_numero_uno');
            $table->renameColumn('emergencia_colonia', 'emergencia_colonia_uno');
            $table->renameColumn('emergencia_municipio_id', 'emergencia_municipio_id_uno');
            $table->renameColumn('emergencia_municipio_label', 'emergencia_municipio_label_uno');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
            $table->renameColumn('emergencia_nombre_uno', 'emergencia_nombre');
            $table->renameColumn('emergencia_relacion_uno', 'emergencia_relacion');
            $table->renameColumn('emergencia_telefono_uno_uno', 'emergencia_telefono_uno');
            $table->renameColumn('emergencia_telefono_dos_uno', 'emergencia_telefono_dos');
            $table->renameColumn('emergencia_email_uno', 'emergencia_email');
            $table->renameColumn('emergencia_calle_uno', 'emergencia_calle');
            $table->renameColumn('emergencia_numero_uno', 'emergencia_numero');
            $table->renameColumn('emergencia_colonia_uno', 'emergencia_colonia');
            $table->renameColumn('emergencia_municipio_id_uno', 'emergencia_municipio_id');
            $table->renameColumn('emergencia_municipio_label_uno', 'emergencia_municipio_label');
        });
    }
};
