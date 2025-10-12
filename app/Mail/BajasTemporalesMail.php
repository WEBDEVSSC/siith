<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BajasTemporalesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resultados;

    public function __construct($resultados)
    {
        $this->resultados = $resultados;
    }

    public function build()
    {
        return $this->subject('Trabajadores con vencimiento de Baja Temporal')
                    ->view('email.bajas-temporales');
    }
}
