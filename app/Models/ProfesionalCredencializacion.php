<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalCredencializacion extends Model
{
    protected $table = 'profesionales_credencializacion';

    protected $fillable = [
        'id_profesional',
        'fotografia',
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
