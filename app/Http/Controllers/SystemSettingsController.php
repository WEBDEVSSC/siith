<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalExtraer;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    //
    public function settingsShow()
    {
        return view('settings.show');
    }

    public function datosExtraidos()
    {
        $datosExtraidos = ProfesionalExtraer::all();

        return view('settings.datos-extraidos.index', compact('datosExtraidos'));
    }
}
