<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatPaisNacimiento extends Model
{
    //
    protected $table = 'cat_paises_nacimiento';

    protected $fillable = [
        'pais',
    ];
}
