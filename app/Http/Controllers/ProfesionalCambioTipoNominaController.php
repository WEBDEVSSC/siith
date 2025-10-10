<?php

namespace App\Http\Controllers;

use App\Models\CodigoPuesto;
use App\Models\NominaPago;
use App\Models\Profesional;
use App\Models\ProfesionalCambioTipoNomina;
use App\Models\ProfesionalPuesto;
use App\Models\TipoContrato;
use App\Models\TipoPlaza;
use Illuminate\Http\Request;

class ProfesionalCambioTipoNominaController extends Controller
{
   public function getContratosPorNomina($nomina)
    {
        $contratos = TipoContrato::where('nomina_pago', $nomina)
        ->select('tipo_contrato')
        ->orderBy('tipo_contrato')
        ->get();

        return response()->json($contratos);
    }
    
    //
    public function createCambioTipoNomina($id)
    {
        // Consultar los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de nominas de pago
        $nominasPago = NominaPago::orderBy('nomina','asc')->get();

        // Llenamos el select de TIPO DE CONTRATO
        $tiposContrato = TipoContrato::orderBy('tipo_contrato','asc')->get();

        // Llenamos el select de TIPO DE PLAZA
        $tiposPlaza = TipoPlaza::orderBy('tipo_plaza','asc')->get();

        // Llenamos el select de CODIGO DE PUESTO
        $codigosPuesto = CodigoPuesto::orderBy('codigo_puesto', 'asc')->get();

        // Llenamos la tabla
        $cambiosTipoNomina = ProfesionalCambioTipoNomina::where('id_profesional',$id)
                        ->orderBy('created_at','desc')
                        ->get();

        

        // Regresamos al form con el objeto
        return view('tipo-nomina.create', compact(
            'profesional',
            'id',
            'nominasPago',
            'tiposContrato',
            'tiposPlaza',
            'codigosPuesto',
            'cambiosTipoNomina'
        ));
    }

    public function storeCambioTipoNomina(Request $request)
    {
        // Validamos los datos
        $validated = $request->validate([
            'id_profesional' => 'required',
            'codigo_puesto' => 'required',
            'nomina_pago' => 'required',
            'tipo_contrato' => 'required',
            'fecha_ingreso' => 'required|date_format:Y-m-d',
            'tipo_plaza' => 'required',
            'seguro_salud' => 'required',
        ], [
            'id_profesional.required' => 'El ID del profesional es obligatorio.',
            'codigo_puesto.required' => 'El Código de Puesto es obligatorio.',
            'nomina_pago.required' => 'El campo Nómina de Pago es obligatorio.',
            'tipo_contrato.required' => 'El Tipo de Contrato es obligatorio.',
            'fecha_ingreso.required' => 'El campo Fecha de Ingreso es obligatorio.',
            'tipo_plaza.required' => 'El Tipo de Plaza es obligatorio.',
            'seguro_salud.required' => 'El campo Seguro de Salud es obligatorio.',
            'fecha_ingreso.date_format' => 'La fecha debe tener el formato DD-MM-AAAA.',
        ]);

        // Consulta la ultima nomina
        $ultimaNomina = ProfesionalCambioTipoNomina::where('id_profesional', $request->id_profesional)
                    ->latest()
                    ->first();

        // La fecha de ingreso debe ser mayor a la fecha de ingreso de la ultima nomina
        if($ultimaNomina?->fecha_ingreso > $request->fecha_ingreso)
        {
            return redirect()->back()
                            ->with('error', 'La fecha de ingreso debe ser mayor a la fecha de ingreso del último cambio de nómina')
                            ->withInput();
        }     

        // Consultamos los datos del Codigo de Puesto
        $codigoDePuesto = CodigoPuesto::findOrFail($request->codigo_puesto);

        // Consultamos el tipo de nomina
        $tipoNomina = NominaPago::findOrFail($request->nomina_pago);

        $cambioTipoNomina = new ProfesionalCambioTipoNomina();

        $cambioTipoNomina->id_profesional = $request->id_profesional; 
        $cambioTipoNomina->id_nomina_pago = $request->nomina_pago; 
        $cambioTipoNomina->nomina_pago = $tipoNomina->nomina; 
        $cambioTipoNomina->tipo_contrato = $request->tipo_contrato; 
        $cambioTipoNomina->tipo_plaza = $request->tipo_plaza; 
        $cambioTipoNomina->seguro_salud = $request->seguro_salud; 
        $cambioTipoNomina->codigo_puesto = $codigoDePuesto->codigo; 
        $cambioTipoNomina->codigo_puesto_id = $request->codigo_puesto; 
        $cambioTipoNomina->codigo_puesto_label = $codigoDePuesto->codigo_puesto; 
        $cambioTipoNomina->fecha_ingreso = $request->fecha_ingreso; 

        $cambioTipoNomina->save();

        // Actualizamos el modulo de PUESTO

        $puesto = ProfesionalPuesto::where('id_profesional',$request->id_profesional)->first();

        $puesto->nomina_pago = $request->nomina_pago;
        $puesto->tipo_contrato = $request->tipo_contrato;
        $puesto->tipo_plaza = $request->tipo_plaza;
        $puesto->seguro_salud = $request->seguro_salud;

        $puesto->codigo_puesto = $codigoDePuesto->codigo_puesto; 
        $puesto->codigo_puesto_id = $request->codigo_puesto; 
        $puesto->codigo = $codigoDePuesto->codigo; 
        $puesto->grupo = $codigoDePuesto->grupo; 
       
        //$puesto->codigo_puesto_label = $codigoDePuesto->codigo_puesto; 

        $puesto->save();

        return redirect()->route('profesionalShow', $request->id_profesional)->with('successCambioTipoNomina', 'Cambio de Tipo de Nómina registrada correctamente.');

    }
}
