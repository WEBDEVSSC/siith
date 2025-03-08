<?php

use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ProfesionalCredencializacionController;
use App\Http\Controllers\ProfesionalHorarioController;
use App\Http\Controllers\ProfesionalPuestoController;
use App\Models\Profesional;
use App\Models\VigenciaMotivo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * 
 * 
 * PROFESIONALES MODULO
 * 
 * 
 */

// Ruta para mostrar el formulario para buscar por CURP
Route::get('admin/profesionales/buscarCurp', [ProfesionalController::class,'buscarCurp'])->name('buscarCurp');

// Ruta para mostrar los registros
Route::post('admin/profesionales/mostrarCurp', [ProfesionalController::class,'mostrarCurp'])->name('mostrarCurp');

 // Ruta para mostrar el formulario de datos generales
Route::get('admin/profesionales/datosGenerales/{curp}', [ProfesionalController::class, 'datosGenerales'])->name('datosGenerales');

// Ruta para guardar los datos generales
Route::post('admin/profesionales/datosGeneralesStore',[ProfesionalController::class, 'datosGeneralesStore'])->name('datosGeneralesStore');

// Ruta para ver los registros
Route::get('admin/profesionales/profesionalIndex',[ProfesionalController::class, 'profesionalIndex'])->name('profesionalIndex');

// Ruta para mostrar el formulario de edicion
Route::get('admin/profesionales/profesionalEdit/{id}', [ProfesionalController::class, 'profesionalEdit'])->name('profesionalEdit');

// Ruta para actualizar el registro
Route::put('admin/profesionales/profesionalUpdate/{id}', [ProfesionalController::class, 'profesionalUpdate'])->name('profesionalUpdate');

// Ruta para mostrar el perfil del trabajador
Route::get('admin/profesionales/profesionalShow/{id}', [ProfesionalController::class, 'profesionalShow'])->name('profesionalShow');

/**
 * 
 * 
 * PUESTO MODULO
 * 
 * 
 */

//Ruta para mostrar el formulario de creacion
Route::get('admin/profesionales/puesto/createPuesto/{id}',[ProfesionalPuestoController::class,'createPuesto'])->name('createPuesto');

// Ruta para almacenar los datos
Route::post('admin/profesionales/puesto/storePuesto',[ProfesionalPuestoController::class,'storePuesto'])->name('storePuesto');

// Ruta para mostrar el formulario de edicicon
Route::get('admin/profesionales/puesto/editPuesto/{id}', [ProfesionalPuestoController::class, 'editPuesto'])->name('editPuesto');

// Ruta para editar los datos
Route::put('admin/profesionales/puesto/updatePuesto/{id}', [ProfesionalPuestoController::class, 'updatePuesto'])->name('updatePuesto');

// Ruta dinamica para mostrar los motivos de vigencia
Route::get('/get-motivos/{id}', function ($id) { return response()->json(VigenciaMotivo::where('id_vigencia', $id)->get()); });

 /**
 * 
 * 
 * CREDENCIALIZACION MODULO
 * 
 * 
 */

 // Ruta para mostrar el formulario
 Route::get('admin/profesionales/credencializacion/createCredencializacion/{id}',[ProfesionalCredencializacionController::class,'createCredencializacion'])->name('createCredencializacion');

 // Ruta para guardar los datos
 Route::post('admin/profesionales/credencializacion/storeCredencializacion', [ProfesionalCredencializacionController::class,'storeCredencializacion'])->name('storeCredencializacion');

 // Ruta para mostrar el form de editar la fotografia
 Route::get('admin/profesionales/credencializacion/editCredencializacion/{id}', [ProfesionalCredencializacionController::class, 'editCredencializacion'])->name('editCredencializacion');

 // Ruta para actualizar el registro
 Route::put('admin/profesionales/credencializacion/updateCredencializacion/{id}', [ProfesionalCredencializacionController::class, 'updateCredencializacion'])->name('updateCredencializacion');

 // Ruta para mostrar la imagen al estar en la carpeta private
 Route::get('/foto/{filename}', function ($filename) {
    $path = storage_path('app/private/credencializacion/' . $filename);

    // Verificar si el archivo existe
    if (file_exists($path)) {
        return response()->file($path);
    }

    return abort(404); // Si el archivo no existe, devuelve un error 404
});

/**
 * 
 * 
 * HORARIO MODULO
 * 
 * 
 */
Route::get('admin/profesionales/horario/createHorario/{id}',[ProfesionalHorarioController::class,'createHorario'])->name('createHorario');

Route::post('admin/profesionales/horario/storeHorario', [ProfesionalHorarioController::class, 'storeHorario'])->name('storeHorario');

Route::get('admin/profesionales/horario/editHorario/{id}', [ProfesionalHorarioController::class,'editHorario'])->name('editHorario');

Route::put('admin/profesionales/horario/updateHorario/{id}', [ProfesionalHorarioController::class, 'updateHorario'])->name('updateHorario');

Route::get('export-clues', [ProfesionalController::class, 'export'])->name('profesionalExport');