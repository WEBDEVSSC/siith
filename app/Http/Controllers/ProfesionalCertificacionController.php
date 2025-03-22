<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use App\Models\Colegiacion;
use App\Models\Idioma;
use App\Models\LenguajeIndigena;
use App\Models\Profesional;
use App\Models\ProfesionalCertificacion;
use Illuminate\Http\Request;

class ProfesionalCertificacionController extends Controller
{
    //
    public function createCertificacion($id)
    {
        // Consultamos el profesional
        $profesional = Profesional::findOrFail($id);
        
        //Llenamos el select de Colegiacion
        $colegiaciones = Colegiacion::all();

        // Llenamos el select de Certificacion
        $certificaciones = Certificacion::all();

        // Llenamos el select de Idioma
        $idiomas = Idioma::all();

        // Llenamos el select de Lengua Indigena
        $lenguajes = LenguajeIndigena::all();

        // Regresamos la vista con los objetos
        return view('certificaciones.create', compact('profesional','colegiaciones','certificaciones','idiomas','lenguajes'));

    }

    public function storeCertificacion(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional' => 'nullable',
            'colegiacion_id' => 'nullable',
            'certificacion_id' => 'nullable',
            'institucion_educativa_id' => 'nullable',
            'idioma_id' => 'nullable',
            'idioma_nivel_de_dominio' => 'nullable',
            'lengua_indigena_id' => 'nullable',
            'lengua_nivel_de_dominio' => 'nullable',
        ],[
            'id_profesional.required' => 'El campo ID Profesional es obligatorio.',
            'colegiacion_id.required' => 'Debe seleccionar una colegiación.',
            'certificacion_id.required' => 'Debe seleccionar una certificación.',
            'institucion_educativa_id.required' => 'Debe seleccionar una institución educativa.',
            'idioma.required' => 'Debe ingresar un idioma.',
            'idioma_nivel_de_dominio.required' => 'Debe seleccionar un nivel de dominio del idioma.',
            'lengua_indigena_id.required' => 'Debe seleccionar una lengua indígena.',
            'lengua_nivel_de_dominio.required' => 'Debe seleccionar un nivel de dominio de la lengua indígena.',
        ]);
        
        // Consultamos los datos de COLEGIACION
        $colegiacion = Colegiacion::findOrFail($request->colegiacion_id);

        // Consultamos los datos de CERTIFICACION
        $certificacionSelect = Certificacion::findOrFail($request->certificacion_id);

        // Consultamos los datos de IDIOMA
        $idioma = Idioma::findOrFail($request->idioma_id);

        // Consultamos los datos de LENGUA INDIGENA
        $lenguaIndigena = LenguajeIndigena::findOrFail($request->lengua_indigena_id);

        // Activamos el modulo
        $mdl_certificacion = 1;

        // Creamos el nuevo objeto
        $certificacion = new ProfesionalCertificacion();

        // Asignamos los valores
        $certificacion->id_profesional = $request->id_profesional;

        $certificacion->colegiacion_id = $request->colegiacion_id;
        $certificacion->colegiacion_label = $colegiacion->colegio;

        $certificacion->certificacion_id = $request->certificacion_id;
        $certificacion->certificacion_label = $certificacionSelect->certificacion;

        $certificacion->idioma_id = $request->idioma_id;
        $certificacion->idioma_label = $idioma->idioma;
        $certificacion->idioma_nivel_de_dominio = $request->idioma_nivel_de_dominio;

        $certificacion->lengua_indigena_id = $request->lengua_indigena_id;
        $certificacion->lengua_indigena_label = $lenguaIndigena->lenguaje;
        $certificacion->lengua_nivel_de_dominio = $request->lengua_nivel_de_dominio;

        $certificacion->mdl_certificacion = $mdl_certificacion;

        // Guardamos el registro
        $certificacion->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('successCertificacion', 'Certificaciones registrada correctamente.');
    }

    public function editCertificacion($id)
    {
        // Buscamos el registro
        $certificacio = ProfesionalCertificacion::where('id_profesional',$id)->first();

        // Buscamos el profesional
        $profesional = Profesional::findOrFail($id);

        //Llenamos el select de Colegiacion
        $colegiaciones = Colegiacion::all();

        // Llenamos el select de Certificacion
        $certificaciones = Certificacion::all();

        // Llenamos el select de Idioma
        $idiomas = Idioma::all();

        // Llenamos el select de Lengua Indigena
        $lenguajes = LenguajeIndigena::all();

        // Regresamos la vista con los objetos
        return view('certificaciones.edit', compact('profesional','certificacio','colegiaciones','certificaciones','idiomas','lenguajes'));


    }

    public function updateCertificacion(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'colegiacion_id' => 'nullable',
            'certificacion_id' => 'nullable',
            'institucion_educativa_id' => 'nullable',
            'idioma_id' => 'nullable',
            'idioma_nivel_de_dominio' => 'nullable',
            'lengua_indigena_id' => 'nullable',
            'lengua_nivel_de_dominio' => 'nullable',
        ],[
            'colegiacion_id.required' => 'Debe seleccionar una colegiación.',
            'certificacion_id.required' => 'Debe seleccionar una certificación.',
            'institucion_educativa_id.required' => 'Debe seleccionar una institución educativa.',
            'idioma.required' => 'Debe ingresar un idioma.',
            'idioma_nivel_de_dominio.required' => 'Debe seleccionar un nivel de dominio del idioma.',
            'lengua_indigena_id.required' => 'Debe seleccionar una lengua indígena.',
            'lengua_nivel_de_dominio.required' => 'Debe seleccionar un nivel de dominio de la lengua indígena.',
        ]);

        // Consultamos los datos de COLEGIACION
        $colegiacion = Colegiacion::findOrFail($request->colegiacion_id);

        // Consultamos los datos de CERTIFICACION
        $certificacionSelect = Certificacion::findOrFail($request->certificacion_id);

        // Consultamos los datos de IDIOMA
        $idioma = Idioma::findOrFail($request->idioma_id);

        // Consultamos los datos de LENGUA INDIGENA
        $lenguaIndigena = LenguajeIndigena::findOrFail($request->lengua_indigena_id);

        // Buscamos el registro a editar
        $certificacion = ProfesionalCertificacion::findOrFail($id);

        // Asignamos los valores
        $certificacion->update([
            'colegiacion_id'=>$request->colegiacion_id,
            'colegiacion_label'=>$colegiacion->colegio,
            'certificacion_id'=>$request->certificacion_id,
            'certificacion_label'=>$certificacionSelect->certificacion,
            'idioma_id'=>$request->idioma_id,
            'idioma_label'=>$idioma->idioma,
            'idioma_nivel_de_dominio'=>$request->idioma_nivel_de_dominio,
            'lengua_indigena_id'=>$request->lengua_indigena_id,
            'lengua_indigena_label'=>$lenguaIndigena->lenguaje,
            'lengua_nivel_de_dominio'=>$request->lengua_nivel_de_dominio,
        ]);

        // Guardamos el registro
        $certificacion->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('updateCertificacion', 'Certificaciones actualizadas correctamente.');
        
    }

}
