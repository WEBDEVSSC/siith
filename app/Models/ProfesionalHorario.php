<?php

namespace App\Models;
use Carbon\Carbon;

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

    /* FORMATEAMOS LOS HORARIOS PARA HH:MM */

    public function getEntradaLunesFormattedAttribute()
    {
        return $this->entrada_lunes
            ? Carbon::createFromFormat('H:i:s', $this->entrada_lunes)->format('H:i')
            : null;
    }

    public function getEntradaMartesFormattedAttribute()
    {
        return $this->entrada_martes
            ? Carbon::createFromFormat('H:i:s', $this->entrada_martes)->format('H:i')
            : null;
    }

    public function getEntradaMiercolesFormattedAttribute()
    {
        return $this->entrada_miercoles
            ? Carbon::createFromFormat('H:i:s', $this->entrada_miercoles)->format('H:i')
            : null;
    }

    public function getEntradaJuevesFormattedAttribute()
    {
        return $this->entrada_jueves
            ? Carbon::createFromFormat('H:i:s', $this->entrada_jueves)->format('H:i')
            : null;
    }

    public function getEntradaViernesFormattedAttribute()
    {
        return $this->entrada_viernes
            ? Carbon::createFromFormat('H:i:s', $this->entrada_viernes)->format('H:i')
            : null;
    }

    public function getEntradaSabadoFormattedAttribute()
    {
        return $this->entrada_sabado
            ? Carbon::createFromFormat('H:i:s', $this->entrada_sabado)->format('H:i')
            : null;
    }

    public function getEntradaDomingoFormattedAttribute()
    {
        return $this->entrada_domingo
            ? Carbon::createFromFormat('H:i:s', $this->entrada_domingo)->format('H:i')
            : null;
    }

    public function getEntradaFestivoFormattedAttribute()
    {
        return $this->entrada_festivo
            ? Carbon::createFromFormat('H:i:s', $this->entrada_festivo)->format('H:i')
            : null;
    }

    /** SALIDAS */

    public function getSalidaLunesFormattedAttribute()
    {
        return $this->salida_lunes
            ? Carbon::createFromFormat('H:i:s', $this->salida_lunes)->format('H:i')
            : null;
    }

    public function getSalidaMartesFormattedAttribute()
    {
        return $this->salida_martes
            ? Carbon::createFromFormat('H:i:s', $this->salida_martes)->format('H:i')
            : null;
    }

    public function getSalidaMiercolesFormattedAttribute()
    {
        return $this->salida_miercoles
            ? Carbon::createFromFormat('H:i:s', $this->salida_miercoles)->format('H:i')
            : null;
    }

    public function getSalidaJuevesFormattedAttribute()
    {
        return $this->salida_jueves
            ? Carbon::createFromFormat('H:i:s', $this->salida_jueves)->format('H:i')
            : null;
    }

    public function getSalidaViernesFormattedAttribute()
    {
        return $this->salida_viernes
            ? Carbon::createFromFormat('H:i:s', $this->salida_viernes)->format('H:i')
            : null;
    }

    public function getSalidaSabadoFormattedAttribute()
    {
        return $this->salida_sabado
            ? Carbon::createFromFormat('H:i:s', $this->salida_sabado)->format('H:i')
            : null;
    }

    public function getSalidaDomingoFormattedAttribute()
    {
        return $this->salida_domingo
            ? Carbon::createFromFormat('H:i:s', $this->salida_domingo)->format('H:i')
            : null;
    }

    public function getSalidaFestivoFormattedAttribute()
    {
        return $this->salida_festivo
            ? Carbon::createFromFormat('H:i:s', $this->salida_festivo)->format('H:i')
            : null;
    }



}
