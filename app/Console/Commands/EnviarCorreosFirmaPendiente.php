<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProfesionalFirmaNomina;
use App\Mail\FirmaNominaPendienteMail;
use Illuminate\Support\Facades\Mail;

class EnviarCorreosFirmaPendiente extends Command
{
   protected $signature = 'correo:firma-nomina-pendiente';

    protected $description = 'Enviar correos diarios a profesionales con firma pendiente';

    public function handle()
    {
        $pendientes = ProfesionalFirmaNomina::where('status', 0)->with('profesional')->get();

        foreach ($pendientes as $registro) {
            $profesional = $registro->profesional;

            if ($profesional && $profesional->email) {
                Mail::to($profesional->email)->send(new FirmaNominaPendienteMail($profesional));
            }
        }

        $this->info('Correos enviados correctamente.');
    }
}
