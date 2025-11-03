<?php

namespace App\Http\Controllers;

use App\Models\NominaPago;
use Illuminate\Http\Request;

class CatalogoNominaDePagoController extends Controller
{
    // INDEX
    public function nominaPagoIndex()
    {
        // Cargamos los roles registrados
        $nominasDePago = NominaPago::with('tiposContrato')->get();

        // Regresamos a la vista con el arreglo
        return view('settings.nomina-pago.index', compact('nominasDePago'));
    }
}
