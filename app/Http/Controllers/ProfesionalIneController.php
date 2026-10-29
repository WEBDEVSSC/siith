<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\ProfesionalExtraer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfesionalIneController extends Controller
{
    //

    public function createIne($id)
    {
        $profesional = Profesional::findOrFail($id);

        return view('ine.create', compact('profesional'));
    }

    public function storeIne(Request $request, $id)
    {
        $profesional = Profesional::findOrFail($id);

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'ine' => 'required|string|max:255',
            'comprobante_domicilio' => 'required|string|max:255',
            'rfc' => 'required|string|max:13',
            'curp' => 'required|string|max:18',
            'dl' => 'nullable|string|max:10',
            'df' => 'nullable|string|max:10',
        ]);

        // Guardar los datos en la base de datos
        $profesional->ine()->create($validatedData);

        return redirect()->route('profesional.show', $profesional->id)
                         ->with('success', 'Datos de INE registrados correctamente.');
    }

    public function datosExtraidos()
    {
        $datosExtraidos = ProfesionalExtraer::leftJoin('profesionales_datos_generales', function($join) {
                $join->on(DB::raw('SUBSTRING(profesionales_extraer.archivo, 1, 18)'), '=', 'profesionales_datos_generales.curp');
            })
            ->select(
                'profesionales_extraer.*', 
                'profesionales_datos_generales.nombre', 
                'profesionales_datos_generales.apellido_paterno', 
                'profesionales_datos_generales.apellido_materno'
            )
            ->get();

        return view('settings.datos-extraidos.index', compact('datosExtraidos'));
    }
}
