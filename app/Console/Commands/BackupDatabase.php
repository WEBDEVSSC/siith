<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Genera un respaldo de la base de datos y lo envía por correo';
    
    public function handle()
    {

        // Nombre del archivo con fecha y hora
        $filename = 'backup_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $path = storage_path('app/backups/' . $filename);

        // Crear carpeta si no existe
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Ruta completa de mysqldump
        $dumpPath = '"C:\wamp64\bin\mysql\mysql9.1.0\bin\mysqldump.exe"';

        // Datos de la base de datos desde .env
        $dbHost = config('database.connections.mysql.host');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');
        $dbName = config('database.connections.mysql.database');

        // Comando para generar el respaldo
        $command = "{$dumpPath} -h {$dbHost} -u {$dbUser} -p\"{$dbPass}\" {$dbName} > \"{$path}\"";

        // Ejecutar comando
        system($command, $returnVar);

        if ($returnVar === 0 && file_exists($path)) {
            // Enviar por correo
            Mail::raw("Adjunto el respaldo de la base de datos SIITH.", function ($message) use ($path, $filename) {
                $message->to('soportewebssc@gmail.com')
                        ->subject('Respaldo de base de datos')
                        ->attach($path);
            });

            $this->info("Respaldo generado y enviado por correo: {$filename}");
        } else {
            $this->error("Error al generar el respaldo.");
        }

    }
}
