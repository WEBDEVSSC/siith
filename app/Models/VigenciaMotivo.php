<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VigenciaMotivo extends Model
{
    protected $table = 'cat_vigencias_motivos';

    protected $fillable = ['id_vigencia', 'motivo'];

    public function vigencia()
    {
        return $this->belongsTo(Vigencia::class, 'id_vigencia');
    }
}
