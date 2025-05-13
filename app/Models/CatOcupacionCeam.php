<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionCeam extends Model
{
    // Nombre de la tabla (opcional si sigue convención Laravel)
    protected $table = 'cat_ocupaciones_ceam';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'unidad',
        'area',
        'subarea_servicio',
        'componente',
        'ocupacion',
        'orden',
    ];
}
