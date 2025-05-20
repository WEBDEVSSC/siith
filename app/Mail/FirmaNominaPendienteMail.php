<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FirmaNominaPendienteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $profesional;

    public function __construct($profesional)
    {
        $this->profesional = $profesional;
    }

    public function build()
    {
        return $this->markdown('email.firma-nomina-pendiente')
                    ->subject('⚠️ Firma de Nómina Pendiente')
                    ->from('soportewebssc@gmail.com', 'S.S. Coahuila'); 
    }
}
