<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VigenciaMotivo extends Model
{
    use SoftDeletes;
    
    protected $table = 'cat_vigencias_motivos';

    protected $fillable = [
        'id_vigencia', 
        'label_vigencia',
        'motivo'
    ];

    public function vigencia()
    {
        return $this->belongsTo(Vigencia::class, 'id_vigencia');
    }
}
