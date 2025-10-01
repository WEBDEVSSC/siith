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
            'cedula_numero_dos'=>'required_if:cedula_dos,SI|nullable',
            'reg_nac_prof_dos' => 'nullable|mimes:pdf|max:5120', 

            'grado_academico_tres'=>'nullable',
            'titulo_tres'=>'nullable',
            'institucion_educativa_tres'=>'nullable',
            'cedula_tres' => 'nullable',
            'cedula_numero_tres' => 'required_if:cedula_tres,SI|nullable',
            'reg_nac_prof_tres' => 'nullable|mimes:pdf|max:5120', 

            'grado_academico_cuatro'=>'nullable',
            'titulo_cuatro'=>'nullable',
            'institucion_educativa_cuatro'=>'nullable',
            'cedula_cuatro' => 'nullable',
            'cedula_numero_cuatro' => 'required_if:cedula_cuatro,SI|nullable',
            'reg_nac_prof_cuatro' => 'nullable|mimes:pdf|max:5120', 

        ],[
            // ---- General ----
            'id_profesional.required' => 'El campo ID del profesional es obligatorio.',

            // ---- UNO ----
            'grado_academico_uno.required' => 'El primer grado académico es obligatorio.',
            'cedula_numero_uno.required_if' => 'El número de cédula (primer grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_uno.mimes' => 'El archivo del Registro Nacional Profesional (primer grado) debe ser un PDF.',
            'reg_nac_prof_uno.max' => 'El archivo del Registro Nacional Profesional (primer grado) no debe exceder los 5MB.',

            // ---- DOS ----
            'cedula_numero_dos.required_if' => 'El número de cédula (segundo grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_dos.mimes' => 'El archivo del Registro Nacional Profesional (segundo grado) debe ser un PDF.',
            'reg_nac_prof_dos.max' => 'El archivo del Registro Nacional Profesional (segundo grado) no debe exceder los 5MB.',

            // ---- TRES ----
            'grado_academico_tres.required' => 'El tercer grado académico es obligatorio.',
            'cedula_numero_tres.required_if' => 'El número de cédula (tercer grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_tres.mimes' => 'El archivo del Registro Nacional Profesional (tercer grado) debe ser un PDF.',
            'reg_nac_prof_tres.max' => 'El archivo del Registro Nacional Profesional (tercer grado) no debe exceder los 5MB.',

            // ---- CUATRO ----
            'grado_academico_cuatro.required' => 'El cuarto grado académico es obligatorio.',
            'cedula_numero_cuatro.required_if' => 'El número de cédula (cuarto grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_cuatro.mimes' => 'El archivo del Registro Nacional Profesional (cuarto grado) debe ser un PDF.',
            'reg_nac_prof_cuatro.max' => 'El archivo del Registro Nacional Profesional (cuarto grado) no debe exceder los 5MB.',
        ]);

        // Consultamos el label de grado academico
        $gradoAcademicoUno = GradoAcademico::where('cve',$request->grado_academico_uno)->first();
        $gradoAcademicoDos = GradoAcademico::where('cve',$request->grado_academico_dos)->first();
        $gradoAcademicoTres = GradoAcademico::where('cve',$request->grado_academico_tres)->first();
        $gradoAcademicoCuatro = GradoAcademico::where('cve',$request->grado_academico_cuatro)->first();

        // Si no se encuentra el grado, asignamos un valor por defecto para evitar el error
        $gradoAcademicoUnoNombre = $gradoAcademicoUno ? $gradoAcademicoUno->grado : null;
        $gradoAcademicoDosNombre = $gradoAcademicoDos ? $gradoAcademicoDos->grado : null;
        $gradoAcademicoTresNombre = $gradoAcademicoTres ? $gradoAcademicoTres->grado : null;
        $gradoAcademicoCuatroNombre = $gradoAcademicoCuatro ? $gradoAcademicoCuatro->grado : null;

        // Consultamos el label de titulo uno
        $tituloUno = GradoAcademicoTitulo::where('id',$request->titulo_uno)->first();
        $tituloDos = GradoAcademicoTitulo::where('id',$request->titulo_dos)->first();
        $tituloTres = GradoAcademicoTitulo::where('id',$request->titulo_tres)->first();
        $tituloCuatro = GradoAcademicoTitulo::where('id',$request->titulo_cuatro)->first();

        $tituloUnoNombre = $tituloUno ? $tituloUno->titulo : null;
        $tituloDosNombre = $tituloDos ? $tituloDos->titulo : null;
        $tituloTresNombre = $tituloTres ? $tituloTres->titulo : null;
        $tituloCuatroNombre = $tituloCuatro ? $tituloCuatro->titulo : null;

        // Consultamos la institucion educativa uno
        $institucionEducativaUno = InstitucionEducativa::where('id',$request->institucion_educativa_uno)->first();
        $institucionEducativaDos = InstitucionEducativa::where('id',$request->institucion_educativa_dos)->first();
        $institucionEducativaTres = InstitucionEducativa::where('id',$request->institucion_educativa_tres)->first();
        $institucionEducativaCuatro = InstitucionEducativa::where('id',$request->institucion_educativa_cuatro)->first();

        $institucionEducativaNombreUno = $institucionEducativaUno ? $institucionEducativaUno->institucion : null;
        $institucionEducativaNombreDos = $institucionEducativaDos ? $institucionEducativaDos->institucion : null;
        $institucionEducativaNombreTres = $institucionEducativaTres ? $institucionEducativaTres->institucion : null;
        $institucionEducativaNombreCuatro = $institucionEducativaCuatro ? $institucionEducativaCuatro->institucion : null;

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

        $rutaTres = null; 
        
        if ($request->hasFile('reg_nac_prof_tres') && $request->file('reg_nac_prof_tres')->isValid()) 
        {
            $extension = $request->file('reg_nac_prof_tres')->getClientOriginalExtension();
            $nombreArchivoTres = $profesional->curp . '-' . $request->cedula_numero_tres . '.' . $extension;

            $rutaTres = $request->reg_nac_prof_tres->storeAs('reg-nac-prof', $nombreArchivoTres, 'local');
        } 
        else 
        {
            $nombreArchivoTres = null;
        }

        $rutaCuatro = null; 
        
        if ($request->hasFile('reg_nac_prof_tres') && $request->file('reg_nac_prof_tres')->isValid()) 
        {
            $extension = $request->file('reg_nac_prof_tres')->getClientOriginalExtension();
            $nombreArchivoCuatro = $profesional->curp . '-' . $request->cedula_numero_cuatro . '.' . $extension;

            $rutaCuatro = $request->reg_nac_prof_cuatro->storeAs('reg-nac-prof', $nombreArchivoCuatro, 'local');
        } 
        else 
        {
            $nombreArchivoCuatro = null;
        }

        // Creamos el objeto para almacenar los datos
        $grado = new ProfesionalGradoAcademico();

        // Asignamos los valores
        $grado->id_profesional = $request->id_profesional;

        // Archivo 2
        $grado->cve_grado_uno = $request->grado_academico_uno;
        $grado->grado_academico_uno = $gradoAcademicoUnoNombre;
        $grado->titulo_uno_id = $request->titulo_uno;
        $grado->titulo_uno = $tituloUnoNombre;
        $grado->institucion_educativa_uno_id = $request->institucion_educativa_uno;
        $grado->institucion_educativa_uno = $institucionEducativaNombreUno;
        $grado->cedula_uno = $request->cedula_uno;
        $grado->numero_cedula_uno = $request->cedula_numero_uno;
        $grado->reg_nac_prof_uno = $rutaUno;

        // Archivo 2
        $grado->cve_grado_dos = $request->grado_academico_dos;
        $grado->grado_academico_dos = $gradoAcademicoDosNombre;
        $grado->titulo_dos_id = $request->titulo_dos;
        $grado->titulo_dos = $tituloDosNombre;
        $grado->institucion_educativa_dos_id = $request->institucion_educativa_dos;
        $grado->institucion_educativa_dos = $institucionEducativaNombreDos;
        $grado->cedula_dos = $request->cedula_dos;
        $grado->numero_cedula_dos = $request->cedula_numero_dos;
        $grado->reg_nac_prof_dos = $rutaDos;

        // Archivo 3
        $grado->cve_grado_tres = $request->grado_academico_tres;
        $grado->grado_academico_tres = $gradoAcademicoTresNombre;
        $grado->titulo_tres_id = $request->titulo_tres;
        $grado->titulo_tres = $tituloTresNombre;
        $grado->institucion_educativa_tres_id = $request->institucion_educativa_tres;
        $grado->institucion_educativa_tres = $institucionEducativaNombreTres;
        $grado->cedula_tres = $request->cedula_tres;
        $grado->numero_cedula_tres = $request->cedula_numero_tres;
        $grado->reg_nac_prof_tres = $rutaTres;

        // Archivo 4
        $grado->cve_grado_cuatro = $request->grado_academico_cuatro;
        $grado->grado_academico_cuatro = $gradoAcademicoCuatroNombre;
        $grado->titulo_cuatro_id = $request->titulo_cuatro;
        $grado->titulo_cuatro = $tituloCuatroNombre;
        $grado->institucion_educativa_cuatro_id = $request->institucion_educativa_cuatro;
        $grado->institucion_educativa_cuatro = $institucionEducativaNombreCuatro;
        $grado->cedula_cuatro = $request->cedula_cuatro;
        $grado->numero_cedula_cuatro = $request->cedula_numero_cuatro;
        $grado->reg_nac_prof_cuatro = $rutaCuatro;

        $grado->mdl_grado_academico = $mdl_grado_academico;

        // Guardamos los datos
        $grado->save();

        // Regresamos la vista con los objetos 
        return redirect()->route('profesionalShow', $request->id_profesional)->with('successGradoAcademico', 'Grado Academico registrado correctamente.');


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
            'reg_nac_prof_uno' => 'nullable|mimes:pdf|max:5120', 

            'grado_academico_dos'=>'nullable',
            'titulo_dos'=>'nullable',
            'institucion_educativa_dos'=>'nullable',
            'cedula_dos'=>'nullable',
            'cedula_numero_dos'=>'required_if:cedula_dos,SI|nullable',
            'reg_nac_prof_dos' => 'nullable|mimes:pdf|max:5120', 

            'grado_academico_tres'=>'required',
            'titulo_tres'=>'nullable',
            'institucion_educativa_tres'=>'nullable',
            'cedula_tres' => 'nullable',
            'cedula_numero_tres' => 'required_if:cedula_tres,SI|nullable',
            'reg_nac_prof_tres' => 'nullable|mimes:pdf|max:5120', 

            'grado_academico_cuatro'=>'required',
            'titulo_cuatro'=>'nullable',
            'institucion_educativa_cuatro'=>'nullable',
            'cedula_cuatro' => 'nullable',
            'cedula_numero_cuatro' => 'required_if:cedula_cuatro,SI|nullable',
            'reg_nac_prof_cuatro' => 'nullable|mimes:pdf|max:5120', 

        ],[
            // ---- General ----
            'id_profesional.required' => 'El campo ID del profesional es obligatorio.',

            // ---- UNO ----
            'grado_academico_uno.required' => 'El primer grado académico es obligatorio.',
            'cedula_numero_uno.required_if' => 'El número de cédula (primer grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_uno.mimes' => 'El archivo del Registro Nacional Profesional (primer grado) debe ser un PDF.',
            'reg_nac_prof_uno.max' => 'El archivo del Registro Nacional Profesional (primer grado) no debe exceder los 5MB.',

            // ---- DOS ----
            'cedula_numero_dos.required_if' => 'El número de cédula (segundo grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_dos.mimes' => 'El archivo del Registro Nacional Profesional (segundo grado) debe ser un PDF.',
            'reg_nac_prof_dos.max' => 'El archivo del Registro Nacional Profesional (segundo grado) no debe exceder los 5MB.',

            // ---- TRES ----
            'grado_academico_tres.required' => 'El tercer grado académico es obligatorio.',
            'cedula_numero_tres.required_if' => 'El número de cédula (tercer grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_tres.mimes' => 'El archivo del Registro Nacional Profesional (tercer grado) debe ser un PDF.',
            'reg_nac_prof_tres.max' => 'El archivo del Registro Nacional Profesional (tercer grado) no debe exceder los 5MB.',

            // ---- CUATRO ----
            'grado_academico_cuatro.required' => 'El cuarto grado académico es obligatorio.',
            'cedula_numero_cuatro.required_if' => 'El número de cédula (cuarto grado) es obligatorio cuando la cédula está marcada como "SI".',
            'reg_nac_prof_cuatro.mimes' => 'El archivo del Registro Nacional Profesional (cuarto grado) debe ser un PDF.',
            'reg_nac_prof_cuatro.max' => 'El archivo del Registro Nacional Profesional (cuarto grado) no debe exceder los 5MB.',
        ]);

        // Consultamos el label de grado academico
        $gradoAcademicoUno = GradoAcademico::where('cve',$request->grado_academico_uno)->first();
        $gradoAcademicoDos = GradoAcademico::where('cve',$request->grado_academico_dos)->first();
        $gradoAcademicoTres = GradoAcademico::where('cve',$request->grado_academico_tres)->first();
        $gradoAcademicoCuatro = GradoAcademico::where('cve',$request->grado_academico_cuatro)->first();

        // Si no se encuentra el grado, asignamos un valor por defecto para evitar el error
        $gradoAcademicoUnoNombre = $gradoAcademicoUno ? $gradoAcademicoUno->grado : null;
        $gradoAcademicoDosNombre = $gradoAcademicoDos ? $gradoAcademicoDos->grado : null;
        $gradoAcademicoTresNombre = $gradoAcademicoTres ? $gradoAcademicoTres->grado : null;
        $gradoAcademicoCuatroNombre = $gradoAcademicoCuatro ? $gradoAcademicoCuatro->grado : null;

        // Consultamos el label de titulo uno
        $tituloUno = GradoAcademicoTitulo::where('id',$request->titulo_uno)->first();
        $tituloDos = GradoAcademicoTitulo::where('id',$request->titulo_dos)->first();
        $tituloTres = GradoAcademicoTitulo::where('id',$request->titulo_tres)->first();
        $tituloCuatro = GradoAcademicoTitulo::where('id',$request->titulo_cuatro)->first();

        $tituloUnoNombre = $tituloUno ? $tituloUno->titulo : null;
        $tituloDosNombre = $tituloDos ? $tituloDos->titulo : null;
        $tituloTresNombre = $tituloTres ? $tituloTres->titulo : null;
        $tituloCuatroNombre = $tituloCuatro ? $tituloCuatro->titulo : null;

        // Consultamos la institucion educativa uno
        $institucionEducativaUno = InstitucionEducativa::where('id',$request->institucion_educativa_uno)->first();
        $institucionEducativaDos = InstitucionEducativa::where('id',$request->institucion_educativa_dos)->first();
        $institucionEducativaTres = InstitucionEducativa::where('id',$request->institucion_educativa_tres)->first();
        $institucionEducativaCuatro = InstitucionEducativa::where('id',$request->institucion_educativa_cuatro)->first();

        $institucionEducativaNombreUno = $institucionEducativaUno ? $institucionEducativaUno->institucion : null;
        $institucionEducativaNombreDos = $institucionEducativaDos ? $institucionEducativaDos->institucion : null;
        $institucionEducativaNombreTres = $institucionEducativaTres ? $institucionEducativaTres->institucion : null;
        $institucionEducativaNombreCuatro = $institucionEducativaCuatro ? $institucionEducativaCuatro->institucion : null;

        // Consultamos el CURP del profesional
        $profesional = Profesional::findOrFail($request->id_profesional);

        // Buscamos el registro a editar
        $grado = ProfesionalGradoAcademico::findOrFail($id);

         // ✅ Mantener archivos actuales
        $rutaUno    = $grado->reg_nac_prof_uno;
        $rutaDos    = $grado->reg_nac_prof_dos;
        $rutaTres   = $grado->reg_nac_prof_tres;
        $rutaCuatro = $grado->reg_nac_prof_cuatro;

        // ✅ Procesar cada archivo si hay uno nuevo
        if ($request->hasFile('reg_nac_prof_uno')) {
            
            // ✅ Si ya existe un archivo anterior, lo borramos
            if ($grado->reg_nac_prof_uno && Storage::disk('local')->exists($grado->reg_nac_prof_uno)) {
                Storage::disk('local')->delete($grado->reg_nac_prof_uno);
            }
            
            $extension = $request->file('reg_nac_prof_uno')->getClientOriginalExtension();
            $nombreArchivoUno = $profesional->curp . '-grado-uno.' . $extension;
            $rutaUno = $request->reg_nac_prof_uno->storeAs('reg-nac-prof', $nombreArchivoUno, 'local');
        }

        if ($request->hasFile('reg_nac_prof_dos')) {

            // ✅ Si ya existe un archivo anterior, lo borramos
            if ($grado->reg_nac_prof_dos && Storage::disk('local')->exists($grado->reg_nac_prof_dos)) {
                Storage::disk('local')->delete($grado->reg_nac_prof_dos);
            }

            $extension = $request->file('reg_nac_prof_dos')->getClientOriginalExtension();
            $nombreArchivoDos = $profesional->curp . '-grado-dos.' . $extension;
            $rutaDos = $request->reg_nac_prof_dos->storeAs('reg-nac-prof', $nombreArchivoDos, 'local');
        }

        if ($request->hasFile('reg_nac_prof_tres')) {

            // ✅ Si ya existe un archivo anterior, lo borramos
            if ($grado->reg_nac_prof_tres && Storage::disk('local')->exists($grado->reg_nac_prof_tres)) {
                Storage::disk('local')->delete($grado->reg_nac_prof_tres);
            }

            $extension = $request->file('reg_nac_prof_tres')->getClientOriginalExtension();
            $nombreArchivoTres = $profesional->curp . '-grado-tres.' . $extension;
            $rutaTres = $request->reg_nac_prof_tres->storeAs('reg-nac-prof', $nombreArchivoTres, 'local');
        }

        if ($request->hasFile('reg_nac_prof_cuatro')) {

            // ✅ Si ya existe un archivo anterior, lo borramos
            if ($grado->reg_nac_prof_cuatro && Storage::disk('local')->exists($grado->reg_nac_prof_cuatro)) {
                Storage::disk('local')->delete($grado->reg_nac_prof_cuatro);
            }

            $extension = $request->file('reg_nac_prof_cuatro')->getClientOriginalExtension();
            $nombreArchivoCuatro = $profesional->curp . '-grado-cuatro.' . $extension;
            $rutaCuatro = $request->reg_nac_prof_cuatro->storeAs('reg-nac-prof', $nombreArchivoCuatro, 'local');
        }        

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
            'reg_nac_prof_uno'=>$rutaUno,

            'cve_grado_dos'=>$request->grado_academico_dos,
            'grado_academico_dos'=>$gradoAcademicoDosNombre,
            'titulo_dos_id'=>$request->titulo_dos,
            'titulo_dos'=>$tituloDosNombre,
            'institucion_educativa_dos_id'=>$request->institucion_educativa_dos,
            'institucion_educativa_dos'=>$institucionEducativaNombreDos,
            'cedula_dos'=>$request->cedula_dos,
            'numero_cedula_dos'=>$request->cedula_numero_dos,
            'reg_nac_prof_dos'=>$rutaDos,

            'cve_grado_tres'=>$request->grado_academico_tres,
            'grado_academico_tres'=>$gradoAcademicoTresNombre,
            'titulo_tres_id'=>$request->titulo_tres,
            'titulo_tres'=>$tituloTresNombre,
            'institucion_educativa_tres_id'=>$request->institucion_educativa_tres,
            'institucion_educativa_tres'=>$institucionEducativaNombreTres,
            'cedula_tres'=>$request->cedula_tres,
            'numero_cedula_tres'=>$request->cedula_numero_tres,
            'reg_nac_prof_tres'=>$rutaTres,

            'cve_grado_cuatro'=>$request->grado_academico_cuatro,
            'grado_academico_cuatro'=>$gradoAcademicoCuatroNombre,
            'titulo_cuatro_id'=>$request->titulo_cuatro,
            'titulo_cuatro'=>$tituloCuatroNombre,
            'institucion_educativa_cuatro_id'=>$request->institucion_educativa_cuatro,
            'institucion_educativa_cuatro'=>$institucionEducativaNombreCuatro,
            'cedula_cuatro'=>$request->cedula_cuatro,
            'numero_cedula_cuatro'=>$request->cedula_numero_cuatro,
            'reg_nac_prof_cuatro'=>$rutaCuatro,
        ]);

        // Redireccionamos con un mensaje de éxito
        return redirect()->route('profesionalShow', $request->id_profesional)->with('updateGradoAcademico', 'Grado Academico actualizado correctamente.');
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

    public function regNacProfTres ($id)
    {
        $grado = ProfesionalGradoAcademico::findOrFail($id);
        $path = $grado->reg_nac_prof_tres;

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

    public function regNacProfCuatro ($id)
    {
        $grado = ProfesionalGradoAcademico::findOrFail($id);
        $path = $grado->reg_nac_prof_cuatro;

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