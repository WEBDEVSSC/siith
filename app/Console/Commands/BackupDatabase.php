<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupDatabase extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Generar un respaldo de la base de datos usando credenciales del .env';

    public function handle()
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST', '127.0.0.1');
        $backupPath = storage_path('app/backups');

        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        $fileName = $backupPath . '/' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';

        // Comando mysqldump modificado para evitar privilegios PROCESS
        $command = sprintf(
            'mysqldump --no-tablespaces -h%s -u%s -p%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            $password, // <- quitar escapeshellarg aquí
            escapeshellarg($database),
            escapeshellarg($fileName)
        );

        $this->info('⏳ Generando respaldo...');

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result === 0) {
            $this->info("✅ Respaldo generado correctamente: {$fileName}");
        } else {
            $this->error('❌ Error al generar el respaldo.');
        }
    }
}
