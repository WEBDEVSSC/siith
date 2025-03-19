<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles'; // Nombre de la tabla en la base de datos

    protected $fillable = ['rol', 'label_rol']; // Campos que se pueden asignar en masa
}
