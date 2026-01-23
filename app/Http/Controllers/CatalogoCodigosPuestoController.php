<?php

namespace App\Http\Controllers;

use App\Models\CodigoPuesto;
use App\Models\ProfesionalPuesto;
use Illuminate\Http\Request;

class CatalogoCodigosPuestoController extends Controller
{
    //
    public function indexCodigos()
    {
        $codigosPuesto = CodigoPuesto::all();

        return view('settings.codigo-puesto.index', compact('codigosPuesto'));
    }

    public function createCodigos()
    {
         return view('settings.codigo-puesto.create');
    }

    public function storeCodigos(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'puesto' => 'required',
            'rama' => 'required',
        ],[]);

        $codigoPuesto = new CodigoPuesto;

        $codigoPuesto->codigo_puesto = $request->puesto;
        $codigoPuesto->codigo = $request->codigo;
        $codigoPuesto->grupo = $request->rama;

        $codigoPuesto->save();

        return redirect()->route('indexCodigos')->with('success', 'Código de Puesto Registrado Correctamente');

    }

    public function editCodigos($id)
    {
        $codigoPuesto = CodigoPuesto::findOrFail($id);

        return view('settings.codigo-puesto.edit', compact('codigoPuesto'));
    }

    public function updateCodigos(Request $request, $id)
    {   
        $request->validate([
            'codigo' => 'required',
            'puesto' => 'required',
            'rama' => 'required',
        ],[]);

        // Buscamos el registro
        $codigoPuesto = CodigoPuesto::findOrFail($id);

        // Asignamos los valores
        $codigoPuesto->codigo = $request->codigo;
        $codigoPuesto->codigo_puesto = $request->puesto;
        $codigoPuesto->grupo = $request->rama;

        $codigoPuesto->save();

        // Buscamos y actualizamos todos los registros con ese codigo

        ProfesionalPuesto::where('codigo_puesto_id', $id)
            ->update([
                'codigo_puesto' => $request->puesto,
                'codigo'        => $request->codigo,
                'grupo'         => $request->rama,
            ]);

        return redirect()->route('indexCodigos')->with('success', 'Código de Puesto Actualizado Correctamente');
    }

    public function deleteCodigos($id)
    {
        $codigoPuesto = CodigoPuesto::findOrFail($id);

        $codigoPuesto->delete();

        return redirect()->route('indexCodigos')->with('delete', 'Código de Puesto Eliminada Correctamente.');
    }
}
