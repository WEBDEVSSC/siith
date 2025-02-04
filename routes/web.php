<?php

use App\Http\Controllers\ProfesionalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
