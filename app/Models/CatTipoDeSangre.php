<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatTipoDeSangre extends Model
{

    // Nombre de la tabla (por si no sigue la convención de Laravel)
    protected $table = 'cat_tipos_sangre';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'tipo_sangre',
    ];
}
