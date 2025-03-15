<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\ProfesionalSueldo;
use Illuminate\Http\Request;

class ProfesionalSueldoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function createSueldo($id)
    {
        // Localizamos el profesional
        $profesional = Profesional::findOrFail($id);

        // Regresamos la vista con el objeto
        return view('sueldo.create',compact('profesional'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSueldo(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'sueldo_mensual' => 'required|numeric|min:0',
            'compensaciones' => 'nullable|numeric|min:0',
            'prestaciones_mandato_ley' => 'nullable|numeric|min:0',
            'prestaciones_cgt' => 'nullable|numeric|min:0',
            'estimulos' => 'nullable|numeric|min:0',
        ],[
            'sueldo_mensual.required' => 'El campo Sueldo Mensual es obligatorio.',
            'sueldo_mensual.numeric' => 'El campo Sueldo Mensual debe ser un número.',
            'sueldo_mensual.min' => 'El campo Sueldo Mensual no puede ser negativo.',            
            'compensaciones.numeric' => 'El campo Compensaciones debe ser un número.',
            'compensaciones.min' => 'El campo Compensaciones no puede ser negativo.',
            'prestaciones_mandato_ley.numeric' => 'El campo Prestaciones Mandato Ley debe ser un número.',
            'prestaciones_mandato_ley.min' => 'El campo Prestaciones Mandato Ley no puede ser negativo.',
            'prestaciones_cgt.numeric' => 'El campo Prestaciones CGT debe ser un número.',
            'prestaciones_cgt.min' => 'El campo Prestaciones CGT no puede ser negativo.',
            'estimulos.numeric' => 'El campo Estímulos debe ser un número.',
            'estimulos.min' => 'El campo Estímulos no puede ser negativo.',
        ]);

        // Sumamos todos los valores
        $total = $request->sueldo_mensual + $request->compensaciones + $request->prestaciones_mandato_ley + $request->prestaciones_cgt + $request->estimulos;

        // Activamos el MDL
        $mdl_sueldo = 1;

        // Creamos el objeto
        $sueldo = new ProfesionalSueldo();

        // Asiganamos los valores
        $sueldo->id_profesional  = $request->id_profesional ;
        $sueldo->sueldo_mensual = $request->sueldo_mensual;
        $sueldo->compensaciones = $request->compensaciones;
        $sueldo->prestaciones_mandato_ley = $request->prestaciones_mandato_ley	;
        $sueldo->prestaciones_cgt = $request->prestaciones_cgt;
        $sueldo->estimulos = $request->estimulos;
        $sueldo->total = $total;
        $sueldo->mdl_sueldo = $mdl_sueldo;
        
        // Guardamos el registro
        $sueldo->save();

        // Retornar o redirigir a donde lo necesites, por ejemplo:
        return redirect()->route('profesionalIndex')->with('successSueldo', 'Registro realizado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSueldo($id)
    {
        // Buscamos el registro
        $sueldo = ProfesionalSueldo::where('id_profesional',$id)->firstOrFail();

        // Buscamos el profesional
        $profesional = Profesional::where('id',$sueldo->id_profesional)->firstOrFail();

        // Retornamos la vista con los objetos
        return view('sueldo.edit', compact('sueldo','profesional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSueldo(Request $request,  $id)
    {
        // Validamos los datos
        $request->validate([
            'sueldo_mensual' => 'required|numeric|min:0',
            'compensaciones' => 'nullable|numeric|min:0',
            'prestaciones_mandato_ley' => 'nullable|numeric|min:0',
            'prestaciones_cgt' => 'nullable|numeric|min:0',
            'estimulos' => 'nullable|numeric|min:0',
        ],[
            'sueldo_mensual.required' => 'El campo Sueldo Mensual es obligatorio.',
            'sueldo_mensual.numeric' => 'El campo Sueldo Mensual debe ser un número.',
            'sueldo_mensual.min' => 'El campo Sueldo Mensual no puede ser negativo.',            
            'compensaciones.numeric' => 'El campo Compensaciones debe ser un número.',
            'compensaciones.min' => 'El campo Compensaciones no puede ser negativo.',
            'prestaciones_mandato_ley.numeric' => 'El campo Prestaciones Mandato Ley debe ser un número.',
            'prestaciones_mandato_ley.min' => 'El campo Prestaciones Mandato Ley no puede ser negativo.',
            'prestaciones_cgt.numeric' => 'El campo Prestaciones CGT debe ser un número.',
            'prestaciones_cgt.min' => 'El campo Prestaciones CGT no puede ser negativo.',
            'estimulos.numeric' => 'El campo Estímulos debe ser un número.',
            'estimulos.min' => 'El campo Estímulos no puede ser negativo.',
        ]);

        // Sumamos todos los valores
        $total = $request->sueldo_mensual + $request->compensaciones + $request->prestaciones_mandato_ley + $request->prestaciones_cgt + $request->estimulos;

        // Buscamos el registro a editar
        $sueldo = ProfesionalSueldo::findOrFail($id);

        // Asignamos los valores
         $sueldo->update([
            'sueldo_mensual' => $request->sueldo_mensual,
            'compensaciones' => $request->compensaciones,
            'prestaciones_mandato_ley' => $request->prestaciones_mandato_ley,
            'prestaciones_cgt' => $request->prestaciones_cgt,
            'estimulos' => $request->estimulos,
            'total' => $total,
        ]);

        // Regresamos a la vista
        return redirect()->route('profesionalIndex')->with('updateSueldo', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
