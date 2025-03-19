<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposFormacionMedica extends Model
{
    //
    protected $table = 'cat_tipos_formacion_medica';

    protected $fillable = [
        'cve',
        'tipo',
    ];
}
