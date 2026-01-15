<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\InstitucionEducativa;
use App\Models\Profesional;
use App\Models\ProfesionalAreaMedica;
use App\Models\TiposFormacionMedica;
use App\Models\CatAnioCursa;
use Illuminate\Http\Request;

class ProfesionalAreaMedicaController extends Controller
{
    public function getCarreras($tipoFormacionId)
    {
        $carreras = Carrera::where('tipo_formacion', $tipoFormacionId)->orderBy('carrera')->get();
        return response()->json($carreras);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function createAreaMedica($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de TIPO DE FORMACION
        $tiposFormacion = TiposFormacionMedica::orderBy('orden', 'asc')->get();

        // Llenamos el select de Carrera
        $carreras = Carrera::all();

        // Llenamos el select de Institucion formadora
        $institucionesEducativas = InstitucionEducativa::orderBy('institucion', 'asc')->get();

        // Llenamos el select de Años de duracion
        $aniosCursa = CatAnioCursa::all();

        // Regresamos la vista con el objeto
        return view('area-medica.create', compact('profesional','tiposFormacion','carreras','institucionesEducativas','aniosCursa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAreaMedica(Request $request)
    {
        $request->validate([
            'id_profesional' => 'required|integer',

            'tipo_formacion' => 'nullable|string',

            'carrera_id' => 'required_with:tipo_formacion|integer',
            'institucion_educativa_id' => 'required_with:tipo_formacion|integer',

            'anio_cursa' => 'required_with:tipo_formacion|string|max:4',
            'duracion_formacion' => 'required_with:tipo_formacion|string',
        ], [
            'id_profesional.required' => 'El campo "ID del profesional" es obligatorio.',
            'id_profesional.integer' => 'El campo "ID del profesional" debe ser un número entero.',

            'carrera_id.required_with' => 'La carrera es obligatoria cuando se selecciona un tipo de formación.',
            'institucion_educativa_id.required_with' => 'La institución educativa es obligatoria cuando se selecciona un tipo de formación.',

            'anio_cursa.required_with' => 'El año que cursa es obligatorio cuando se selecciona un tipo de formación.',
            'anio_cursa.string' => 'El año que cursa debe ser una cadena de texto.',
            'anio_cursa.max' => 'El año que cursa no debe exceder 4 caracteres.',

            'duracion_formacion.required_with' => 'La duración de la formación es obligatoria cuando se selecciona un tipo de formación.',
            'duracion_formacion.string' => 'La duración de la formación debe ser una cadena de texto.',
        ]);

        // Consultamos los datos de carrera
        $carrera = Carrera::findOrFail($request->carrera_id);

        // Consultamos los datos de la Institucion Educativa
        $institucionEducativa = InstitucionEducativa::findOrFail($request->institucion_educativa_id);

        // Consultamos el tipo de formacion
        $tipoFormacion = TiposFormacionMedica::findOrFail($request->tipo_formacion);

        // Consultamos el año que cursa
        $anioCursa = CatAnioCursa::findOrFail($request->anio_cursa);

        // Activamos el modulo
        $mdlAreaMedica = 1;

        // Creamos el objeto
        $areaMedica = new ProfesionalAreaMedica();

        // Asignamos los valores
        $areaMedica->id_profesional = $request->id_profesional;
        $areaMedica->tipo_formacion = $tipoFormacion->cve;
        $areaMedica->tipo_formacion_id = $request->tipo_formacion;
        $areaMedica->tipo_formacion_label = $tipoFormacion->tipo;
        $areaMedica->carrera_id = $request->carrera_id;
        $areaMedica->carrera_label = $carrera->carrera;
        $areaMedica->institucion_educativa_id = $request->institucion_educativa_id;
        $areaMedica->institucion_educativa_label = $institucionEducativa->institucion;
        $areaMedica->anio_cursa_id = $request->anio_cursa;
        $areaMedica->anio_cursa = $anioCursa->anio;
        $areaMedica->duracion_formacion = $request->duracion_formacion;
        $areaMedica->mdl_area_medica = $mdlAreaMedica;

        // Guardamos los valores
        $areaMedica->save();

        // Reidreccionamos
        return redirect()->route('profesionalShow', $request->id_profesional)->with('successAreaMedica', 'Area Médica registrada correctamente.');

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
    public function editAreaMedica($id)
    {
        // Consultamos los datos del registro
        $areaMedica = ProfesionalAreaMedica::where('id_profesional',$id)->first();
        
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);        

        // Llenamos el select de TIPO DE FORMACION
        $tiposFormacion = TiposFormacionMedica::all();

        // Llenamos el select de Carrera
        $carreras = Carrera::all();

        //Llenamos el select de Institucion formadora
        $institucionesEducativas = InstitucionEducativa::orderBy('institucion', 'asc')->get();

        // Llenamos el select de Años de duracion
        $aniosCursa = CatAnioCursa::all();

        // Regresamos la vista con el objeto
        return view('area-medica.edit', compact('areaMedica', 'profesional','tiposFormacion','carreras','institucionesEducativas','aniosCursa'));

        

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAreaMedica(Request $request, $id)
    {
        $request->validate([
            'id_profesional' => 'required|integer',

            'tipo_formacion' => 'nullable|string',

            'carrera_id' => 'required_with:tipo_formacion|integer',
            'institucion_educativa_id' => 'required_with:tipo_formacion|integer',

            'anio_cursa' => 'required_with:tipo_formacion|string|max:4',
            'duracion_formacion' => 'required_with:tipo_formacion|string',
        ], [
            'id_profesional.required' => 'El campo "ID del profesional" es obligatorio.',
            'id_profesional.integer' => 'El campo "ID del profesional" debe ser un número entero.',

            'carrera_id.required_with' => 'La carrera es obligatoria cuando se selecciona un tipo de formación.',
            'institucion_educativa_id.required_with' => 'La institución educativa es obligatoria cuando se selecciona un tipo de formación.',

            'anio_cursa.required_with' => 'El año que cursa es obligatorio cuando se selecciona un tipo de formación.',
            'anio_cursa.string' => 'El año que cursa debe ser una cadena de texto.',
            'anio_cursa.max' => 'El año que cursa no debe exceder 4 caracteres.',

            'duracion_formacion.required_with' => 'La duración de la formación es obligatoria cuando se selecciona un tipo de formación.',
            'duracion_formacion.string' => 'La duración de la formación debe ser una cadena de texto.',
        ]);

        // Buscamos el registro a editar
        $areaMedica = ProfesionalAreaMedica::findOrFail($id);

        // Consultamos los datos de carrera
        $carrera = Carrera::findOrFail($request->carrera_id);

        // Consultamos los datos de la Institucion Educativa
        $institucionEducativa = InstitucionEducativa::findOrFail($request->institucion_educativa_id);
 
        // Consultamos el tipo de formacion
        $tipoFormacion = TiposFormacionMedica::findOrFail($request->tipo_formacion);

        // Consultamos el año que cursa
        $anioCursa = CatAnioCursa::findOrFail($request->anio_cursa);

        // Asignamos los valores
        $areaMedica->update([
            'tipo_formacion' => $tipoFormacion->cve,
            'tipo_formacion_id' => $request->tipo_formacion,
            'tipo_formacion_label' => $tipoFormacion->tipo,
            'carrera_id' => $request->carrera_id,
            'carrera_label' => $carrera->carrera,
            'institucion_educativa_id' => $request->institucion_educativa_id,
            'institucion_educativa_label' => $institucionEducativa->institucion,
            'anio_cursa_id' => $request->anio_cursa,
            'anio_cursa' => $anioCursa->anio,
            'duracion_formacion' => $request->duracion_formacion,
        ]);

        // Regresamos a la vista
        return redirect()->route('profesionalShow', $request->id_profesional)->with('updateAreaMedica', 'Area Medica actualizada correctamente.');
    }

}
