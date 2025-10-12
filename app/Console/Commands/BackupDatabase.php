<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class BackupDatabase extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Generar un respaldo de la base de datos usando .my.cnf y enviar correo de confirmación';

    public function handle()
    {
        $database = env('DB_DATABASE');
        $backupPath = storage_path('app/backups');

        // Crear carpeta si no existe
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        // Nombre del archivo de respaldo
        $fileName = $backupPath . '/' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';

        // Comando mysqldump usando .my.cnf (no necesita usuario ni contraseña en el comando)
        $command = sprintf(
            'mysqldump --no-tablespaces %s > %s',
            escapeshellarg($database),
            escapeshellarg($fileName)
        );

        $this->info('⏳ Generando respaldo...');

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result === 0) {
            $this->info("✅ Respaldo generado correctamente: {$fileName}");

            // Enviar correo de confirmación
            Mail::raw("✅ El respaldo de la base de datos se completó correctamente.\nArchivo: {$fileName}", function ($message) {
                $message->to('cesartorres.1688@gmail.com')
                        ->subject('Respaldo completado - SIITH');
            });

        } else {
            $this->error('❌ Error al generar el respaldo.');
        }
    }
}
