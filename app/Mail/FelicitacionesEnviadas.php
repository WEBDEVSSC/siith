<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FelicitacionesEnviadas extends Mailable
{
    use Queueable, SerializesModels;

    public $profesionales;
    public $fecha;

    public function __construct($profesionales)
    {
        $this->profesionales = $profesionales;
        $this->fecha = \Carbon\Carbon::now()->format('Y-m-d');
    }

    /*public function build()
    {
        return $this->subject('Notificación de Envío de Correos de Felicitación')
                    ->view('email.felicitaciones-enviadas');
    }*/

    public function build()
    {
        return $this->subject('Resumen de felicitaciones enviadas')
                    ->view('email.felicitaciones-enviadas')
                    ->with([
                        'profesionales' => $this->profesionales,
                        'fecha' => $this->fecha,
                    ]);
    }
}
