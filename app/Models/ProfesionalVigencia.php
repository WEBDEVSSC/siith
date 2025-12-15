<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalVigencia extends Model
{
    //
    protected $table = 'profesionales_vigencias';

    protected $fillable = [
        'id_profesional',
        'vigencia',
        'vigencia_motivo',
        'fecha_inicio',
        'fecha_final',
    ];

    // Si quieres que las fechas sean automáticamente tratadas como Carbon
    protected $dates = [
        'fecha_inicio',
        'fecha_final',
        'created_at',
        'updated_at',
    ];

    // Relación con ProfesionalDatosGenerales (uno a uno)
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional', 'id');
    }

    // Relación con ProfesionalDatosGenerales (uno a uno)
    /*public function credencializacion()
    {
        return $this->belongsTo(ProfesionalCredencializacion::class, 'id_profesional', 'id_profesional');
    }*/
}
