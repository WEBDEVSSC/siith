<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodigoPuesto extends Model
{
    use SoftDeletes;
    //
    protected $table = 'cat_codigos_puesto';
    
    protected $fillable = [
        'codigo_puesto',
        'codigo',
        'grupo',
        'personal_formacion',
    ]; 
}
