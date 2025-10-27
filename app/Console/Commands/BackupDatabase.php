<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Exporta la base de datos y guarda el archivo en storage/app/backups';

    public function handle()
    {
        $db = config('database.connections.mysql.database');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $path = storage_path('app/backups/' . $filename);

        // Ejecuta el comando mysqldump
        $command = "mysqldump --user={$user} --password={$pass} --host={$host} {$db} > {$path}";

        $returnVar = null;
        $output = null;
        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("✅ Respaldo completado: {$filename}");
            $this->enviarNotificacionTelegram(true, $filename);
        } else {
            $this->error("❌ Error al generar el respaldo");
            $this->enviarNotificacionTelegram(false, $filename);
        }
    }

    private function enviarNotificacionTelegram($exito, $filename)
    {
        $token = env('TELEGRAM_BOT_TOKEN'); // tu token en .env
        $chatId = env('TELEGRAM_CHAT_ID');  // tu chat_id en .env

        $mensaje = $exito
            ? "✅ Respaldo de base de datos completado: {$filename}"
            : "❌ Error al generar el respaldo: {$filename}";

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $mensaje,
        ]);
    }
}
