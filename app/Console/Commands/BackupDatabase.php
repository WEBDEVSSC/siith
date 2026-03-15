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

        // Ejecuta mysqldump
        $command = "mysqldump --user={$user} --password={$pass} --host={$host} {$db} > {$path}";

        $returnVar = null;
        $output = null;

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {

            $size = file_exists($path) 
                ? round(filesize($path) / 1024 / 1024, 2) . " MB" 
                : "Desconocido";

            $this->info("✅ Respaldo completado: {$filename}");

            $this->enviarNotificacionTelegram(true, $filename, $path, $size);

        } else {

            $this->error("❌ Error al generar el respaldo");

            $this->enviarNotificacionTelegram(false, $filename, null, null);
        }
    }

    private function enviarNotificacionTelegram($exito, $filename, $path = null, $size = null)
    {
        $token = config('services.telegram.token');
        $chatIds = config('services.telegram.chat_ids');

        $chatId = trim($chatIds[0]);

        $db = config('database.connections.mysql.database');
        $server = gethostname();
        $fecha = date('Y-m-d H:i:s');

        $mensaje = $exito
            ? "✅ Backup completado\n\n"
              ."🗄 Base de datos: {$db}\n"
              ."📄 Archivo: {$filename}\n"
              ."💾 Tamaño: {$size}\n"
              ."🖥 Servidor: {$server}\n"
              ."📅 Fecha: {$fecha}"
            : "❌ Error al generar el respaldo\n\n"
              ."🗄 Base de datos: {$db}\n"
              ."📄 Archivo: {$filename}\n"
              ."🖥 Servidor: {$server}\n"
              ."📅 Fecha: {$fecha}";

        if ($exito && $path && file_exists($path)) {

            Http::attach(
                'document',
                file_get_contents($path),
                $filename
            )->post("https://api.telegram.org/bot{$token}/sendDocument", [
                'chat_id' => $chatId,
                'caption' => $mensaje
            ]);

        } else {

            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $mensaje
            ]);
        }
    }
}
