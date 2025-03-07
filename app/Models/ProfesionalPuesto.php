<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalPuesto extends Model
{
    // Seleccionamos la tabla
    protected $table = 'profesionales_puesto';

    protected $fillable = [
        'fiel', 
        'fiel_vigencia', 
        'actividad', 
        'adicional',
        'tipo_personal', 
        'codigo_puesto',
        'clues_nomina', 
        'clues_nomina_nombre', 
        'clues_nomina_municipio', 
        'clues_nomina_jurisdiccion',
        'clues_adscripcion', 
        'clues_adscripcion_nombre', 
        'clues_adscripcion_municipio', 
        'clues_adscripcion_jurisdiccion',
        'area_trabajo', 
        'ocupacion', 
        'nomina_pago', 
        'tipo_contrato', 
        'fecha_ingreso',
        'tipo_plaza', 
        'institucion_puesto', 
        'vigencia', 
        'vigencia_motivo', 
        'temporalidad',
        'licencia_maternidad', 
        'seguro_salud'
    ];

    // Relación con la tabla profesionales_datos_generales
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
