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

    // GUARDAR DATOS DE NUEVO REGISTRO

    public function storeRol(Request $request)
    {
        $request->validate([
            'label_rol' => 'required|max:20',
            'rol' => 'required|max:20',
        ], [
            'label_rol.required' => 'El nombre del rol es obligatorio.',
            'label_rol.max' => 'El nombre del rol no puede tener más de 20 caracteres.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.max' => 'El rol no puede tener más de 20 caracteres.',
        ]);

        $rol = new Role();

        $rol->label_rol = $request->label_rol;
        $rol->rol = $request->rol;

        $rol->save();

        return redirect()->route('indexRol')->with('success', 'Registro realizado correctamente.');
    }

    // FORMULARIO PARA EDITAR REGISTRO

    public function editRol($id)
    {
        // Consultamos el registro
        $rol = Role::findOrFail($id);
        
        // Regresamos a la vista con el objeto
        return view('settings.rol.edit', compact('rol'));
    }

    // FORMULARIO PARA ACTUALIZAR LOS DATOS

    public function updateRol(Request $request, $id)
    {
        $request->validate([
            'label_rol' => 'required|max:20',
            'rol' => 'required|max:20',
        ], [
            'label_rol.required' => 'El nombre del rol es obligatorio.',
            'label_rol.max' => 'El nombre del rol no puede tener más de 20 caracteres.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.max' => 'El rol no puede tener más de 20 caracteres.',
        ]);

        // Buscamos el registro

        $rol = Role::findOrFail($id);

        $rol->label_rol = $request->label_rol;
        $rol->rol = $request->rol;

        $rol->save();

        return redirect()->route('indexRol')->with('update', 'Registro actualizado correctamente.');
    }

    // FUNCION PARA ELIMINAR EL REGISTRO

    public function deleteRol($id)
    {
        $rol = Role::findOrFail($id);

        $rol->delete();

        return redirect()->route('indexRol')->with('delete', 'Registro eliminado correctamente.');
    }
}
