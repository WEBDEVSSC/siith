<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalHorario extends Model
{
    // Asignamos la tabla
    protected $table = 'profesionales_horarios';

    // Asignamos los campos de asignacion masiva
    protected $fillable = [
        'id_profesional',
        'id_jornada',
        'jornada',
        'entrada_lunes',
        'salida_lunes',
        'entrada_martes',
        'salida_martes',
        'entrada_miercoles',
        'salida_miercoles',
        'entrada_jueves',
        'salida_jueves',
        'entrada_viernes',
        'salida_viernes',
        'entrada_sabado',
        'salida_sabado',
        'entrada_domingo',
        'salida_domingo',
        'entrada_festivo',
        'salida_festivo',
        'mdl_horario',
    ];

    public function jornada()
    {
        return $this->belongsTo(Jornada::class, 'id_jornada', 'id');
    }

}
