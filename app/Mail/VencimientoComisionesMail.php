<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VencimientoComisionesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resultados;
    public $titulo;

    public function __construct($titulo, $resultados)
    {
        $this->resultados = $resultados;
        $this->titulo = $titulo;
    }

    public function build()
    {
        return $this->subject('S.I.I.T.H. - Vencimiento Comisiones')
                    ->view('email.vencimiento-comisiones');
    }
}
