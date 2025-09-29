<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalEmergencia extends Model
{
    // Indicar explícitamente el nombre de la tabla (si no sigue convención plural simple)
    protected $table = 'profesionales_emergencias';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_profesional',

        'telefono',
        'correo_electronico',

        'tipo_sangre',
        'tipo_alergia_id',
        'alergia_descripcion',
        'enfermedad',
        'medicamentos',

        'medico_nombre',
        'medico_telefono',

        'emergencia_nombre_uno',
        'emergencia_relacion_uno',
        'emergencia_telefono_uno_uno',
        'emergencia_telefono_dos_uno',
        'emergencia_email_uno',
        'emergencia_calle_uno',
        'emergencia_numero_uno',
        'emergencia_colonia_uno',
        'emergencia_codigo_postal_uno',
        'emergencia_municipio_id_uno',
        'emergencia_municipio_label_uno',

        'emergencia_nombre_dos',
        'emergencia_relacion_dos',
        'emergencia_telefono_uno_dos',
        'emergencia_telefono_dos_dos',
        'emergencia_email_dos',
        'emergencia_calle_dos',
        'emergencia_numero_dos',
        'emergencia_colonia_dos',
        'emergencia_codigo_postal_dos',
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
        'emergencia_codigo_postal_tres',
        'emergencia_municipio_id_tres',
        'emergencia_municipio_label_tres',
        'mdl_emergencia',
    ];

    // Relación con el profesional
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
