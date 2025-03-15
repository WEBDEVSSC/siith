<?php

namespace App\Http\Controllers;

use App\Models\GradoAcademico;
use App\Models\GradoAcademicoTitulo;
use App\Models\GradosAcademicos;
use App\Models\InstitucionEducativa;
use App\Models\Profesional;
use App\Models\ProfesionalGradoAcademico;
use Illuminate\Http\Request;

class ProfesionalGradoAcademicoController extends Controller
{
    
    public function getTitulos($cve)
    {
        $titulos = GradoAcademicoTitulo::where('relacion', $cve)->pluck('titulo', 'id');
        return response()->json($titulos);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createGrado($id)
    {
        // Consultar los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de Grado Academico
        $gradosAcademicos = GradoAcademico::all();

        // Llenamos el select de Titulos
        $titulos = GradoAcademicoTitulo::orderBy('titulo','asc')->get();

        // Instituciones edcativas
        $institucionesEducativas = InstitucionEducativa::orderBy('institucion', 'asc')->get();

        // Regresamos la vista con los objetos
        return view('grado-academico.create', compact('profesional', 'gradosAcademicos', 'titulos', 'institucionesEducativas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeGrado(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',

            'grado_academico'=>'required',
            'titulo'=>'nullable',
            'institucion_educativa'=>'nullable',
            'cedula'=>'nullable',
            'cedula_numero'=>'nullable',

            'grado_academico_dos'=>'required',
            'titulo_dos'=>'nullable',
            'institucion_educativa_dos'=>'nullable',
            'cedula_dos'=>'nullable',
            'cedula_numero_dos'=>'nullable',

        ],[]);

        // Consultamos el label de grado academico
        $gradoAcademicoUno = GradoAcademico::where('cve',$request->grado_academico)->first();
        $gradoAcademicoDos = GradoAcademico::where('cve',$request->grado_academico_dos)->first();

        // Consultamos el label de titulo uno
        $tituloUno = GradoAcademicoTitulo::where('id',$request->titulo)->first();
        $tituloDos = GradoAcademicoTitulo::where('id',$request->titulo_dos)->first();

        // Consultamos la institucion educativa uno
        $institucionEducativaUno = InstitucionEducativa::where('id',$request->institucion_educativa)->first();
        $institucionEducativaDos = InstitucionEducativa::where('id',$request->institucion_educativa_dos)->first();

        // Activamos el registro el modulo
        $mdl_grado_academico = 1;

        // Creamos el objeto para almacenar los datos
        $grado = new ProfesionalGradoAcademico();

        // Asignamos los valores
        $grado->id_profesional = $request->id_profesional;
        $grado->cve_grado_uno = $request->grado_academico;
        $grado->grado_academico_uno = $gradoAcademicoUno->grado;
        $grado->titulo_uno_id = $request->titulo;
        $grado->titulo_uno = $tituloUno->titulo;
        $grado->institucion_educativa_uno_id = $request->institucion_educativa;
        $grado->institucion_educativa_uno = $institucionEducativaUno->institucion;
        $grado->cedula_uno = $request->cedula;
        $grado->numero_cedula_uno = $request->cedula_numero;

        $grado->cve_grado_dos = $request->grado_academico_dos;
        $grado->grado_academico_dos = $gradoAcademicoDos->grado;
        $grado->titulo_dos_id = $request->titulo_dos;
        $grado->titulo_dos = $tituloDos->titulo;
        $grado->institucion_educativa_dos_id = $request->institucion_educativa_dos;
        $grado->institucion_educativa_dos = $institucionEducativaDos->institucion;
        $grado->cedula_dos = $request->cedula_dos;
        $grado->numero_cedula_dos = $request->cedula_numero_dos;

        $grado->mdl_grado_academico = $mdl_grado_academico;

        // Guardamos los datos
        $grado->save();

        // Regresamos la vista con los objetos 
        return redirect()->route('profesionalIndex')->with('successGradoAcademico', 'Grado Academico registrado correctamente.');


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
