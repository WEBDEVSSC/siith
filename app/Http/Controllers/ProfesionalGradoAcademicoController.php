<?php

namespace App\Http\Controllers;

use App\Models\GradoAcademico;
use App\Models\GradoAcademicoTitulo;
use App\Models\GradosAcademicos;
use App\Models\InstitucionEducativa;
use App\Models\Profesional;
use App\Models\ProfesionalGradoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            'grado_academico_uno'=>'required',
            'titulo_uno'=>'nullable',
            'institucion_educativa_uno'=>'nullable',
            'cedula_uno' => 'nullable',
            'cedula_numero_uno' => 'required_if:cedula_uno,SI|nullable',
            'reg_nac_prof_uno' => 'nullable|mimes:pdf|max:5120', 

            'grado_academico_dos'=>'nullable',
            'titulo_dos'=>'nullable',
            'institucion_educativa_dos'=>'nullable',
            'cedula_dos'=>'nullable',
            'cedula_numero_dos'=>'required_if:cedula_dos,SInullable',
            'reg_nac_prof_dos' => 'nullable|mimes:pdf|max:5120', 

        ],[
            'id_profesional.required' => 'El campo ID del profesional es obligatorio.',
            'grado_academico_uno.required' => 'El primer grado académico es obligatorio.',
            'cedula_numero_uno.required_if' => 'El número de cédula es obligatorio cuando la cédula está marcada como "SI".',
            'cedula_numero_dos.required_if' => 'El número de cédula es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_uno.mimes' => 'El archivo de Registro de Nacimiento debe ser un PDF.',
            'reg_nac_prof_uno.max' => 'El archivo de Registro de Nacimiento no debe exceder los 5MB.',
            'reg_nac_prof_dos.mimes' => 'El archivo de Registro de Nacimiento debe ser un PDF.',
            'reg_nac_prof_dos.max' => 'El archivo de Registro de Nacimiento no debe exceder los 5MB.',
        ]);

        // Consultamos el label de grado academico
        $gradoAcademicoUno = GradoAcademico::where('cve',$request->grado_academico_uno)->first();
        $gradoAcademicoDos = GradoAcademico::where('cve',$request->grado_academico_dos)->first();

        // Si no se encuentra el grado, asignamos un valor por defecto para evitar el error
        $gradoAcademicoUnoNombre = $gradoAcademicoUno ? $gradoAcademicoUno->grado : null;
        $gradoAcademicoDosNombre = $gradoAcademicoDos ? $gradoAcademicoDos->grado : null;

        // Consultamos el label de titulo uno
        $tituloUno = GradoAcademicoTitulo::where('id',$request->titulo_uno)->first();
        $tituloDos = GradoAcademicoTitulo::where('id',$request->titulo_dos)->first();

        $tituloUnoNombre = $tituloUno ? $tituloUno->titulo : null;
        $tituloDosNombre = $tituloDos ? $tituloDos->titulo : null;

        // Consultamos la institucion educativa uno
        $institucionEducativaUno = InstitucionEducativa::where('id',$request->institucion_educativa_uno)->first();
        $institucionEducativaDos = InstitucionEducativa::where('id',$request->institucion_educativa_dos)->first();

        $institucionEducativaNombreUno = $institucionEducativaUno ? $institucionEducativaUno->institucion : null;
        $institucionEducativaNombreDos = $institucionEducativaDos ? $institucionEducativaDos->institucion : null;

        // Activamos el registro el modulo
        $mdl_grado_academico = 1;

        // Consultamos el CURP del profesional
        $profesional = Profesional::findOrFail($request->id_profesional);

        // Renombramos y subimos la imagen
        //$nombreArchivoUno = $profesional->curp .'-'. $request->cedula_numero_uno . '.' . $request->file('reg_nac_prof_uno')->getClientOriginalExtension();
        //$nombreArchivoDos = $profesional->curp .'-'. $request->cedula_numero_dos . '.' . $request->file('reg_nac_prof_dos')->getClientOriginalExtension();

        //$rutaUno = $request->reg_nac_prof_uno->storeAs('reg-nac-prof', $nombreArchivoUno, 'local');
        //$rutaDos = $request->reg_nac_prof_dos->storeAs('reg-nac-prof', $nombreArchivoDos, 'local');

        $rutaUno = null; 

        if ($request->hasFile('reg_nac_prof_uno') && $request->file('reg_nac_prof_uno')->isValid()) 
        {
            $extension = $request->file('reg_nac_prof_uno')->getClientOriginalExtension();
            $nombreArchivoUno = $profesional->curp . '-' . $request->cedula_numero_uno . '.' . $extension;

            $rutaUno = $request->reg_nac_prof_uno->storeAs('reg-nac-prof', $nombreArchivoUno, 'local');
        } 
        else 
        {
            $nombreArchivoUno = null;
        }

        $rutaDos = null; 
        
        if ($request->hasFile('reg_nac_prof_dos') && $request->file('reg_nac_prof_dos')->isValid()) 
        {
            $extension = $request->file('reg_nac_prof_dos')->getClientOriginalExtension();
            $nombreArchivoDos = $profesional->curp . '-' . $request->cedula_numero_dos . '.' . $extension;

             $rutaDos = $request->reg_nac_prof_dos->storeAs('reg-nac-prof', $nombreArchivoDos, 'local');
        } 
        else 
        {
            $nombreArchivoDos = null;
        }

        // Creamos el objeto para almacenar los datos
        $grado = new ProfesionalGradoAcademico();

        // Asignamos los valores
        $grado->id_profesional = $request->id_profesional;

        $grado->cve_grado_uno = $request->grado_academico_uno;
        $grado->grado_academico_uno = $gradoAcademicoUnoNombre;
        $grado->titulo_uno_id = $request->titulo_uno;
        $grado->titulo_uno = $tituloUnoNombre;
        $grado->institucion_educativa_uno_id = $request->institucion_educativa_uno;
        $grado->institucion_educativa_uno = $institucionEducativaNombreUno;
        $grado->cedula_uno = $request->cedula_uno;
        $grado->numero_cedula_uno = $request->cedula_numero_uno;
        $grado->reg_nac_prof_uno = $rutaUno;

        $grado->cve_grado_dos = $request->grado_academico_dos;
        $grado->grado_academico_dos = $gradoAcademicoDosNombre;
        $grado->titulo_dos_id = $request->titulo_dos;
        $grado->titulo_dos = $tituloDosNombre;
        $grado->institucion_educativa_dos_id = $request->institucion_educativa_dos;
        $grado->institucion_educativa_dos = $institucionEducativaNombreDos;
        $grado->cedula_dos = $request->cedula_dos;
        $grado->numero_cedula_dos = $request->cedula_numero_dos;
        $grado->reg_nac_prof_dos = $rutaDos;

        $grado->mdl_grado_academico = $mdl_grado_academico;

        // Guardamos los datos
        $grado->save();

        // Regresamos la vista con los objetos 
        return redirect()->route('profesionalIndex')->with('successGradoAcademico', 'Grado Academico registrado correctamente.');


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editGrado($id)
    {
        // Consultamos los datos del registro
        $gradoAcademico = ProfesionalGradoAcademico::where('id_profesional',$id)->first();
        
        // Consultar los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de Grado Academico
        $gradosAcademicos = GradoAcademico::all();

        // Llenamos el select de Titulos
        $titulos = GradoAcademicoTitulo::orderBy('titulo','asc')->get();

        // Instituciones edcativas
        $institucionesEducativas = InstitucionEducativa::orderBy('institucion', 'asc')->get();

        // Regresamos la vista con los objetos
        return view('grado-academico.edit', compact('gradoAcademico','profesional', 'gradosAcademicos', 'titulos', 'institucionesEducativas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateGrado(Request $request, $id)
    {
        
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',

            'grado_academico_uno'=>'required',
            'titulo_uno'=>'nullable',
            'institucion_educativa_uno'=>'nullable',
            'cedula_uno' => 'nullable',
            'cedula_numero_uno' => 'required_if:cedula_uno,SI|nullable',

            'grado_academico_dos'=>'nullable',
            'titulo_dos'=>'nullable',
            'institucion_educativa_dos'=>'nullable',
            'cedula_dos'=>'nullable',
            'cedula_numero_dos'=>'required_if:cedula_dos,SInullable',

        ],[
            'id_profesional.required' => 'El campo ID del profesional es obligatorio.',
            'grado_academico_uno.required' => 'El primer grado académico es obligatorio.',
            'cedula_numero_uno.required_if' => 'El número de cédula es obligatorio cuando la cédula está marcada como "SI".',
            'cedula_numero_dos.required_if' => 'El número de cédula es obligatorio cuando la cédula está marcada como "SI".',
        ]);

        //dd($request->grado_academico_uno);

        // Consultamos el label de grado academico
        $gradoAcademicoUno = GradoAcademico::where('cve',$request->grado_academico_uno)->first();
        $gradoAcademicoDos = GradoAcademico::where('cve',$request->grado_academico_dos)->first();

        // Si no se encuentra el grado, asignamos un valor por defecto para evitar el error
        $gradoAcademicoUnoNombre = $gradoAcademicoUno ? $gradoAcademicoUno->grado : null;
        $gradoAcademicoDosNombre = $gradoAcademicoDos ? $gradoAcademicoDos->grado : null;

        // Consultamos el label de titulo uno
        $tituloUno = GradoAcademicoTitulo::where('id',$request->titulo_uno)->first();
        $tituloDos = GradoAcademicoTitulo::where('id',$request->titulo_dos)->first();

        $tituloUnoNombre = $tituloUno ? $tituloUno->titulo : null;
        $tituloDosNombre = $tituloDos ? $tituloDos->titulo : null;

        // Consultamos la institucion educativa uno
        $institucionEducativaUno = InstitucionEducativa::where('id',$request->institucion_educativa_uno)->first();
        $institucionEducativaDos = InstitucionEducativa::where('id',$request->institucion_educativa_dos)->first();

        $institucionEducativaNombreUno = $institucionEducativaUno ? $institucionEducativaUno->institucion : null;
        $institucionEducativaNombreDos = $institucionEducativaDos ? $institucionEducativaDos->institucion : null;

        // Buscamos el registro a editar
        $grado = ProfesionalGradoAcademico::findOrFail($id);

        // Asignamos los campos
        $grado->update([
            'cve_grado_uno'=>$request->grado_academico_uno,
            'grado_academico_uno'=>$gradoAcademicoUnoNombre,
            'titulo_uno_id'=>$request->titulo_uno,
            'titulo_uno'=>$tituloUnoNombre,
            'institucion_educativa_uno_id'=>$request->institucion_educativa_uno,
            'institucion_educativa_uno'=>$institucionEducativaNombreUno,
            'cedula_uno'=>$request->cedula_uno,
            'numero_cedula_uno'=>$request->cedula_numero_uno,

            'cve_grado_dos'=>$request->grado_academico_dos,
            'grado_academico_dos'=>$gradoAcademicoDosNombre,
            'titulo_dos_id'=>$request->titulo_dos,
            'titulo_dos'=>$tituloDosNombre,
            'institucion_educativa_dos_id'=>$request->institucion_educativa_dos,
            'institucion_educativa_dos'=>$institucionEducativaNombreDos,
            'cedula_dos'=>$request->cedula_dos,
            'numero_cedula_dos'=>$request->cedula_numero_dos
        ]);

        // Redireccionamos con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('updateGradoAcademico', 'Grado Academico actualizado correctamente.');
    }

    public function regNacProfUno ($id)
    {
        $grado = ProfesionalGradoAcademico::findOrFail($id);
        $path = $grado->reg_nac_prof_uno;

        //dd($path);

        if (Storage::disk('local')->exists($path)) {
            // Obtener contenido
            $file = Storage::disk('local')->get($path);
            $mime = Storage::disk('local')->mimeType($path);

            return response($file, 200)
                ->header('Content-Type', $mime)
                ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
        }

        abort(404, 'Archivo no encontrado');
    }

    public function regNacProfDos ($id)
    {
        $grado = ProfesionalGradoAcademico::findOrFail($id);
        $path = $grado->reg_nac_prof_dos;

        //dd($path);

        if (Storage::disk('local')->exists($path)) {
            // Obtener contenido
            $file = Storage::disk('local')->get($path);
            $mime = Storage::disk('local')->mimeType($path);

            return response($file, 200)
                ->header('Content-Type', $mime)
                ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
        }

        abort(404, 'Archivo no encontrado');
    }
}