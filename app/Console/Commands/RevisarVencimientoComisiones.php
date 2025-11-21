<?php

namespace App\Console\Commands;

use App\Mail\VencimientoComisionesMail;
use App\Models\ProfesionalCambioDeUnidad;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RevisarVencimientoComisiones extends Command
{
    protected $signature = 'profesionales:revisar-comisiones';
    protected $description = 'Revisar profesionales cuya comision se venza el dia siguiente';

    public function handle()
    {
        $hoy = Carbon::today();

        /**
         * 
         * 
         * OFICINA CENTRAL NORMATIVIDAD
         * 
         * 
         */

        $titulo = "NORMATIVIDAD JEFATURA ESTATAL";
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->get();

        // Enviar correo
        Mail::to(['soportewebssc@gmail.com','normatividad.siith@saludcoahuila.gob.mx','rhcoordmejoracontinua@gmail.com'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

        /**
         * 
         * 
         * JURISDICCION 1
         * 
         * 
         */

        $titulo = "J1";
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion', '1');})
            ->get();

        // Enviar correo
        Mail::to(['j1.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

        /**
         * 
         * 
         * JURISDICCION 2
         * 
         * 
         */

        //Titulo
        $titulo = "J2";
        
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion','2');})
            ->get();

        // Enviar correo
        Mail::to(['j2.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

         /**
         * 
         * 
         * JURISDICCION 3
         * 
         * 
         */

        //Titulo
        $titulo = "J3";
        
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion','3');})
            ->get();

        // Enviar correo
        Mail::to(['j3.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

         /**
         * 
         * 
         * JURISDICCION 4
         * 
         * 
         */

        //Titulo
        $titulo = "J4";
        
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion','4');})
            ->get();

        // Enviar correo
        Mail::to(['j4.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

         /**
         * 
         * 
         * JURISDICCION 5
         * 
         * 
         */

        //Titulo
        $titulo = "J5";
        
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion','5');})
            ->get();

        // Enviar correo
        Mail::to(['j5.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

         /**
         * 
         * 
         * JURISDICCION 6
         * 
         * 
         */

        //Titulo
        $titulo = "J6";
        
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion','6');})
            ->get();

        // Enviar correo
        Mail::to(['j6.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

         /**
         * 
         * 
         * JURISDICCION 7
         * 
         * 
         */

        //Titulo
        $titulo = "J7";
        
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion','7');})
            ->get();

        // Enviar correo
        Mail::to(['j7.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");

         /**
         * 
         * 
         * JURISDICCION 8
         * 
         * 
         */

        //Titulo
        $titulo = "J8";
        
        // Obtener resultados
        $resultados = ProfesionalCambioDeUnidad::with('profesional')
            ->whereDate('fecha_final', Carbon::tomorrow())
            ->where('tipo_movimiento_id', 2)
            ->whereHas('profesional.puesto', function($query) {$query->where('clues_adscripcion_jurisdiccion','8');})
            ->get();

        // Enviar correo
        Mail::to(['j8.siith@saludcoahuila.gob.mx'])->send(new VencimientoComisionesMail($titulo, $resultados));

        $this->info("Correo enviado con éxito con " . $resultados->count() . " resultados.");
    }
}
