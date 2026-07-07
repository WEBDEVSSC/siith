<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalesDireccion extends Model
{
    //
    protected $table = 'profesionales_direcciones';

    protected $fillable = [
        'id_profesional',
        'calle',
        'numero_exterior',
        'numero_interior',
        'id_codigo_postal',
        'codigo_postal',
        'colonia',
        'municipio',
        'estado',
        'ciudad',
        'tipo_asentamiento',
        'zona',
        'seccion',
        'vigencia',
        'clave_elector',
        'ine',
        'comprobante_domicilio',
        'mdl_direccion'
    ];

    /**
     * Relación con ProfesionalDatosGenerales
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
