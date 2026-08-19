<?php

namespace App\Http\Controllers;

use App\Models\AreaTrabajo;
use Illuminate\Http\Request;

class CatalogoAreaDeTrabajoController extends Controller
{
    //
    public function indexAreaDeTrabajo()
    {
        $areasTrabajo = AreaTrabajo::all();

        return view('settings.areas-trabajo.index', compact('areasTrabajo'));
    }
}
