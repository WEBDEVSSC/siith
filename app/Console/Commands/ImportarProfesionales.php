<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportarProfesionales extends Command
{
    protected $signature = 'profesionales:importar';
    protected $description = 'Importa los datos del JSON de INE a la tabla profesionales_extraer';

    public function handle()
    {
        $jsonPath = '/home/recursosh/Escritorio/resultados_ines.json';

        if (!File::exists($jsonPath)) {
            $this->error("El archivo no existe en la ruta: {$jsonPath}");
            return;
        }

        $contenido = File::get($jsonPath);
        $registros = json_decode($contenido, true);

        if (empty($registros)) {
            $this->warn('El archivo JSON está vacío o no tiene un formato válido.');
            return;
        }

        $cantidad = 0;

        foreach ($registros as $item) {
            DB::table('profesionales_extraer')->updateOrInsert(
                ['archivo' => $item['archivo']],
                [
                    'tipo'       => $item['tipo'] ?? null,
                    'curp'       => $item['datos']['curp'] ?? null,
                    'seccion'    => $item['datos']['seccion'] ?? null,
                    'vigencia'   => $item['datos']['vigencia'] ?? null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
            $cantidad++;
        }

        // Envía la notificación con el total procesado
        $this->enviarNotificacionTelegram($cantidad);

        $this->info('¡Importación realizada con éxito desde el Escritorio!');
    }

    private function enviarNotificacionTelegram($cantidad)
    {
        $token = config('services.telegram.token');
        $chatIds = config('services.telegram.chat_ids');
        $server = gethostname();
        $fecha = date('Y-m-d');

        $chatId = is_array($chatIds) ? trim($chatIds[0]) : trim($chatIds);

        $mensaje = $cantidad > 0
            ? "🎉 Importación de INE exitosa\n\n"
            ."📁 Registros importados: {$cantidad}\n"
            ."🖥 Servidor: {$server}\n"
            ."📅 Fecha: {$fecha}"
            : "📭 *Sin registros para importar*\n\n"
            ."📁 Registros importados: 0\n"
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