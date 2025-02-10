<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\ProfesionalCredencializacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfesionalCredencializacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCredencializacion($id)
    {
        // Consultamos el ID del profesional
        $profesional = Profesional::findOrFail($id);

        // Regresamos a la vista
        return view('credencializacion.index', compact('profesional'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCredencializacion(Request $request)
    {
        //
        $request->validate([
            'id_profesional' => 'required',
            'curp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'id_profesional.required' => 'El campo Profesional ID es obligatorio.',
            'curp.required' => 'El campo CURP es obligatorio.',
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'La imagen debe ser de tipo: jpeg, png o jpg.',
            'foto.max' => 'El tamaño máximo permitido para la imagen es 2MB.',
        ]);

        // Obtener la fecha y hora actual en el formato deseado
        $timestamp = now()->format('Ymd_His');

        // Crear el nombre del archivo con la fecha y hora
        $archivoNombre = $request->curp . '-' . $timestamp . '.' . $request->foto->extension();

        // Almacenar el archivo en la carpeta 'documents' en el almacenamiento local
        $archivoPath = $request->foto->storeAs('credencializacion', $archivoNombre, 'local');

        $mdl_credencializacion = 1;

        $profesional = new ProfesionalCredencializacion();

        $profesional->id_profesional = $request->id_profesional;
        $profesional->fotografia = $archivoPath;
        $profesional->mdl_credencializacion = $mdl_credencializacion;

        $profesional -> save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('successCredencializacion', 'Registro actualizado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
