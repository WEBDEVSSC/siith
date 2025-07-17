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
            'responsable'=>'string',
            'contacto'=>'email',
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
        $usuario->jurisdiccion_unidad = $clues->clave_jurisdiccion;
        $usuario->role = $rol->rol;
        $usuario->responsable = $request->responsable;
        $usuario->contacto = $request->contacto;


        // Guardamos el registro
        $usuario -> save();

        // Retornamos la vista
        return redirect()->route('indexUsuario')->with('success', 'Usuario registrado correctamente');

    }

    public function editUsuario($id)
    {
        // Consultamos al usuario
        $usuario = User::findOrFail($id);
        
        // Consultamos todas las unidades
        $clues = Clue::all();

        // Consultamos los valores del SELECT de ROL
        $roles = Role::all();
        
        // Regresamos la vista
        return view('user.edit', compact('usuario', 'clues', 'roles'));

    }

    public function updateUsuario(Request $request, $id)
    {                
        // Validamos los datos
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'nullable|string',
            'clue_id'=>'required|string',
            'rol'=>'required|string',
            'responsable'=>'string',
            'contacto'=>'email',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'clue_id.required' => 'Debe seleccionar una unidad.',
            'clue_id.string' => 'El identificador de la unidad debe ser una cadena de texto.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.string' => 'El rol debe ser una cadena de texto.',
            'responsable.required' => 'El responsable es obligatorio.',
            'contacto.required' => 'El contacto es obligatorio.',
        ]);

        // Consulta datos de unidad
        $unidad = Clue::findOrFail($request->clue_id);

         // Buscar el usuario por ID
        $usuario = User::findOrFail($id);

        // Actualizar campos
        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($request->filled('password')) 
        {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->id_unidad = $unidad->id;
        $usuario->clues_unidad = $unidad->clues;
        $usuario->nombre_unidad = $unidad->nombre;
        $usuario->jurisdiccion_unidad = $unidad->clave_jurisdiccion;
        $usuario->role = $request->rol;
        $usuario->responsable = $request->responsable;
        $usuario->contacto = $request->contacto;

        $usuario->save();

        // Retornamos la vista
        return redirect()->route('indexUsuario')->with('update', 'Usuario actualizado correctamente');
    }

    public function deleteUsuario($id)
    {
        // Buscamos el usuario
        $usuario = User::findOrFail($id); 

        // Lo eliminamos haciendo SOFT DELETE
        $usuario->delete(); 

        // Regresamos al index con el mensaje
        return redirect()->route('indexUsuario')->with('delete', 'Usuario eliminado correctamente');

    }

    public function showUsuario($id)
    {
        // Consultamos al usuario
        $usuario = User::findOrFail($id);

        // Consulta ROL
        $rol = Role::where('rol',$usuario->role)->first();

        // Pasamos la vista los datos
        return view('user.show', compact('usuario','rol'));
    }
}
