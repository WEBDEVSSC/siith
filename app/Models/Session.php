<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    protected $table = 'sessions'; // La tabla que maneja Laravel para sesiones

    // Laravel no tiene timestamps automáticos en la tabla sessions
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'
    ];

    // Relación con User (opcional)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
