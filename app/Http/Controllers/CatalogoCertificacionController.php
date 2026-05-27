<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use App\Models\ProfesionalCertificacion;
use Illuminate\Http\Request;

class CatalogoCertificacionController extends Controller
{
    //
    public function indexCertificaciones()
    {
        $certificaciones = Certificacion::all();

        return view('settings.certificacion.index', compact('certificaciones'));
    }

    public function createCertificaciones()
    {
        return view('settings.certificacion.create');
    }

    public function storeCertificaciones(Request $request)
    {
        $request->validate([
            'certificacion' => 'required|string|max:100',
        ], [
            'certificacion.required' => 'El campo certificación es obligatorio.',
            'certificacion.string' => 'El campo certificación debe ser un texto válido.',
            'certificacion.max' => 'El campo certificación no debe exceder los 100 caracteres.',
        ]);

        $certificacion = new Certificacion();

        $certificacion->certificacion = $request->certificacion;

        $certificacion->save();

        return redirect()->route('indexCertificaciones')->with('success', 'Registro realizado correctamente');
    }

        public function editCertificaciones($id)
        {
            $certificacion = Certificacion::findOrFail($id);
    
            return view('settings.certificacion.edit', compact('certificacion'));
        }

        public function updateCertificaciones(Request $request, $id)
        {        
            $request->validate([
                'certificacion' => 'required|string|max:100',
            ], [
                'certificacion.required' => 'El campo certificación es obligatorio.',
                'certificacion.string' => 'El campo certificación debe ser un texto válido.',
                'certificacion.max' => 'El campo certificación no debe exceder los 100 caracteres.',
            ]);
    
            $certificacion = Certificacion::findOrFail($id);
    
            $certificacion->certificacion = $request->certificacion;
    
            $certificacion->save();

            // Buscamos los profesionales asociados a esta certificación
            $certificaciones = ProfesionalCertificacion::where('certificacion_id', $id)->get();

            foreach ($certificaciones as $profesionalCertificacion) 
            {
                $profesionalCertificacion->certificacion_label = $certificacion->certificacion;
                $profesionalCertificacion->save();
            }

            return redirect()->route('indexCertificaciones')->with('success', 'Registro actualizado correctamente');
        }

        public function deleteCertificaciones($id)
        {
            $certificacion = Certificacion::findOrFail($id);
    
            $certificacion->delete();

            // Buscamos los profesionales asociados a esta certificación
            $certificaciones = ProfesionalCertificacion::where('certificacion_id', $id)->get();

            foreach ($certificaciones as $profesionalCertificacion) 
            {
                $profesionalCertificacion->certificacion_id = NULL;
                $profesionalCertificacion->certificacion_label = NULL;
                $profesionalCertificacion->save();
            }
    
            return redirect()->route('indexCertificaciones')->with('success', 'Registro eliminado correctamente');
        }
}
