<?php

namespace App\Http\Controllers;

use App\Models\CatCodigoPostal;
use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalesDireccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalDireccionController extends Controller
{
    //

    public function createDireccion($id)
    {
        $profesional = Profesional::findOrFail($id);
    
        $codigosPostales = CatCodigoPostal::all();

        return view('direccion.create', compact('profesional','codigosPostales'));
    }

    public function storeDireccion(Request $request,$id)
    {
        $request->validate([
            'calle' => 'required|max:120|string',
            'numero_interior' => 'nullable|max:120|string',
            'numero_exterior' => 'required|max:120|string',
            'codigo_postal' => 'required|max:120|string',
        ],[
            'calle.required'           => 'La calle es obligatoria.',
            'calle.string'             => 'La calle debe ser un texto válido.',
            'calle.max'                => 'La calle no debe exceder los 120 caracteres.',

            'numero_interior.required' => 'El número interior es obligatorio.',
            'numero_interior.string'   => 'El número interior debe ser un texto válido.',
            'numero_interior.max'      => 'El número interior no debe exceder los 120 caracteres.',

            'numero_exterior.required' => 'El número exterior es obligatorio.',
            'numero_exterior.string'   => 'El número exterior debe ser un texto válido.',
            'numero_exterior.max'      => 'El número exterior no debe exceder los 120 caracteres.',

            'codigo_postal.required'   => 'El código postal es obligatorio.',
            'codigo_postal.string'     => 'El código postal debe ser un texto válido.',
            'codigo_postal.max'        => 'El código postal no debe exceder los 120 caracteres.',
        ]);

        $codigoPostal = CatCodigoPostal::findOrFail($request->codigo_postal);

        
        $direccion = new ProfesionalesDireccion();

        $direccion->id_profesional = $id;
        $direccion->calle = $request->calle;
        $direccion->numero_exterior = $request->numero_exterior;
        $direccion->numero_interior = $request->numero_interior;
        $direccion->id_codigo_postal = $request->codigo_postal;
        $direccion->codigo_postal = $codigoPostal->codigo_postal;
        $direccion->colonia = $codigoPostal->colonia;
        $direccion->municipio = $codigoPostal->municipio;
        $direccion->estado = $codigoPostal->ciudad;
        $direccion->mdl_direccion = 1;

        $direccion->save();

        // Bitácora
        $usuario = Auth::user();

        ProfesionalBitacora::create([
            'id_capturista' => $usuario->id,
            'capturista_label' => $usuario->responsable,
            'accion' => "REGISTRO EN MODULO DIRECCION",
            'id_profesional' => $id,
        ]);

        return redirect()->route('profesionalShow', $id)->with('success', 'Registro realizado correctamente.');
    }
}
