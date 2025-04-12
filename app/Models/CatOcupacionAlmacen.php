<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionAlmacen extends Model
{
    //
    protected $table = 'cat_ocupaciones_almacen';

    protected $fillable = [
        'area',
        'subarea',
        'jefatura',
        'departamento',
        'ocupacion',
        'orden',
    ];
}
