<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    
    public function indexUsuario()
    {
        // Consultamos todos los usuarios
        $usuarios = User::all();

        // Regresamos la vista
        return view('user.index', compact('usuarios'));
    }

    //
    public function createUsuario()
    {
        // Consultamos todas las unidades
        $clues = Clue::all();

        // Consultamos los valores del SELECT de ROL
        $roles = Role::all();
        
        // Regresamos la vista
        return view('user.create', compact('clues', 'roles'));
    }

    public function storeUsuario(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string',
            'clue_id'=>'required|string',
            'rol'=>'required|string',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'clue_id.required' => 'Debe seleccionar una unidad.',
            'clue_id.string' => 'El identificador de la unidad debe ser una cadena de texto.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.string' => 'El rol debe ser una cadena de texto.',
        ]);

        // Codificamos la contraseña
        $hashedPassword = Hash::make($request->password);

        // Consultamos los datos del CLUES
        $clues = Clue::where('id',$request->clue_id)->first();

        // Consultamos los datos del rol
        $rol = Role::findOrFail($request->rol);

        // Creamos el objeto
        $usuario = new User();

        // Asignamos los valores
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $hashedPassword;
        $usuario->id_unidad = $request->clue_id;
        $usuario->clues_unidad = $clues->clues;
        $usuario->nombre_unidad = $clues->nombre;
        $usuario->role = $rol->rol;

        // Guardamos el registro
        $usuario -> save();

        // Retornamos la vista
        return redirect()->route('indexUsuario')->with('success', 'Usuario registrado correctamente');

    }
}
