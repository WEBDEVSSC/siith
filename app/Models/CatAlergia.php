<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatAlergia extends Model
{
    //
    protected $table = 'cat_alergias';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'tipo_alergia',
    ];
}
