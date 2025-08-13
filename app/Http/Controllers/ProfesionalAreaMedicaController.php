<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\InstitucionEducativa;
use App\Models\Profesional;
use App\Models\ProfesionalAreaMedica;
use App\Models\TiposFormacionMedica;
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

        //Llenamos el select de Institucion formadora
        $institucionesEducativas = InstitucionEducativa::orderBy('institucion', 'asc')->get();


        // Regresamos la vista con el objeto
        return view('area-medica.create', compact('profesional','tiposFormacion','carreras','institucionesEducativas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAreaMedica(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional' => 'required|integer',
            'tipo_formacion' => 'nullable',
            'carrera_id' => 'nullable',
            'institucion_educativa_id' => 'nullable',
            'anio_cursa' => 'nullable|string',
            'duracion_formacion' => 'nullable|string',
        ],[
            'id_profesional.required' => 'El campo "ID del profesional" es obligatorio.',
            'id_profesional.integer' => 'El campo "ID del profesional" debe ser un número entero.',
            'anio_cursa.string' => 'El campo "Año que cursa" debe ser una cadena de texto.',
            'duracion_formacion.string' => 'El campo "Duración de la formación" debe ser una cadena de texto.',
        ]);

        // Consultamos los datos de carrera
        $carrera = Carrera::findOrFail($request->carrera_id);

        // Consultamos los datos de la Institucion Educativa
        $institucionEducativa = InstitucionEducativa::findOrFail($request->institucion_educativa_id);

        // Consultamos el tipo de formacion
        $tipoFormacion = TiposFormacionMedica::findOrFail($request->tipo_formacion);

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
        $areaMedica->anio_cursa = $request->anio_cursa;
        $areaMedica->duracion_formacion = $request->duracion_formacion;
        $areaMedica->mdl_area_medica = $mdlAreaMedica;

        // Guardamos los valores
        $areaMedica->save();

        // Reidreccionamos
        return redirect()->route('profesionalIndex')->with('successAreaMedica', 'Area Médica registrada correctamente.');

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

        // Regresamos la vista con el objeto
        return view('area-medica.edit', compact('areaMedica', 'profesional','tiposFormacion','carreras','institucionesEducativas'));

        

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAreaMedica(Request $request, $id)
    {
             
        // Validamos los datos
        $request->validate([
            'id_profesional' => 'required|integer',
            'tipo_formacion' => 'nullable',
            'carrera_id' => 'nullable',
            'institucion_educativa_id' => 'nullable',
            'anio_cursa' => 'nullable|string',
            'duracion_formacion' => 'nullable|string',
        ],[
            'id_profesional.required' => 'El campo "ID del profesional" es obligatorio.',
            'id_profesional.integer' => 'El campo "ID del profesional" debe ser un número entero.',
            'anio_cursa.string' => 'El campo "Año que cursa" debe ser una cadena de texto.',
            'duracion_formacion.string' => 'El campo "Duración de la formación" debe ser una cadena de texto.',
        ]);
        

        // Buscamos el registro a editar
        $areaMedica = ProfesionalAreaMedica::findOrFail($id);

        // Consultamos los datos de carrera
        $carrera = Carrera::findOrFail($request->carrera_id);

        // Consultamos los datos de la Institucion Educativa
        $institucionEducativa = InstitucionEducativa::findOrFail($request->institucion_educativa_id);
 
        // Consultamos el tipo de formacion
        $tipoFormacion = TiposFormacionMedica::findOrFail($request->tipo_formacion);

        // Asignamos los valores
        $areaMedica->update([
            'tipo_formacion' => $tipoFormacion->cve,
            'tipo_formacion_id' => $request->tipo_formacion,
            'tipo_formacion_label' => $tipoFormacion->tipo,
            'carrera_id' => $request->carrera_id,
            'carrera_label' => $carrera->carrera,
            'institucion_educativa_id' => $request->institucion_educativa_id,
            'institucion_educativa_label' => $institucionEducativa->institucion,
            'anio_cursa' => $request->anio_cursa,
            'duracion_formacion' => $request->duracion_formacion,
        ]);

        // Regresamos a la vista
        return redirect()->route('profesionalIndex')->with('updateAreaMedica', 'Area Medica actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
