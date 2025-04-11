<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionSamuCrum extends Model
{
    //
    protected $table = 'cat_ocupaciones_samu_crum';

    protected $fillable = [
        'unidad',
        'area',
        'subarea',
        'componente',
        'ocupacion',
        'orden',
    ];
}
