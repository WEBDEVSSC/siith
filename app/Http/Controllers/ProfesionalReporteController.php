<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ProfesionalReporteController extends Controller
{
    //
    public function reporteIndex()
    {
        return view('reporte.index');
    }

    /**
     * 
     * 
     * DESCARGAR CARPETA DE FOTOGRAFIAS
     * 
     * 
     */
    public function descargarCarpetaFotografias()
    {
        $carpeta = storage_path('app/public/credencializacion'); // ruta de la carpeta
        $zipFile = storage_path('app/temp/archivos.zip');

        // Crear carpeta temporal si no existe
        if (!File::exists(dirname($zipFile))) {
            File::makeDirectory(dirname($zipFile), 0755, true);
        }

        $zip = new ZipArchive;

        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $archivos = File::allFiles($carpeta);

            foreach ($archivos as $archivo) {
                $relativePath = str_replace($carpeta . '/', '', $archivo->getRealPath());
                $zip->addFile($archivo->getRealPath(), $relativePath);
            }

            $zip->close();
        } else {
            return back()->with('error', 'No se pudo crear el archivo ZIP');
        }

        return response()->download($zipFile)->deleteFileAfterSend(true);
    }
}
