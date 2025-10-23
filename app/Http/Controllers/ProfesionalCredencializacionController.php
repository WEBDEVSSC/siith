<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalCredencializacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class ProfesionalCredencializacionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function createCredencializacion($id)
    {
        // Consultamos el ID del profesional
        $profesional = Profesional::findOrFail($id);

        // Generamos la URL de la fotografía
        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;
        $fotoUrl = $fotografia ? url('/foto/' . basename($fotografia)) : null;

        // Regresamos a la vista
        return view('credencializacion.create', compact('profesional', 'fotoUrl'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function storeCredencializacion(Request $request)
    {

        // Validación de campos
        $request->validate([
            'id_profesional' => 'required',
            'curp'           => 'required',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'id_profesional.required' => 'El campo Profesional ID es obligatorio.',
            'curp.required'           => 'El campo CURP es obligatorio.',
            'foto.image'              => 'El archivo debe ser una imagen.',
            'foto.mimes'              => 'La imagen debe ser de tipo: jpeg, png o jpg.',
            'foto.max'                => 'El tamaño máximo permitido para la imagen es 2MB.',
        ]);

        $archivoNombre = null;

        if ($request->hasFile('foto')) {
            // Generar nombre único
            $archivoNombre = $request->curp . '-' . now()->format('Ymd_His') . '.' . $request->foto->extension();

            // Guardar archivo original en disco public
            $request->foto->storeAs('credencializacion', $archivoNombre, 'public');

            // Crear carpeta de miniaturas si no existe
            if (!Storage::disk('public')->exists('credencializacion/thumbs')) {
                Storage::disk('public')->makeDirectory('credencializacion/thumbs');
            }

            // Crear y guardar miniatura 100x100 con Intervention v3
            $manager = new ImageManager(new Driver());

            $thumbPath = storage_path('app/public/credencializacion/thumbs/' . $archivoNombre);

            $manager->read($request->file('foto'))
                ->cover(100, 100) // cover reemplaza a fit en v3
                ->save($thumbPath);
        }

        // Guardar registro en la tabla ProfesionalCredencializacion
        $profesional = new ProfesionalCredencializacion();
        $profesional->id_profesional        = $request->id_profesional;
        $profesional->fotografia            = $archivoNombre; // solo nombre del archivo
        $profesional->mdl_credencializacion = 1;
        $profesional->save();

        // Guardar acción en bitácora
        $usuario = Auth::user();
        $bitacora = new ProfesionalBitacora();
        $bitacora->id_capturista    = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion           = "NUEVO REGISTRO EN MODULO CREDENCIALIZACION";
        $bitacora->id_profesional   = $request->id_profesional;
        $bitacora->save();

        // Redireccionar con mensaje de éxito
        return redirect()
            ->route('profesionalShow', $profesional->id_profesional)
            ->with('successCredencializacion', 'Registro actualizado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function editCredencializacion($id)
    {
        // Buscamos el registro utilizando el id
        $credencializacion = ProfesionalCredencializacion::where('id_profesional', $id)->first();

        // Consultamos los datos del usuario para la tarjeta
        $profesional = Profesional::findOrFail($id);

        // Generamos la URL de la fotografía
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;
            
        // Retornamos la vista
        return view('credencializacion.edit', compact('credencializacion', 'profesional', 'fotoUrl'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateCredencializacion(Request $request, string $id)
    {

        // Validación de campos
        $request->validate([
            'id_profesional' => 'required',
            'curp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'id_profesional.required' => 'El campo Profesional ID es obligatorio.',
            'curp.required'           => 'El campo CURP es obligatorio.',
            'foto.image'              => 'El archivo debe ser una imagen.',
            'foto.mimes'              => 'La imagen debe ser de tipo: jpeg, png o jpg.',
            'foto.max'                => 'El tamaño máximo permitido para la imagen es 2MB.',
        ]);

        // Obtener registro
        $credencializacion = ProfesionalCredencializacion::findOrFail($id);
        $archivoNombre = $credencializacion->fotografia; // nombre actual

        if ($request->hasFile('foto')) {

            // Eliminar fotos existentes (original + miniatura)
            if ($archivoNombre) {
                Storage::disk('public')->delete('credencializacion/' . $archivoNombre);
                Storage::disk('public')->delete('credencializacion/thumbs/' . $archivoNombre);
            }

            // Generar nombre único
            $archivoNombre = $request->curp . '-' . now()->format('Ymd_His') . '.' . $request->foto->extension();

            // Guardar archivo original en disco 'public'
            $request->foto->storeAs('credencializacion', $archivoNombre, 'public');

            // Crear carpeta de miniaturas si no existe
            if (!Storage::disk('public')->exists('credencializacion/thumbs')) {
                Storage::disk('public')->makeDirectory('credencializacion/thumbs');
            }

            // Crear miniatura 100x100 con ImageManager v3
            $manager = new ImageManager(new Driver());
            $thumbPath = storage_path('app/public/credencializacion/thumbs/' . $archivoNombre);

            $manager->read($request->file('foto'))
                ->cover(100, 100) // cover reemplaza a fit en v3
                ->save($thumbPath);
        }

        // Actualizar registro
        $credencializacion->update([
            'fotografia' => $archivoNombre
        ]);

        // Guardar acción en bitácora
        $usuario = Auth::user();
        ProfesionalBitacora::create([
            'id_capturista'    => $usuario->id,
            'capturista_label' => $usuario->responsable,
            'accion'           => "ACTUALIZACION EN MODULO CREDENCIALIZACION",
            'id_profesional'   => $credencializacion->id_profesional
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()
            ->route('profesionalShow', $request->id_profesional)
            ->with('successCredencializacion', 'Registro actualizado correctamente.');
    }

    public function descargarFoto($id)
    {
        $credencializacion = ProfesionalCredencializacion::findOrFail($id);

        if (!$credencializacion->fotografia) {
            return redirect()->back()->with('error', 'No hay fotografía para descargar.');
        }

        $archivo = 'credencializacion/' . $credencializacion->fotografia;

        if (!Storage::disk('public')->exists($archivo)) {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }

        return Storage::disk('public')->download($archivo);
    }

}
