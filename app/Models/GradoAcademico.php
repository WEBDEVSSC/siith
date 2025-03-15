<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradoAcademico extends Model
{
    protected $table = 'cat_grados_academicos';

    protected $fillable = [
        'cve',
        'grado',
    ];
}
