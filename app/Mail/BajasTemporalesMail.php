<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BajasTemporalesMail extends Mailable
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
        return $this->subject('S.I.I.T.H. - Vencimiento Baja Temporal')
                    ->view('email.bajas-temporales');
    }
}
