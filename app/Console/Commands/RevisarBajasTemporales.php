<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProfesionalVigencia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BajasTemporalesMail;

class RevisarBajasTemporales extends Command
{
    protected $signature = 'profesionales:revisar-bajas';
    protected $description = 'Revisar profesionales cuya vigencia es BAJA TEMPORAL y fecha_final es hoy y enviar correo';

    public function handle()
    {
        $hoy = Carbon::today();

        // Obtener resultados
       $resultados = ProfesionalVigencia::with('profesional')
        ->whereDate('fecha_final', Carbon::today())
        ->where('vigencia', 'BAJA TEMPORAL')
        ->get();

        // Enviar correo
        Mail::to(['soportewebssc@gmail.com','ssclaucruz@hotmail.com'])->send(new BajasTemporalesMail($resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");
    }
}
