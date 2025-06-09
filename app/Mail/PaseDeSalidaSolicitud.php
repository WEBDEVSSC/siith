<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaseDeSalidaSolicitud extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreCompleto,$nombreCompletoAutoriza;

    public function __construct($nombreCompleto,$nombreCompletoAutoriza)
    {
        $this->nombreCompleto = $nombreCompleto;
        $this->nombreCompletoAutoriza = $nombreCompletoAutoriza;
    }

    public function build()
    {
        return $this->markdown('email.pase-de-salida-solicitud')
                    ->subject('Solicitud de Pase de Salida')
                    ->from('soportewebssc@gmail.com', 'S.I.I.T.H. | S.S.C.'); 
    }
}
