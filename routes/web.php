<?php

use App\Http\Controllers\CatalogoCentroDeSaludUrbanoYRuralController;
use App\Http\Controllers\CatalogoOcupacionCentroDeSaludUrbanoYRuralController;
use App\Http\Controllers\CatalogoOcupacionCriCreeController;
use App\Http\Controllers\CatalogoOcupacionHospitalController;
use App\Http\Controllers\CatalogoOcupacionOficinaCentralController;
use App\Http\Controllers\CatalogoOcupacionOfJurisdiccionalController;
use App\Http\Controllers\CatalogoOcupacionSamuCrumController;
use App\Http\Controllers\ProfesionalAreaMedicaController;
use App\Http\Controllers\ProfesionalCambioDeUnidadController;
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
     * MI JURISDICCION
     * 
     * 
     */

     Route::get('admin/profesionales/miJurisdiccion', [ProfesionalController::class, 'miJurisdiccion'])->name('miJurisdiccion');

     Route::post('admin/profesionales/miJurisdiccionShow', [ProfesionalController::class, 'miJurisdiccionShow'])->name('miJurisdiccionShow');

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
     * CAMBIO DE UNIDAD
     * 
     * 
     */

     Route::get('admin/profesionales/cambioDeUnidad/findProfesional', [ProfesionalCambioDeUnidadController::class,'findProfesional'])->name('findProfesional');

     Route::post('admin/profesionales/cambioDeUnidad/showProfesional', [ProfesionalCambioDeUnidadController::class, 'showProfesional'])->name('showProfesional');

     Route::get('admin/profesionales/cambioDeUnidad/createCambioDeUnidad/{id}', [ProfesionalCambioDeUnidadController::class, 'createCambioDeUnidad'])->name('createCambioDeUnidad');

     Route::post('admin/profesionales/cambioDeUnidad/storeCambioDeUnidad', [ProfesionalCambioDeUnidadController::class, 'storeCambioDeUnidad'])->name('storeCambioDeUnidad');

     Route::get('/descargar-documento/{id}', [ProfesionalCambioDeUnidadController::class, 'descargar'])->name('descargar.documento');

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

      /**RUTAS PARA EL CATALOGO 4 - CRI CREE */

      Route::get('admin/profesionales/ocupaciones/createCriCree/{id}', [ProfesionalOcupacionController::class, 'createCriCree'])->name('createCriCree');

      Route::post('admin/profesionales/ocupaciones/storeCriCree', [ProfesionalOcupacionController::class, 'storeCriCree'])->name('storeCriCree');
 
      Route::get('admin/profesionales/ocupaciones/editCriCree/{id}', [ProfesionalOcupacionController::class, 'editCriCree'])->name('editCriCree');
 
      Route::put('admin/profesionales/ocupaciones/updateCriCree/{id}', [ProfesionalOcupacionController::class, 'updateCriCree'])->name('updateCriCree');

      /**RUTAS PARA EL CATALOGO 5 - SAMU CRUM */

      Route::get('admin/profesionales/ocupaciones/createSamuCrum/{id}', [ProfesionalOcupacionController::class, 'createSamuCrum'])->name('createSamuCrum');

      Route::post('admin/profesionales/ocupaciones/storeSamuCrum', [ProfesionalOcupacionController::class, 'storeSamuCrum'])->name('storeSamuCrum');
 
      Route::get('admin/profesionales/ocupaciones/editSamuCrum/{id}', [ProfesionalOcupacionController::class, 'editSamuCrum'])->name('editSamuCrum');
 
      Route::put('admin/profesionales/ocupaciones/updateSamuCrum/{id}', [ProfesionalOcupacionController::class, 'updateSamuCrum'])->name('updateSamuCrum');

      /**RUTAS PARA EL CATALOGO 6 - OFICINA CENTRAL */

      Route::get('admin/profesionales/ocupaciones/createOficinaCentral/{id}', [ProfesionalOcupacionController::class, 'createOficinaCentral'])->name('createOficinaCentral');

      Route::post('admin/profesionales/ocupaciones/storeOficinaCentral', [ProfesionalOcupacionController::class, 'storeOficinaCentral'])->name('storeOficinaCentral');
 
      Route::get('admin/profesionales/ocupaciones/editOficinaCentral/{id}', [ProfesionalOcupacionController::class, 'editOficinaCentral'])->name('editOficinaCentral');
 
      Route::put('admin/profesionales/ocupaciones/updateOficinaCentral/{id}', [ProfesionalOcupacionController::class, 'updateOficinaCentral'])->name('updateOficinaCentral');

      /**RUTAS PARA EL CATALOGO 7 - ALMACEN */

      Route::get('admin/profesionales/ocupaciones/createAlmacen/{id}', [ProfesionalOcupacionController::class, 'createAlmacen'])->name('createAlmacen');

      Route::post('admin/profesionales/ocupaciones/storeAlmacen', [ProfesionalOcupacionController::class, 'storeAlmacen'])->name('storeAlmacen');
 
      Route::get('admin/profesionales/ocupaciones/editAlmacen/{id}', [ProfesionalOcupacionController::class, 'editAlmacen'])->name('editAlmacen');
 
      Route::put('admin/profesionales/ocupaciones/updateAlmacen/{id}', [ProfesionalOcupacionController::class, 'updateAlmacen'])->name('updateAlmacen');

      /**RUTAS PARA EL CATALOGO 8 - CETS LESP */

      Route::get('admin/profesionales/ocupaciones/createCetsLesp/{id}', [ProfesionalOcupacionController::class, 'createCetsLesp'])->name('createCetsLesp');

      Route::post('admin/profesionales/ocupaciones/storeCetsLesp', [ProfesionalOcupacionController::class, 'storeCetsLesp'])->name('storeCetsLesp');
 
      Route::get('admin/profesionales/ocupaciones/editCetsLesp/{id}', [ProfesionalOcupacionController::class, 'editCetsLesp'])->name('editCetsLesp');
 
      Route::put('admin/profesionales/ocupaciones/updateCetsLesp/{id}', [ProfesionalOcupacionController::class, 'updateCetsLesp'])->name('updateCetsLesp');

      /**RUTAS PARA EL CATALOGO 9 - CENTRO ONCOLOGICO DE LA REGION SURESTE */

      Route::get('admin/profesionales/ocupaciones/createCors/{id}', [ProfesionalOcupacionController::class, 'createCors'])->name('createCors');

      Route::post('admin/profesionales/ocupaciones/storeCors', [ProfesionalOcupacionController::class, 'storeCors'])->name('storeCors');
 
      Route::get('admin/profesionales/ocupaciones/editCors/{id}', [ProfesionalOcupacionController::class, 'editCors'])->name('editCors');
 
      Route::put('admin/profesionales/ocupaciones/updateCors/{id}', [ProfesionalOcupacionController::class, 'updateCors'])->name('updateCors');

      /**RUTAS PARA EL CATALOGO 11 - CESAME */

      Route::get('admin/profesionales/ocupaciones/createCesame/{id}', [ProfesionalOcupacionController::class, 'createCesame'])->name('createCesame');

      Route::post('admin/profesionales/ocupaciones/storeCesame', [ProfesionalOcupacionController::class, 'storeCesame'])->name('storeCesame');
 
      Route::get('admin/profesionales/ocupaciones/editCesame/{id}', [ProfesionalOcupacionController::class, 'editCesame'])->name('editCesame');
 
      Route::put('admin/profesionales/ocupaciones/updateCesame/{id}', [ProfesionalOcupacionController::class, 'updateCesame'])->name('updateCesame');

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

    /**
     * 
     * 
     * 1 - OCUPACIONES CENTROS DE SALUD URBANOS Y RURALES
     * 
     * 
     */
     Route::get('admin/settings/ocupacion/csuyr/index', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrIndex'])->name('ocupacionCsuyrIndex'); 

     Route::get('admin/settings/ocupacion/csuyr/create', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrCreate'])->name('ocupacionCsuyrCreate');  

     Route::post('admin/settings/ocupacion/csuyr/store', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrStore'])->name('ocupacionCsuyrStore'); 

     Route::get('admin/settings/ocupacion/csuyr/edit/{id}', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrEdit'])->name('ocupacionCsuyrEdit');  

     Route::put('admin/settings/ocupacion/csuyr/update/{id}', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrUpdate'])->name('ocupacionCsuyrUpdate');
     
     Route::delete('admin/settings/ocupacion/csuyr/delete/{id}', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrDestroy'])->name('ocupacionCsuyrDestroy');

     /**
     * 
     * 
     * 2 - OCUPACIONES HOSPITALES
     * 
     * 
     */
    Route::get('admin/settings/ocupacion/hospital/index', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalIndex'])->name('ocupacionHospitalIndex'); 

    Route::get('admin/settings/ocupacion/hospital/create', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalCreate'])->name('ocupacionHospitalCreate');  

    Route::post('admin/settings/ocupacion/hospital/store', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalStore'])->name('ocupacionHospitalStore'); 

    Route::get('admin/settings/ocupacion/hospital/edit/{id}', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalEdit'])->name('ocupacionHospitalEdit');  

    Route::put('admin/settings/ocupacion/hospital/update/{id}', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalUpdate'])->name('ocupacionHospitalUpdate');

    Route::delete('admin/settings/ocupacion/hospital/delete/{id}', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalDestroy'])->name('ocupacionHospitalDestroy');

     /**
     * 
     * 
     * 3 - OCUPACIONES OFICINAS JURISDICCIONALES
     * 
     * 
     */
    Route::get('admin/settings/ocupacion/ofJurisdiccional/index', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalIndex'])->name('ocupacionOfJurisdiccionalIndex'); 

    Route::get('admin/settings/ocupacion/ofJurisdiccional/create', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalCreate'])->name('ocupacionOfJurisdiccionalCreate');  

    Route::post('admin/settings/ocupacion/ofJurisdiccional/store', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalStore'])->name('ocupacionOfJurisdiccionalStore'); 

    Route::get('admin/settings/ocupacion/ofJurisdiccional/edit/{id}', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalEdit'])->name('ocupacionOfJurisdiccionalEdit');  

    Route::put('admin/settings/ocupacion/ofJurisdiccional/update/{id}', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalUpdate'])->name('ocupacionOfJurisdiccionalUpdate');

    Route::delete('admin/settings/ocupacion/ofJurisdiccional/delete/{id}', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalDestroy'])->name('ocupacionOfJurisdiccionalDestroy');

    /**
     * 
     * 
     * 4 OCUPACIONES CRI CREE
     * 
     * 
     */

    Route::get('admin/settings/ocupacion/CriCree/index', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeIndex'])->name('ocupacionCriCreeIndex'); 

    Route::get('admin/settings/ocupacion/CriCree/create', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeCreate'])->name('ocupacionCriCreeCreate');  

    Route::post('admin/settings/ocupacion/CriCree/store', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeStore'])->name('ocupacionCriCreeStore'); 

    Route::get('admin/settings/ocupacion/CriCree/edit/{id}', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeEdit'])->name('ocupacionCriCreeEdit');  

    Route::put('admin/settings/ocupacion/CriCree/update/{id}', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeUpdate'])->name('ocupacionCriCreeUpdate');

    Route::delete('admin/settings/ocupacion/CriCree/delete/{id}', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeDestroy'])->name('ocupacionCriCreeDestroy');

    /**
     * 
     * 
     * 5 OCUPACIONES SAMU CRUM
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/samuCrum/index', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumIndex'])->name('ocupacionSamuCrumIndex'); 

     Route::get('admin/settings/ocupacion/samuCrum/create', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumCreate'])->name('ocupacionSamuCrumCreate');  
 
     Route::post('admin/settings/ocupacion/samuCrum/store', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumStore'])->name('ocupacionSamuCrumStore'); 
 
     Route::get('admin/settings/ocupacion/samuCrum/edit/{id}', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumEdit'])->name('ocupacionSamuCrumEdit');  
 
     Route::put('admin/settings/ocupacion/samuCrum/update/{id}', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumUpdate'])->name('ocupacionSamuCrumUpdate');
 
     Route::delete('admin/settings/ocupacion/samuCrum/delete/{id}', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumDestroy'])->name('ocupacionSamuCrumDestroy');

     /**
     * 
     * 
     * 6 OCUPACIONES OFICINA CENTRAL
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/oficinaCentral/index', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralIndex'])->name('ocupacionOficinaCentralIndex'); 

     Route::get('admin/settings/ocupacion/oficinaCentral/create', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralCreate'])->name('ocupacionOficinaCentralCreate');  
 
     Route::post('admin/settings/ocupacion/oficinaCentral/store', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralStore'])->name('ocupacionOficinaCentralStore'); 
 
     Route::get('admin/settings/ocupacion/oficinaCentral/edit/{id}', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralEdit'])->name('ocupacionOficinaCentralEdit');  
 
     Route::put('admin/settings/ocupacion/oficinaCentral/update/{id}', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralUpdate'])->name('ocupacionOficinaCentralUpdate');

     Route::delete('admin/settings/ocupacion/oficinaCentral/delete/{id}', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralDestroy'])->name('ocupacionOficinaCentralDestroy');
 


});

