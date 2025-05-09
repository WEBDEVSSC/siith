<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProfesionalController;
use App\Mail\FelicitacionCumpleanos;
use App\Mail\FelicitacionesEnviadas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarFelicitacionesDiarias extends Command
{
    protected $signature = 'felicitaciones:enviar';
    protected $description = 'Envía correos de felicitación a los cumpleañeros del día';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new ProfesionalController();
        $profesionalesFelicitados = $controller->enviarFelicitaciones();

        // Enviar resumen solo si hay felicitados
        if (!empty($profesionalesFelicitados)) {
            Mail::to('soportewebssc@gmail.com')->send(new FelicitacionesEnviadas($profesionalesFelicitados));
        }

        $this->info('Correos de felicitación enviados exitosamente.');
    }
}