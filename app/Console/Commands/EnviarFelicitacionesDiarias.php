<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProfesionalController;
use App\Mail\FelicitacionCumpleanos;
use App\Mail\FelicitacionesEnviadas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            Mail::to(['soportewebssc@gmail.com','rhcoordmejoracontinua@gmail.com'])->send(new FelicitacionesEnviadas($profesionalesFelicitados));
        }

        $this->info('Correos de felicitación enviados exitosamente.');

        // Enviar notificación a Telegram
        $this->enviarNotificacionTelegram(count($profesionalesFelicitados));
    }

    private function enviarNotificacionTelegram($cantidad)
    {
        $token = config('services.telegram.token');
        $chatIds = config('services.telegram.chat_ids');
        $server = gethostname();
        $fecha = date('Y-m-d');

        $chatId = trim($chatIds[0]);

        $mensaje = $cantidad > 0
            ? "🎉 Felicitaciones enviadas\n\n"
            ."📧 Correos enviados: {$cantidad}\n"
            ."🖥 Servidor: {$server}\n"
            ."📅 Fecha: {$fecha}"
            : "📭 *Sin cumpleaños hoy*\n\n"
            ."📧 Correos enviados: 0\n"
            ."🖥 Servidor: {$server}\n"
            ."📅 Fecha: {$fecha}";

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $mensaje,
        ]);

        if (!$response->successful()) {
            Log::error('Error enviando Telegram', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }
    }
}