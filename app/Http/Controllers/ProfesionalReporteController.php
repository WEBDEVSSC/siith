<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesionalReporteController extends Controller
{
    //
    public function reporteIndex()
    {
        return view('reporte.index');
    }
}
