<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaseDeSalidaAutorizado extends Mailable
{
    use Queueable, SerializesModels;

    public $folio;
    public $nombreProfesional;

    public function __construct($folio, $nombreProfesional)
    {
        $this->folio = $folio;
        $this->nombreProfesional = $nombreProfesional;
    }

    public function build()
    {
        return $this->markdown('email.pase-de-salida-autorizado')
                    ->subject('Pase de Salida Autorizado')
                    ->from('soportewebssc@gmail.com', 'S.I.I.T.H. | S.S.C.'); 
    }
}
