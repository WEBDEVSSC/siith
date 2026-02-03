<?php

namespace App\Http\Controllers;

use App\Models\CatCodigoPostal;
use App\Models\Entidad;
use App\Models\Municipio;
use Illuminate\Http\Request;

class CatalogoCodigoPostalController extends Controller
{
    //
    public function municipios($entidadId)
    {
        return Municipio::where('relacion', $entidadId)
            ->orderBy('nombre')
            ->get();
    }

    public function indexCodigoPostal()
    {
        $codigosPostales = CatCodigoPostal::all();

        return view('settings.codigo-postal.index', compact('codigosPostales'));
    }

    public function createCodigoPostal()
    {
        $entidades = Entidad::orderBy('nombre')->get();
    
        return view('settings.codigo-postal.create', compact('entidades'));
    }

    public function storeCodigoPostal(Request $request)
    {
        $request->validate([
            'codigo_postal' => 'required|string|max:10',
            'colonia'       => 'required|string|max:50',
            'entidad'     => 'required|string|max:50',
            'municipio'        => 'required|string|max:50',
        ],[
            'codigo_postal.required' => 'El código postal es obligatorio.',
            'codigo_postal.string'   => 'El código postal debe ser texto.',
            'codigo_postal.max'      => 'El código postal no debe exceder los 10 caracteres.',

            'colonia.required' => 'La colonia es obligatoria.',
            'colonia.string'   => 'La colonia debe ser texto.',
            'colonia.max'      => 'La colonia no debe exceder los 50 caracteres.',

            'entidad.required' => 'La entidad federativa es obligatoria.',
            'entidad.string'   => 'La entidad debe ser texto.',
            'entidad.max'      => 'La entidad no debe exceder los 50 caracteres.',

            'municipio.required' => 'El municipio es obligatorio.',
            'municipio.string'   => 'El municipio debe ser texto.',
            'municipio.max'      => 'El municipio no debe exceder los 50 caracteres.',
        ]);
 
        $entidad = Entidad::findOrFail($request->entidad);

        $municipio = Municipio::findOrFail($request->municipio);

        $codigoPostal = new CatCodigoPostal();

        $codigoPostal->codigo_postal = $request->codigo_postal; 
        $codigoPostal->colonia = $request->colonia; 
        $codigoPostal->municipio = $municipio->nombre; 
        $codigoPostal->ciudad = $entidad->nombre; 

        $codigoPostal->save();

        return redirect()->route('indexCodigoPostal')->with('success', 'Código Postal Registrado Correctamente');
    }
}
