<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clue extends Model
{
    use SoftDeletes;

    protected $table = 'cat_clues'; 

    protected $fillable = [
        'clues',
        'municipio',
        'clave_municipio',
        'localidad',
        'clave_localidad',
        'jurisdiccion',
        'clave_jurisdiccion',
        'nombre',
        'clave_establecimiento',
        'tipologia',
    ]; 

    protected $dates = ['deleted_at'];
}
