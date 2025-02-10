<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clue extends Model
{
    protected $table = 'cat_clues'; // Especifica la tabla en la base de datos

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
}
