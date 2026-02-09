<?php

namespace App\Http\Controllers;

use App\Models\GradoAcademico;
use App\Models\GradoAcademicoTitulo;
use Illuminate\Http\Request;

class CatalogoTituloController extends Controller
{
    //
    public function indexTitulo()
    {
        $titulos = GradoAcademicoTitulo::all();

        return view('settings.institucion-educativa-titulo.index', compact('titulos'));
    }

    public function createTitulo()
    {
        $gradosAcademicos = GradoAcademico::all();

        return view('settings.institucion-educativa-titulo.create', compact('gradosAcademicos'));
    }

    public function storeTitulo(Request $request)
    {
        $request->validate([
            'grado_academico_id'=>'required|string|max:100',
            'titulo'=>'required|string|max:100',
        ],[

        ]);

        $gradoAcademico = GradoAcademico::findOrFail($request->grado_academico_id);

        $titulo = new GradoAcademicoTitulo();

        $titulo->titulo = $request->titulo;
        $titulo->relacion = $gradoAcademico->cve;

        $titulo->save();

        return redirect()->route('indexTitulo')->with('success', 'Registro realizado correctamente');
    }
}
