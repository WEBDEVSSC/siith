<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GenerarMiniaturas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imagenes:miniaturas {--force : Regenerar miniaturas aunque ya existan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera miniaturas de 100x100 para las fotografías existentes en credencializacion';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $disk = Storage::disk('public');
        $path = 'credencializacion';
        $thumbsPath = $path . '/thumbs';

        // Crear carpeta de miniaturas si no existe
        if (!$disk->exists($thumbsPath)) {
            $disk->makeDirectory($thumbsPath);
        }

        // Inicializar ImageManager con GD (puedes cambiar a imagick si lo tienes instalado)
        $manager = new ImageManager(new Driver());

        $archivos = $disk->files($path);

        foreach ($archivos as $archivo) {
            $nombre = basename($archivo);

            // Saltar si es carpeta thumbs
            if (str_contains($archivo, 'thumbs/')) {
                continue;
            }

            $thumbPath = $disk->path($thumbsPath . '/' . $nombre);

            // Verificar si ya existe miniatura
            if (!$this->option('force') && file_exists($thumbPath)) {
                $this->line("Miniatura ya existe: {$nombre}");
                continue;
            }

            try {
                $manager->read($disk->path($archivo)) // 👈 en v3 se usa ->read()
                    ->scaleDown(100, 100)             // 👈 reemplazo de ->fit()
                    ->save($thumbPath);

                $this->info("Miniatura creada: {$nombre}");
            } catch (\Exception $e) {
                $this->error("Error con {$nombre}: " . $e->getMessage());
            }
        }

        $this->info("Proceso finalizado ✅");
    }
}
