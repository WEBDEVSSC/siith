<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoPuesto extends Model
{
    //
    protected $table = 'cat_codigos_puesto';
    
    protected $fillable = [
        'codigo_puesto',
        'codigo',
        'grupo',
        'personal_formacion',
    ]; 
}
