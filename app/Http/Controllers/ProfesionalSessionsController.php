<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class ProfesionalSessionsController extends Controller
{
    //
    public function sesionesActivas()
    {
        $sesionesActivas = Session::with('user')->get();

        return view('settings.sessions.sesiones-activas', compact('sesionesActivas'));
    }

    public function sesionesBitacora()
    {
        $sesionesBitacoras = UserLogin::with('user')->orderBy('logged_in_at', 'desc')->get();

        return view('settings.sessions.bitacora-sesiones', compact('sesionesBitacoras'));
    }
}
