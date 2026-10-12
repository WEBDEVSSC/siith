<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalExtraer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemSettingsController extends Controller
{
    //
    public function settingsShow()
    {
        return view('settings.show');
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
