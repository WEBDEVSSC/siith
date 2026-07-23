<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfesionalVigencia extends Model
{
    use SoftDeletes;
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
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    // Relación con ProfesionalDatosGenerales (uno a uno)
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional', 'id');
    }
}
