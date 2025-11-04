<?php

namespace App\Http\Controllers;

use App\Models\NominaPago;
use App\Models\ProfesionalPuesto;
use App\Models\TipoContrato;
use Illuminate\Http\Request;

class CatalogoNominaDePagoController extends Controller
{
    // INDEX
    public function nominaPagoIndex()
    {
        // Cargamos los roles registrados
        $nominasDePago = NominaPago::with('tiposContrato')->get();

        // Regresamos a la vista con el arreglo
        return view('settings.nomina-pago.index', compact('nominasDePago'));
    }

    public function nominaPagoCreate()
    {
        // Regresamos a la vista con el arreglo
        return view('settings.nomina-pago.create');
    }

    public function nominaPagoStore(Request $request)
    {
        $request->validate([
            'nomina'=>'required|max:30',
        ],[
            'nomina.required' => 'El campo nómina es obligatorio.',
            'nomina.max' => 'El campo nómina no debe tener más de 30 caracteres.',
        ]);

        $nominaPago = new NominaPago();

        $nominaPago->nomina = $request->nomina;

        $nominaPago->save();

        return redirect()->route('nominaPagoIndex')->with('success', 'Nómina de Pago registrada correctamente.');
    }

    public function nominaPagoEdit($id)
    {
        $nominaPago = NominaPago::findOrFail($id);

        return view('settings.nomina-pago.edit', compact('nominaPago'));
    }

    public function nominaPagoUpdate(Request $request, $id)
    {
        // Validamos los datos        
        $request->validate([
            'nomina'=>'required|max:30',
        ],[
            'nomina.required' => 'El campo nómina es obligatorio.',
            'nomina.max' => 'El campo nómina no debe tener más de 30 caracteres.',
        ]);

        // Buscamos el registro a edit
        $nominaPago = NominaPago::findOrFail($id);

        // Guardamos el valor anterior
        $valorAnterior = $nominaPago->nomina;

        // Actualizamos el registro con el nuevo valor
        $nominaPago->nomina = $request->nomina;

        // Guardamos el registro
        $nominaPago->save();

        // Actualizamos todos los registros 
        $nominaPuesto = ProfesionalPuesto::where('nomina_pago', $valorAnterior)->update(['nomina_pago' => $request->nomina]);

        // Redirigimos a la vista
        return redirect()->route('nominaPagoIndex')->with('success', 'Nómina de Pago actualizada correctamente.');
    }

    public function nominaPagoDelete($id)
    {
        $tipoDeContrato = NominaPago::findOrFail($id);

        $tipoDeContrato->delete();

        return redirect()->route('nominaPagoIndex')->with('delete', 'Nómina de Pago eliminada correctamente.');
    }

    public function tipoDeContratoCreate($id)
    {
        // Consultamos el Tipo de Nomina
        $tipoDeNomina = NominaPago::findOrFail($id);

        // Consultamos los Tipos de Contrato relacionados
        $tiposDeContrato = TipoContrato::where('nomina_pago', $id)->get();
        
        // Regresamos a la vista con el arreglo
        return view('settings.nomina-pago.tipo-contrato', compact('tipoDeNomina','tiposDeContrato'));
    }

    public function tipoDeContratoStore(Request $request)
    {
        // Validamos los datos        
        $request->validate([
            'nomina_pago'=>'required|max:30',
            'tipo_contrato'=>'required|max:30',
        ],[
            'tipo_contrato.required' => 'El campo tipo contrato es obligatorio.',
            'nomina.max' => 'El campo tipo contrato no debe tener más de 30 caracteres.',
        ]);

        // Creamos el objeto
        $tipoDeContrato = new TipoContrato();

        // Asignamos los valores
        $tipoDeContrato->tipo_contrato = $request->tipo_contrato;
        $tipoDeContrato->nomina_pago = $request->nomina_pago;

        //Guardamos el registro
        $tipoDeContrato->save();

        // Redirigimos a la vista
        return redirect()->route('nominaPagoIndex')->with('success', 'Tipo de Contrato registrado correctamente.');
    }

    public function tipoDeContratoDelete($id)
    {
        $tipoDeContrato = TipoContrato::findOrFail($id);

        $tipoDeContrato->delete();

        return redirect()->route('nominaPagoIndex')->with('delete', 'Tipo de Contrato eliminado correctamente.');
    }
}
