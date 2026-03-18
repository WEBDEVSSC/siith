<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalBitacoraCartera;
use Illuminate\Http\Request;

class BitacoraOcupacionController extends Controller
{
    //
    public function indexBitacoraOcupacion()
    {
       $bitacorasOcupacion = ProfesionalBitacoraCartera::orderBy('created_at', 'DESC')->get();

        return view('settings.bitacoras-ocupaciones.index', compact('bitacorasOcupacion'));
    }
}
