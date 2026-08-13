<?php

namespace App\Http\Controllers;

use App\Models\Ocupacion;
use Illuminate\Http\Request;

class CatalogoOcupacionController extends Controller
{
    //
    public function indexOcupaciones()
    {
        $ocupaciones = Ocupacion::all();
    
        return view('settings.ocupaciones.index', compact('ocupaciones'));
    }
}
