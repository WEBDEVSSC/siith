<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NominaPago extends Model
{
    // Si la tabla no sigue la convención de pluralizar el nombre del modelo
    protected $table = 'cat_nominas_pago';

    // Si no se quiere que Laravel gestione los campos created_at y updated_at
    public $timestamps = true;

    // Si deseas proteger campos de asignación masiva
    protected $fillable = ['nomina'];

    // Relaciones
    public function tiposContrato()
    {
        return $this->hasMany(TipoContrato::class, 'nomina_pago', 'id');
    }    
}
