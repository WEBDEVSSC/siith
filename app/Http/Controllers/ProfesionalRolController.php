<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class ProfesionalRolController extends Controller
{
    // INDEX
    public function indexRol()
    {
        // Cargamos los roles registrados
        $roles = Role::all();

        // Regresamos a la vista con el arreglo
        return view('settings.rol.index', compact('roles'));
    }

    // NUEVO REGISTRO

    public function createRol()
    {
        return view('settings.rol.create');
    }
}
