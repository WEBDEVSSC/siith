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
        'tipo_sangre',
        'tipo_alergia_id',
        'alergia_descripcion',
        'enfermedad',
        'medicamentos',
        'medico_nombre',
        'medico_telefono',
        'emergencia_nombre',
        'emergencia_relacion',
        'emergencia_telefono_uno',
        'emergencia_telefono_dos',
        'emergencia_email',
        'emergencia_calle',
        'emergencia_numero',
        'emergencia_colonia',
        'emergencia_municipio_id',
        'emergencia_municipio_label',
        'mdl_emergencia',
    ];

    // Relación con el profesional
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
