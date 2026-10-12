<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfesionalExtraer extends Model
{
    //
    protected $table = 'profesionales_extraer';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'archivo',
        'tipo',
        'curp',
        'seccion',
        'vigencia',
    ];

    public function profesional()
    {
        // Compara los primeros 18 caracteres de 'archivo' (en profesional_extraers) con 'curp' (en profesionales_datos_generales)
            return $this->belongsTo(Profesional::class, 'curp', 'curp') // Nota: el segundo parámetro es auxiliar, la magia ocurre abajo
                        ->whereColumn(
                            DB::raw('SUBSTRING(profesional_extraers.archivo, 1, 18)'), 
                            '=', 
                            'profesionales_datos_generales.curp'
                        );
    }

    public function getNombreCompletoAttribute()
{
    if (!$this->nombre) {
        return '';
    }
    
    return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
}
}
