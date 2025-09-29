<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalBitacora extends Model
{
    //
    protected $table = 'profesionales_bitacoras';

    protected $fillable = [
        'id_capturista',
        'capturista_label',
        'accion',
        'id_profesional'
    ];
}
