<?php

use App\Http\Controllers\ProfesionalAreaMedicaController;
use App\Http\Controllers\ProfesionalCertificacionController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ProfesionalCredencializacionController;
use App\Http\Controllers\ProfesionalGradoAcademicoController;
use App\Http\Controllers\ProfesionalHorarioController;
use App\Http\Controllers\ProfesionalOcupacionController;
use App\Http\Controllers\ProfesionalPuestoController;
use App\Http\Controllers\ProfesionalSueldoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*******************************************************************************************
 * 
 * 
 * BLOQUEAMOS RUTAS DE ADMINLTE3 AUTH
 * 
 * 
 ******************************************************************************************/

Auth::routes([
    'register' => false, // Desactiva el registro de nuevos usuarios
    'reset' => false, // Desactiva la recuperación de contraseña
    'verify' => false,   // Desactiva la verificación de email
]);

/*******************************************************************************************
 * 
 * 
 * PROTEGEMOS TODAS LAS RUTAS
 * 
 * 
 ******************************************************************************************/

Route::middleware(['auth'])->group(function () 
{

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

    // Ruta para generar el PDF
    Route::get('admin/profesionales/profesionalPDF/{id}', [ProfesionalController::class, 'profesionalPDF'])->name('profesionalPDF');

    // Ruta para el formlario de OCUPACION
    Route::get('admin/profesionales/profesionalOcupacionCreate/{id}',[ProfesionalController::class,'profesionalOcupacionCreate'])->name('profesionalOcupacionCreate');

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
    Route::get('/vigencias-motivos/{vigencia}', [ProfesionalPuestoController::class, 'getMotivos']);

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

    /**
     * 
     * 
     * SUELDO MODULO
     * 
     * 
     */

    Route::get('admin/profesionales/sueldo/createSueldo/{id}', [ProfesionalSueldoController::class,'createSueldo'])->name('createSueldo');

    Route::post('admin/profesionales/sueldo/storeSueldo', [ProfesionalSueldoController::class,'storeSueldo'])->name('storeSueldo');

    Route::get('admin/profesionales/sueldo/editSueldo/{id}', [ProfesionalSueldoController::class, 'editSueldo'])->name('editSueldo');

    Route::put('admin/profesionales/sueldo/updateSueldo/{id}', [ProfesionalSueldoController::class, 'updateSueldo'])->name('updateSueldo');

    
    /**
     * 
     * 
     * GRADO ACADEMICO MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/gradoAcademico/createGrado/{id}', [ProfesionalGradoAcademicoController::class,'createGrado'])->name('createGrado');

     Route::post('admin/profesionales/gradoAcademico/storeGrado', [ProfesionalGradoAcademicoController::class,'storeGrado'])->name('storeGrado');
 
     Route::get('admin/profesionales/gradoAcademico/editGrado/{id}', [ProfesionalGradoAcademicoController::class, 'editGrado'])->name('editGrado');
 
     Route::put('admin/profesionales/gradoAcademico/updateGrado/{id}', [ProfesionalGradoAcademicoController::class, 'updateGrado'])->name('updateGrado');

    // Ruta dinamica para mostrar
    Route::get('/titulos/{cve}', [ProfesionalGradoAcademicoController::class, 'getTitulos']);

    /**
     * 
     * 
     * AREA MEDICA MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/area-medica/createAreaMedica/{id}', [ProfesionalAreaMedicaController::class,'createAreaMedica'])->name('createAreaMedica');

     Route::post('admin/profesionales/area-medica/storeAreaMedica', [ProfesionalAreaMedicaController::class,'storeAreaMedica'])->name('storeAreaMedica');
 
     Route::get('admin/profesionales/area-medica/editAreaMedica/{id}', [ProfesionalAreaMedicaController::class, 'editAreaMedica'])->name('editAreaMedica');
 
     Route::put('admin/profesionales/area-medica/updateAreaMedica/{id}', [ProfesionalAreaMedicaController::class, 'updateAreaMedica'])->name('updateAreaMedica');

     /**
     * 
     * 
     * CERTIFICACIONES MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/certificaciones/createCertificacion/{id}', [ProfesionalCertificacionController::class,'createCertificacion'])->name('createCertificacion');

     Route::post('admin/profesionales/certificaciones/storeCertificacion', [ProfesionalCertificacionController::class,'storeCertificacion'])->name('storeCertificacion');
 
     Route::get('admin/profesionales/certificaciones/editCertificacion/{id}', [ProfesionalCertificacionController::class, 'editCertificacion'])->name('editCertificacion');
 
     Route::put('admin/profesionales/certificaciones/updateCertificacion/{id}', [ProfesionalCertificacionController::class, 'updateCertificacion'])->name('updateCertificacion');

     /**
     * 
     * 
     * CATALOGO DE OCUPACIONES MODULO
     * 
     * 
     */

     /** RUTAS PARA EL CATALOGO 1 - CENTROS DE SALUD URBANOS Y RURALES */

     Route::get('admin/profesionales/ocupaciones/createCentrosDeSalud/{id}', [ProfesionalOcupacionController::class, 'createCentrosDeSalud'])->name('createCentrosDeSalud');

     Route::post('admin/profesionales/ocupaciones/storeCentrosDeSalud', [ProfesionalOcupacionController::class, 'storeCentrosDeSalud'])->name('storeCentrosDeSalud');

     Route::get('admin/profesionales/ocupaciones/editCentrosDeSalud/{id}', [ProfesionalOcupacionController::class, 'editCentrosDeSalud'])->name('editCentrosDeSalud');

     Route::put('admin/profesionales/ocupaciones/updateCentrosDeSalud/{id}', [ProfesionalOcupacionController::class, 'updateCentrosDeSalud'])->name('updateCentrosDeSalud');

     /**RUTAS PARA EL CATALOGO 2 - HOSPITALES */

     Route::get('admin/profesionales/ocupaciones/createHospital/{id}', [ProfesionalOcupacionController::class, 'createHospital'])->name('createHospital');

     Route::post('admin/profesionales/ocupaciones/storeHospital', [ProfesionalOcupacionController::class, 'storeHospital'])->name('storeHospital');

     Route::get('admin/profesionales/ocupaciones/editHospital/{id}', [ProfesionalOcupacionController::class, 'editHospital'])->name('editHospital');

     Route::put('admin/profesionales/ocupaciones/updateHospital/{id}', [ProfesionalOcupacionController::class, 'updateHospital'])->name('updateHospital');

      /**RUTAS PARA EL CATALOGO 3 - OFICINAS JURISDICCIONALES */

      Route::get('admin/profesionales/ocupaciones/createOfJurisdiccional/{id}', [ProfesionalOcupacionController::class, 'createOfJurisdiccional'])->name('createOfJurisdiccional');

      Route::post('admin/profesionales/ocupaciones/storeOfJurisdiccional', [ProfesionalOcupacionController::class, 'storeOfJurisdiccional'])->name('storeOfJurisdiccional');
 
      Route::get('admin/profesionales/ocupaciones/editOfJurisdiccional/{id}', [ProfesionalOcupacionController::class, 'editOfJurisdiccional'])->name('editOfJurisdiccional');
 
      Route::put('admin/profesionales/ocupaciones/updateOfJurisdiccional/{id}', [ProfesionalOcupacionController::class, 'updateOfJurisdiccional'])->name('updateOfJurisdiccional');

    /**
     * 
     * 
     * MODULO DE REPORTES
     * 
     * 
     */
    
     // Ruta para el reporte de Excel
    Route::get('export-clues', [ProfesionalController::class, 'export'])->name('profesionalExport');

    // Ruta para el envio de correos
    Route::get('admin/profesionales/cumpleanos',[ProfesionalController::class,'enviarFelicitaciones'])->name('enviarFelicitaciones');

    /**
     * 
     * 
     * MODULOS ADMINISRATIVOS
     * USUARIOS
     * 
     * 
     */

     Route::get('admin/usuarios/indexUsuario', [UsuarioController::class,'indexUsuario'])->name('indexUsuario');

     Route::get('admin/usuarios/createUsuario', [UsuarioController::class,'createUsuario'])->name('createUsuario');

     Route::post('admin/usuarios/storeUsuario', [UsuarioController::class,'storeUsuario'])->name('storeUsuario');

});

