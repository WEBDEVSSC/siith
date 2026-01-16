<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradoAcademicoTitulo extends Model
{
    protected $table = 'cat_grados_academicos_titulos';

    protected $fillable = [
        'titulo',
        'relacion',
    ];

}
