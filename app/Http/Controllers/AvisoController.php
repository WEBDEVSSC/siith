<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvisoController extends Controller
{
    //
    public function declaracionPatrimonial()
    {
        return view('anuncios.index');
    }
}
