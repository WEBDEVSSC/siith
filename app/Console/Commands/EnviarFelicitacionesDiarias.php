<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProfesionalController;
use Illuminate\Console\Command;

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
        $controller->enviarFelicitaciones();

        $this->info('Correos de felicitación enviados exitosamente.');
    }
}