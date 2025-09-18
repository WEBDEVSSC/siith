<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Adicional;
use App\Models\AreaTrabajo;
use App\Models\Clue;
use App\Models\CodigoPuesto;
use App\Models\InstitucionPuesto;
use App\Models\NominaPago;
use App\Models\Ocupacion;
use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalPuesto;
use App\Models\TipoContrato;
use App\Models\TipoPersonal;
use App\Models\TipoPlaza;
use App\Models\Vigencia;
use App\Models\VigenciaMotivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalPuestoController extends Controller
{
    /*
    public function getMotivos($vigencia)
    {
        $motivos = VigenciaMotivo::where('label_vigencia', $vigencia)->pluck('motivo', 'id');
        return response()->json($motivos);
        
    }*/

        public function getMotivos($vigencia, Request $request)
        {
            $nomina = $request->input('nomina');

            if($nomina === "IB - IMSS-BIENESTAR"){
                // Cargar todos los motivos sin filtro
                $motivos = VigenciaMotivo::where('label_vigencia', $vigencia)
                            ->orderBy('motivo', 'asc')
                            ->pluck('motivo');
            } else {
                // Cargar solo los que tienen ib = 0
                $motivos = VigenciaMotivo::where('label_vigencia', $vigencia)
                            ->where('ib', 0)
                            ->orderBy('motivo', 'asc')
                            ->pluck('motivo');
            }

            return response()->json($motivos);
        }
            
    //
    public function createPuesto($id)
    {
        // Consultar los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ACTIVIDAD
        $actividades = Actividad::all();

        // Llenamos el select de ADICIONAL
        $adicionales = Adicional::all();

        // Llenamos el select TIPO DE PERSONAL
        $tiposPersonal = TipoPersonal::all();

        // Llenamos el select de CODIGO DE PUESTO
        $codigosPuesto = CodigoPuesto::orderBy('codigo_puesto', 'asc')->get();

        // Llenamos el select de CLUES Nomina y Adscripcion
        $clues = Clue::orderBy('clave_jurisdiccion', 'asc') 
             ->orderBy('nombre', 'asc')
             ->get();

        // Llenamos el select de AREA DE TRABAJO
        $areasTrabajo = AreaTrabajo::orderBy('area_trabajo','asc')->get();

        // Llenamos el select de ocupacion
        $ocupaciones = Ocupacion::orderBy('ocupacion', 'asc')->get();

        // Llenamos el select de nominas de pago
        $nominasPago = NominaPago::orderBy('nomina','asc')->get();

        // Llenamos el select de TIPO DE CONTRATO
        $tiposContrato = TipoContrato::orderBy('tipo_contrato','asc')->get();

        // Llenamos el select de TIPO DE PLAZA
        $tiposPlaza = TipoPlaza::orderBy('tipo_plaza','asc')->get();

        // Llenamos el select de INSTITUCION PUESTO
        $institucionesPuesto = InstitucionPuesto::all();

        // Llenamos el select de Vigencia
        $vigencias = Vigencia::all();

        // Llenamos el select de vigencias motivos
        $vigenciasMotivos = VigenciaMotivo::orderBy('id_vigencia','asc')->get();

        // Regresamos al form con el objeto
        return view('puesto.puesto', compact(
            'profesional',
            'id',
            'actividades',
            'adicionales',
            'tiposPersonal',
            'codigosPuesto',
            'clues',
            'areasTrabajo',
            'ocupaciones',
            'nominasPago',
            'tiposContrato',
            'tiposPlaza',
            'institucionesPuesto',
            'vigencias',
            'vigenciasMotivos',
        ));
    }

    public function storePuesto(Request $request)
    {
        // Validamos los datos
        $validated = $request->validate([
            'id_profesional' => 'required',
            'fiel' => 'required',
            'fiel_vigencia' => 'required_if:fiel,SI',
            'actividad' => 'required',
            'adicional' => 'required',
            'tipo_personal' => 'required',
            'codigo_puesto' => 'required',
            'clues_nomina' => 'required',
            'clues_adscripcion' => 'nullable',
            'area_trabajo' => 'required',
            'ocupacion' => 'required',
            'nomina_pago' => 'required',
            'tipo_contrato' => 'required',
            'fecha_ingreso' => 'required',
            'tipo_plaza' => 'required',
            'institucion_puesto' => 'required',
            'vigencia' => 'required',
            'vigencia_motivo' => 'required',
            'temporalidad' => 'required',
            'licencia_maternidad' => 'required',
            'seguro_salud' => 'required',
        ], [
            'id_profesional.required' => 'El ID del profesional es obligatorio.',
            'fiel.required' => 'El campo FIEL es obligatorio.',
            'fiel_vigencia.required_if' => 'El campo FIEL Vigencia es obligatorio cuando FIEL está seleccionado como "SI".',
            'actividad.required' => 'El campo Actividad es obligatorio.',
            'adicional.required' => 'El campo Adicional es obligatorio.',
            'tipo_personal.required' => 'El campo Tipo de Personal es obligatorio.',
            'codigo_puesto.required' => 'El Código de Puesto es obligatorio.',
            'clues_nomina.required' => 'El campo CLUES Nómina es obligatorio.',
            'clues_adscripcion.required' => 'El campo CLUES Adscripción es obligatorio.',
            'area_trabajo.required' => 'El Área de Trabajo es obligatoria.',
            'ocupacion.required' => 'El campo Ocupación es obligatorio.',
            'nomina_pago.required' => 'El campo Nómina de Pago es obligatorio.',
            'tipo_contrato.required' => 'El Tipo de Contrato es obligatorio.',
            'fecha_ingreso.required' => 'El campo Fecha de Ingreso es obligatorio.',
            'tipo_plaza.required' => 'El Tipo de Plaza es obligatorio.',
            'institucion_puesto.required' => 'El campo Institución del Puesto es obligatorio.',
            'vigencia.required' => 'El campo Vigencia es obligatorio.',
            'vigencia_motivo.required' => 'El Motivo de la Vigencia es obligatorio.',
            'temporalidad.required' => 'El campo Temporalidad es obligatorio.',
            'licencia_maternidad.required' => 'El campo Licencia de Maternidad es obligatorio.',
            'seguro_salud.required' => 'El campo Seguro de Salud es obligatorio.',
        ]);


        // Activamos el modulo
        $mdl_puesto = 1;

        // Consultamos los datos de CLUES NOMINA
        $cluesNomina = Clue::findOrFail($request->clues_nomina);

        // Consultamos los datos de CLUES ADSCRIPCION
        $cluesAdscripcion = Clue::findOrFail($request->clues_adscripcion);

        // Creamos el objeto
        $puesto = new ProfesionalPuesto();

        // Asignamos los valores
        $puesto->id_profesional = $request->id_profesional;
        $puesto->fiel = $request->fiel;
        $puesto->fiel_vigencia = $request->fiel_vigencia;
        $puesto->fiel_vigencia = $request->fiel_vigencia;
        $puesto->actividad = $request->actividad;
        $puesto->adicional = $request->adicional;
        $puesto->tipo_personal = $request->tipo_personal;
        $puesto->codigo_puesto = $request->codigo_puesto;

        $puesto->clues_nomina = $cluesNomina->clues;
        $puesto->clues_nomina_nombre = $cluesNomina->nombre;
        $puesto->clues_nomina_municipio = $cluesNomina->municipio;
        $puesto->clues_nomina_jurisdiccion = $cluesNomina->clave_jurisdiccion;

        $puesto->clues_adscripcion = $cluesAdscripcion->clues;
        $puesto->clues_adscripcion_nombre = $cluesAdscripcion->nombre;
        $puesto->clues_adscripcion_municipio = $cluesAdscripcion->municipio;
        $puesto->clues_adscripcion_jurisdiccion	 = $cluesAdscripcion->clave_jurisdiccion;
        $puesto->clues_adscripcion_tipo	 = $cluesAdscripcion->clave_establecimiento;

        $puesto->area_trabajo= $request->area_trabajo;
        $puesto->ocupacion= $request->ocupacion;
        $puesto->nomina_pago= $request->nomina_pago;
        $puesto->tipo_contrato= $request->tipo_contrato;
        $puesto->fecha_ingreso= $request->fecha_ingreso;
        $puesto->tipo_plaza= $request->tipo_plaza;
        $puesto->institucion_puesto= $request->institucion_puesto;
        $puesto->vigencia= $request->vigencia;
        $puesto->vigencia_motivo= $request->vigencia_motivo;
        $puesto->temporalidad= $request->temporalidad;
        $puesto->licencia_maternidad= $request->licencia_maternidad;
        $puesto->seguro_salud= $request->seguro_salud;

        $puesto->mdl_puesto = $mdl_puesto;

        // Almacenamos los valores
        // Guardar el nuevo profesional
        $puesto->save();

        // Retornar o redirigir a donde lo necesites, por ejemplo:
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Registro realizado correctamente.');
    }

    /** *******************************************************************************************************************************
     * 
     * 
     * EDITAR REGISTRO
     * 
     *  *******************************************************************************************************************************
     */

    public function editPuesto($id)
    {
        // Consultamos el registro con el ID
        $profesional = ProfesionalPuesto::where('id_profesional',$id)->firstOrFail();

        $profesionalData = Profesional::where('id',$profesional->id_profesional)->first();

        // Llenamos el select de ACTIVIDAD
        $actividades = Actividad::all();

        // Llenamos el select de ADICIONAL
        $adicionales = Adicional::all();

        // Llenamos el select TIPO DE PERSONAL
        $tiposPersonal = TipoPersonal::all();

        // Llenamos el select de CODIGO DE PUESTO
        $codigosPuesto = CodigoPuesto::orderBy('codigo_puesto', 'asc')->get();
        
        // Llenamos el select de CLUES Nomina y Adscripcion
        $clues = Clue::orderBy('clave_jurisdiccion', 'asc') 
             ->orderBy('nombre', 'asc')
             ->get();

        // Cargamos los datos del usuario que inicio sesion
        $usuario = Auth::user();

        // Condicionamos para que solo se enlisten las unidades que corresponden
        if($usuario->role == 'ofJurisdiccional')
        {
            $cluesAdscripcion = Clue::where('clave_jurisdiccion', $usuario->jurisdiccion_unidad) 
                                    ->whereIn('clave_establecimiento', [1, 3])
                                    ->orderBy('nombre', 'asc')
                                    ->get();
        }
        else
        {
            $cluesAdscripcion = Clue::where('id', $usuario->id_unidad)->get();
        }
        
        // Llenamos el select de AREA DE TRABAJO
        $areasTrabajo = AreaTrabajo::orderBy('area_trabajo','asc')->get();

        // Llenamos el select de ocupacion
        $ocupaciones = Ocupacion::orderBy('ocupacion', 'asc')->get();

        // Llenamos el select de nominas de pago
        $nominasPago = NominaPago::orderBy('nomina','asc')->get();

        // Llenamos el select de TIPO DE CONTRATO
        $tiposContrato = TipoContrato::orderBy('tipo_contrato','asc')->get();

        // Llenamos el select de TIPO DE PLAZA
        $tiposPlaza = TipoPlaza::orderBy('tipo_plaza','asc')->get();

        // Llenamos el select de INSTITUCION PUESTO
        $institucionesPuesto = InstitucionPuesto::where('status',1)->get();

        // Llenamos el select de Vigencia
        $vigencias = Vigencia::all();

        // Llenamos el select de vigencias motivos
        $vigenciasMotivos = VigenciaMotivo::orderBy('id_vigencia','asc')->get();

        // Regresamos la vista con el ID
        return view('puesto.edit', compact(
            'profesionalData',
            'profesional',
            'id',
            'actividades',
            'adicionales',
            'tiposPersonal',
            'codigosPuesto',
            'clues',
            'cluesAdscripcion',
            'areasTrabajo',
            'ocupaciones',
            'nominasPago',
            'tiposContrato',
            'tiposPlaza',
            'institucionesPuesto',
            'vigencias',
            'vigenciasMotivos',
        ));
    }

    /** *******************************************************************************************************************************
     * 
     * 
     * ACTUALIZAR REGISTRO
     * 
     *  *******************************************************************************************************************************
     */

    public function updatePuesto(Request $request, $id)
    {      
        
        // Validamos los datos
        $validated = $request->validate([
            'id_profesional' => 'required',
            'fiel' => 'required',
            'fiel_vigencia' => 'required_if:fiel,SI',
            'actividad' => 'required',
            'adicional' => 'required',
            'tipo_personal' => 'required',
            //'codigo_puesto' => 'required',
            'clues_nomina' => 'required',
            'clues_adscripcion' => 'required',
            'area_trabajo' => 'required',
            'ocupacion' => 'required',
            //'nomina_pago' => 'required',
            //'tipo_contrato' => 'required',
            //'fecha_ingreso' => 'nullable|date',
            //'tipo_plaza' => 'required',
            'institucion_puesto' => 'required',
            //'vigencia' => 'required',
            //'vigencia_motivo' => 'required',
            //'temporalidad' => 'required',
            //'licencia_maternidad' => 'required',
            //'seguro_salud' => 'required',
        ], [
            'id_profesional.required' => 'El ID del profesional es obligatorio.',
            'fiel.required' => 'El campo FIEL es obligatorio.',
            'fiel_vigencia.required_if' => 'El campo FIEL Vigencia es obligatorio cuando FIEL está seleccionado como "SI".',
            'actividad.required' => 'El campo Actividad es obligatorio.',
            'adicional.required' => 'El campo Adicional es obligatorio.',
            'tipo_personal.required' => 'El campo Tipo de Personal es obligatorio.',
            'codigo_puesto.required' => 'El Código de Puesto es obligatorio.',
            'clues_nomina.required' => 'El campo CLUES Nómina es obligatorio.',
            'clues_adscripcion.required' => 'El campo CLUES Adscripción es obligatorio.',
            'area_trabajo.required' => 'El Área de Trabajo es obligatoria.',
            'ocupacion.required' => 'El campo Ocupación es obligatorio.',
            'nomina_pago.required' => 'El campo Nómina de Pago es obligatorio.',
            'tipo_contrato.required' => 'El Tipo de Contrato es obligatorio.',
            'fecha_ingreso.required' => 'El campo Fecha de Ingreso es obligatorio.',
            'tipo_plaza.required' => 'El Tipo de Plaza es obligatorio.',
            'institucion_puesto.required' => 'El campo Institución del Puesto es obligatorio.',
            'vigencia.required' => 'El campo Vigencia es obligatorio.',
            'vigencia_motivo.required' => 'El Motivo de la Vigencia es obligatorio.',
            'temporalidad.required' => 'El campo Temporalidad es obligatorio.',
            'licencia_maternidad.required' => 'El campo Licencia de Maternidad es obligatorio.',
            'seguro_salud.required' => 'El campo Seguro de Salud es obligatorio.',
        ]);

        // Consultamos el registro con el ID
        $profesional = ProfesionalPuesto::findOrFail($id);

        // Consultamos el CLUES Nomina
        $cluesNomina = Clue::where('clues',$request->clues_nomina)->first();

        // Consultamos el CLUES Adscripcion
        $cluesAdscripcion = Clue::where('clues',$request->clues_adscripcion)->first();

        // Actualizamos los campos
        $profesional->update([
            'fiel' => $request->fiel,
            'fiel_vigencia' => $request->fiel_vigencia,
            'actividad' => $request->actividad,
            'adicional' => $request->adicional,

            'tipo_personal' => $request->tipo_personal,
            //'codigo_puesto' => $request->codigo_puesto,

            'clues_nomina' => $request->clues_nomina,
            'clues_nomina_nombre' => $cluesNomina->nombre,
            'clues_nomina_municipio' => $cluesNomina->municipio,
            'clues_nomina_jurisdiccion' => $cluesNomina->clave_jurisdiccion,

            'clues_adscripcion' => $request->clues_adscripcion,
            'clues_adscripcion_nombre' => $cluesAdscripcion->nombre,
            'clues_adscripcion_municipio' => $cluesAdscripcion->municipio,
            'clues_adscripcion_jurisdiccion' => $cluesAdscripcion->clave_jurisdiccion,

            'area_trabajo' => $request->area_trabajo,
            'ocupacion' => $request->ocupacion,
            //'nomina_pago' => $request->nomina_pago,
            //'tipo_contrato' => $request->tipo_contrato,
            //'fecha_ingreso' => $request->fecha_ingreso,
            //'tipo_plaza' => $request->tipo_plaza,
            'institucion_puesto' => $request->institucion_puesto,
            //'vigencia' => $request->vigencia,
            //'vigencia_motivo' => $request->vigencia_motivo,
            //'temporalidad' => $request->temporalidad,
            //'licencia_maternidad' => $request->licencia_maternidad,
            //'seguro_salud' => $request->seguro_salud,

        ]);

        $usuario = Auth::user();

        // Guaradmos la bitacora
        $bitacora = new ProfesionalBitacora();

        $bitacora->id_capturista = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion = "ACTUALIZACION DEL MODULO PUESTO";
        $bitacora->id_profesional = $request->id_profesional;

        $bitacora->save();

         // Retornar o redirigir a donde lo necesites, por ejemplo:
         return redirect()->route('profesionalShow',$request->id_profesional)->with('successUpdatePuesto', 'Registro actualizado correctamente.');
    }
}
