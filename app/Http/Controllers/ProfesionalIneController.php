<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;

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
}
