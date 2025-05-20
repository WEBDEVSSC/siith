<?php

namespace App\Http\Controllers;

use App\Imports\subirLayoutNomina;
use App\Models\ProfesionalFirmaNomina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProfesionalFirmaNominaController extends Controller
{
    //
    public function firmaIndex()
    {
        $profesionalesFirmasNominas = ProfesionalFirmaNomina::where('status',0)->get();
        
        return view('firma-nomina.index', compact('profesionalesFirmasNominas'));
    }

    public function firmaCreate($token)
    {
        $profesionalFirmaNomina = ProfesionalFirmaNomina::where('token', $token)->first();
        
        return view('firma-nomina.create', compact('profesionalFirmaNomina'));
    }
    
    public function firmaStore(Request $request)
    {
        $request->validate([
            'profesionalFirmaNomina' => 'required',
            'firma' => 'required',
        ]);

        //dd($request->profesionalFirmaNomina);

        // Guardamos la imagen en la ruta

        $image = $request->input('firma'); // data:image/png;base64,...
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'firma_' . time() . '.png';

        Storage::disk('public')->put("firmas/{$imageName}", base64_decode($image));

        // Actualizamos el registro

        $profesionalFirmaNomina = ProfesionalFirmaNomina::findOrFail($request->profesionalFirmaNomina);

        $profesionalFirmaNomina -> update([
            'firma'=> "firmas/{$imageName}",
            'status' => 1,
        ]);

        // Aquí podrías guardar el nombre en la BD, asociarlo a un usuario, etc.

        //return back()->with('success', 'Firma guardada correctamente.');

        return redirect()->route('firmaIndex')->with('success', 'Registro actualizado correctamente.');
    }

    public function subirLayout(Request $request)
    {
        $request->validate([
                'archivo' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new subirLayoutNomina, $request->file('archivo'));

        return back()->with('success', 'Archivo importado correctamente.');
    }
    
}
