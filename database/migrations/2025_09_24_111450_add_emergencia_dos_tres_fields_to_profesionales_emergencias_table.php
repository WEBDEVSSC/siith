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
            // Campos emergencia_dos
            $table->string('emergencia_nombre_dos')->nullable()->after('emergencia_municipio_label_uno');
            $table->string('emergencia_relacion_dos')->nullable()->after('emergencia_nombre_dos');
            $table->string('emergencia_telefono_uno_dos')->nullable()->after('emergencia_relacion_dos');
            $table->string('emergencia_telefono_dos_dos')->nullable()->after('emergencia_telefono_uno_dos');
            $table->string('emergencia_email_dos')->nullable()->after('emergencia_telefono_dos_dos');
            $table->string('emergencia_calle_dos')->nullable()->after('emergencia_email_dos');
            $table->string('emergencia_numero_dos')->nullable()->after('emergencia_calle_dos');
            $table->string('emergencia_colonia_dos')->nullable()->after('emergencia_numero_dos');
            $table->unsignedBigInteger('emergencia_municipio_id_dos')->nullable()->after('emergencia_colonia_dos');
            $table->string('emergencia_municipio_label_dos')->nullable()->after('emergencia_municipio_id_dos');

            // Campos emergencia_tres
            $table->string('emergencia_nombre_tres')->nullable()->after('emergencia_municipio_label_dos');
            $table->string('emergencia_relacion_tres')->nullable()->after('emergencia_nombre_tres');
            $table->string('emergencia_telefono_uno_tres')->nullable()->after('emergencia_relacion_tres');
            $table->string('emergencia_telefono_dos_tres')->nullable()->after('emergencia_telefono_uno_tres');
            $table->string('emergencia_email_tres')->nullable()->after('emergencia_telefono_dos_tres');
            $table->string('emergencia_calle_tres')->nullable()->after('emergencia_email_tres');
            $table->string('emergencia_numero_tres')->nullable()->after('emergencia_calle_tres');
            $table->string('emergencia_colonia_tres')->nullable()->after('emergencia_numero_tres');
            $table->unsignedBigInteger('emergencia_municipio_id_tres')->nullable()->after('emergencia_colonia_tres');
            $table->string('emergencia_municipio_label_tres')->nullable()->after('emergencia_municipio_id_tres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profesionales_emergencias', function (Blueprint $table) {
            //
            $table->dropColumn([
                'emergencia_nombre_dos',
                'emergencia_relacion_dos',
                'emergencia_telefono_uno_dos',
                'emergencia_telefono_dos_dos',
                'emergencia_email_dos',
                'emergencia_calle_dos',
                'emergencia_numero_dos',
                'emergencia_colonia_dos',
                'emergencia_municipio_id_dos',
                'emergencia_municipio_label_dos',
                'emergencia_nombre_tres',
                'emergencia_relacion_tres',
                'emergencia_telefono_uno_tres',
                'emergencia_telefono_dos_tres',
                'emergencia_email_tres',
                'emergencia_calle_tres',
                'emergencia_numero_tres',
                'emergencia_colonia_tres',
                'emergencia_municipio_id_tres',
                'emergencia_municipio_label_tres',
            ]);
        });
    }
};
