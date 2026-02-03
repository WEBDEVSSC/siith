<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatCodigoPostal extends Model
{
    //
    protected $table = 'cat_codigos_postales';

    protected $fillable = [
        'codigo_postal',
        'colonia',
        'municipio',
        'ciudad'
    ];
}
