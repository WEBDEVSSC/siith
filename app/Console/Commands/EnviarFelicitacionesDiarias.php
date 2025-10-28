<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProfesionalController;
use App\Mail\FelicitacionCumpleanos;
use App\Mail\FelicitacionesEnviadas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

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

        // Enviar notificación a Telegram
        $this->enviarNotificacionTelegram(count($profesionalesFelicitados));
    }

    private function enviarNotificacionTelegram($cantidad)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $mensaje = $cantidad > 0
            ? "✅ Se han enviado $cantidad correos de felicitación exitosamente."
            : "❌ No hubo cumpleaños hoy, no se enviaron correos.";

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $mensaje,
        ]);
    }
}