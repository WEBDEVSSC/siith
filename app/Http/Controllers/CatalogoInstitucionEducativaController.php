<?php

namespace App\Http\Controllers;

use App\Models\InstitucionEducativa;
use Illuminate\Http\Request;

class CatalogoInstitucionEducativaController extends Controller
{
    public function indexInstitucionEducativa()
    {
        $institucionesEducativas = InstitucionEducativa::all();

        return view('settings.institucion-educativa.index', compact('institucionesEducativas'));
    }

    public function createInstitucionEducativa()
    {
        return view('settings.institucion-educativa.create');
    }

    public function storeInstitucionEducativa(Request $request)
    {
        $request->validate([
            'institucion' => 'required|max:100|string'
        ],[]);

        $institucionEducativa = new InstitucionEducativa();

        $institucionEducativa->institucion = $request->institucion;

        $institucionEducativa->save();

        return redirect()->route('indexInstitucionEducativa')->with('success', 'Institución Educativa registrada correctamente.');
    }

    public function editInstitucionEducativa($id)
    {
        $institucionEducativa = InstitucionEducativa::findOrFail($id);

        return view('settings.institucion-educativa.edit', compact('institucionEducativa'));
    }

    public function updateInstitucionEducativa(Request $request, $id)
    {
        $request->validate([
            'institucion' => 'required|max:100|string'
        ],[]);

        $institucionEducativa = InstitucionEducativa::findOrFail($id);

        $institucionEducativa->institucion = $request->institucion;

        $institucionEducativa->save();

        /**
         * 
         * 
         * 
         * FALTA ACTUALIZAR EN LOS REGISOTRS DE GRADO ACADEMICO Y PERSONAL ESTUDIANDO ACTUALMENTE
         * 
         * 
         */

        return redirect()->route('indexInstitucionEducativa')->with('success', 'Institución Educativa actualizada correctamente.');
    }

    public function deleteInstitucionEducativa($id)
    {
        dd("MODULO EN CONSTRUCCION");
    }
}
