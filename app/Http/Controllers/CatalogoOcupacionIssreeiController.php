<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionIssreei;
use Illuminate\Http\Request;

class CatalogoOcupacionIssreeiController extends Controller
{
    //
     //
    public function ocupacionIssreeiIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionIssreei::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.issreei.issreei-index', compact('ocupaciones'));
    }
}
