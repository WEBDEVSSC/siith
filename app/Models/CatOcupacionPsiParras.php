<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionPsiParras extends Model
{
    //
    protected $table = 'cat_ocupaciones_psi_parras'; // Nombre real de la tabla en BD

    protected $fillable = [
        'unidad',
        'area',
        'subarea_servicio',
        'componente',
        'ocupacion',
        'orden',
    ];
}
