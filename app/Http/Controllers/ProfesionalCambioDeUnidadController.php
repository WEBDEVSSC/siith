<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Profesional;
use App\Models\ProfesionalCambioDeUnidad;
use App\Models\ProfesionalOcupacionAlmacen;
use App\Models\ProfesionalOcupacionCeam;
use App\Models\ProfesionalOcupacionCentroSalud;
use App\Models\ProfesionalOcupacionCesame;
use App\Models\ProfesionalOcupacionCetsLesp;
use App\Models\ProfesionalOcupacionCors;
use App\Models\ProfesionalOcupacionCriCree;
use App\Models\ProfesionalOcupacionHospital;
use App\Models\ProfesionalOcupacionHospitalNino;
use App\Models\ProfesionalOcupacionOficinaCentral;
use App\Models\ProfesionalOcupacionOfJurisdiccional;
use App\Models\ProfesionalOcupacionPsiParras;
use App\Models\ProfesionalOcupacionSamuCrum;
use App\Models\ProfesionalPuesto;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfesionalCambioDeUnidadController extends Controller
{
    //

    public function findProfesional()
    {
        // Mostramos el formulario de busqueda por CURP
        return view('cambio-unidad.buscar-profesional');
    }

    public function showProfesional(Request $request)
    {
        //Validamos el registro
        $request->validate([
            'curp' => 'required|regex:/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/',
        ], [
            'curp.required' => 'El campo CURP es obligatorio.',
            'curp.regex' => 'El formato del CURP no es válido. Asegúrate de que esté correctamente escrito (18 caracteres: letras y números en mayúsculas).',
        ]);
        
        // Buscamos el registro con la CURP
        $profesional = Profesional::where('curp', $request->curp)->first();

        // Si no se encontró el profesional, regresamos con un mensaje de error
        if (!$profesional) {
            return redirect()->back()
                            ->with('error', 'No se encontró ningún profesional con esa CURP.')
                            ->withInput();
        }

        // Cargamos los datos del MODULO CREDENCIALIZACION
        $credencializacion = $profesional?->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía
        $fotoUrl = $fotografia ? url('/foto/' . basename($fotografia)) : null;

        // Regresamos la vista con el objeto
        return view('cambio-unidad.mostrar-profesional', compact('profesional', 'fotoUrl'));
    }

    public function createCambioDeUnidad($id)
    {
        // Asignamos el valor id a la variable profeisonal
        $profesional = Profesional::findOrFail($id);
        
        // Cargamos el usuario en sesion
        $user = Auth::user();

        // Cargamos los datos de la clues del usuario
        //$clues = Clue::findOrFail($user->id_unidad);

        // Cargamos los datos del MODULO CREDENCIALIZACION
        $credencializacion = $profesional?->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía
        $fotoUrl = $fotografia ? url('/foto/' . basename($fotografia)) : null;

        

        // Cargamos las clues que le corresponden al usuario
        // Clues para administrador - muestra todas las clues
        if($user->role == 'admin')
        {   
            // Cargamos los clues
            $clues = Clue::all();
        }
        // Para oficina jurisdiccional muestra solo las clues de su jurisdiccion
        elseif($user->role == 'ofJurisdiccional')
        {
            // Cargamos los clues
            $clues = Clue::where('clave_jurisdiccion',$user->jurisdiccion_unidad)->get();
        }
        // Para los otros muestra solo la clues que le pertenece al usuario
        else
        {
            // Cargamos los clues
            $clues = Clue::where('id',$user->id_unidad)->get();
        }
        
        return view('cambio-unidad.cambioUnidad-create', compact('profesional', 'clues','fotoUrl'));
    }

    public function storeCambioDeUnidad(Request $request)
    {
        // Primero validamos
        $request->validate([
            'id_profesional' => 'required',
            'tipo_movimiento' => 'required',
            'clues' => 'required',
            'documento_respaldo' => 'nullable|mimes:pdf|max:5120',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after:fecha_inicio',
        ], [
            'clues.required'=>'La unidad de destino es obligatoria',
            'tipo_movimiento.required' => 'El tipo de movimiento es obligatorio.',
            'documento_respaldo.required' => 'El documento de respaldo es obligatorio.',
            'documento_respaldo.mimes' => 'El documento de respaldo debe ser un archivo PDF.',
            'documento_respaldo.max' => 'El documento de respaldo no debe ser mayor a 5 MB.',
            'documento_resplado.uploaded' => 'No se pudo subir el archivo :attribute. Asegúrate de que no supere el tamaño permitido (5 MB) y que el formato sea correcto.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_termino.required' => 'La fecha de término es obligatoria.',
            'fecha_termino.date' => 'La fecha de término debe ser una fecha válida.',
            'fecha_termino.after' => 'La fecha de término debe ser posterior a la fecha de inicio.',
        ]);

        // Consultamos los datos de la CLUES
        $clues = Clue::findOrFail($request->clues);

        // Consultamos la curp del profesional
        $profesional = Profesional::findOrFail($request->id_profesional);

        // Obtener la fecha y hora actual en el formato deseado
        $timestamp = now()->format('Ymd_His');

        // Regresa a su unidad de origen
        /*if($request->tipo_movimiento == 1)
        {
            // Asignamos el tipo de movimiento
            $tipoMovimiento = "REGRESA A UNIDAD DE ORIGEN";
            
            // Crear el nombre del archivo con la fecha y hora
            $archivoNombre = $profesional->curp . '_RUO_' . $timestamp . '.' . $request->documento_respaldo->extension();
        }
        // Comisionado a otra unidad
        elseif($request->tipo_movimiento == 2)
        {
            // Asignamos el tipo de movimiento
            $tipoMovimiento = "COMISIONADO A OTRA UNIDAD";
            
            // Crear el nombre del archivo con la fecha y hora
            $archivoNombre = $profesional->curp . '_COU_' . $timestamp . '.' . $request->documento_respaldo->extension();
        }
        // Movimiento Escalafonario
        elseif($request->tipo_movimiento == 3)
        {
            // Asignamos el tipo de movimiento
            $tipoMovimiento = "MOVIMIENTO ESCALAFONARIO";
            
            // Crear el nombre del archivo con la fecha y hora
            $archivoNombre = $profesional->curp . '_ME_' . $timestamp . '.' . $request->documento_respaldo->extension();
        }
        else
        {

        }       
        
        // Almacenar el archivo en la carpeta 'documents' en el almacenamiento local
        $archivoPath = $request->documento_respaldo->storeAs('cambio-unidad', $archivoNombre, 'local');*/

        $archivoNombre = null; // Por si no se sube archivo
        $archivoPath = null;

        switch ($request->tipo_movimiento) {
            case 1:
                $tipoMovimiento = "REGRESA A UNIDAD DE ORIGEN";
                break;
            case 2:
                $tipoMovimiento = "COMISIONADO A OTRA UNIDAD";
                break;
            case 3:
                $tipoMovimiento = "MOVIMIENTO ESCALAFONARIO";
                break;
            default:
                $tipoMovimiento = null;
                break;
        }

        // Solo generar nombre y guardar si existe el archivo
        if ($request->hasFile('documento_respaldo')) {
            $extension = $request->documento_respaldo->extension();
            $timestamp = now()->format('Ymd_His'); // Ejemplo: 20251001_213045

            switch ($request->tipo_movimiento) {
                case 1:
                    $archivoNombre = $profesional->curp . '_RUO_' . $timestamp . '.' . $extension;
                    break;
                case 2:
                    $archivoNombre = $profesional->curp . '_COU_' . $timestamp . '.' . $extension;
                    break;
                case 3:
                    $archivoNombre = $profesional->curp . '_ME_' . $timestamp . '.' . $extension;
                    break;
            }

            // Guardar archivo
            $archivoPath = $request->documento_respaldo->storeAs('cambio-unidad', $archivoNombre, 'local');
        }

        $cambioDeUnidad = new ProfesionalCambioDeUnidad();

        $cambioDeUnidad->id_profesional = $request->id_profesional;
        $cambioDeUnidad->tipo_movimiento_id = $request->tipo_movimiento;
        $cambioDeUnidad->tipo_movimiento = $tipoMovimiento;
        $cambioDeUnidad->documento_respaldo = $archivoPath;
        $cambioDeUnidad->fecha_inicio = $request->fecha_inicio;
        $cambioDeUnidad->fecha_final = $request->fecha_termino;
        $cambioDeUnidad->unidad_origen_clues = $profesional->puesto->clues_adscripcion;
        $cambioDeUnidad->unidad_origen_nombre = $profesional->puesto->clues_adscripcion_nombre;
        $cambioDeUnidad->unidad_origen_jurisdiccion = $profesional->puesto->clues_adscripcion_jurisdiccion;
        $cambioDeUnidad->unidad_destino_clues = $clues->clues;
        $cambioDeUnidad->unidad_destino_nombre = $clues->nombre;
        $cambioDeUnidad->unidad_destino_jurisdiccion = $clues->clave_jurisdiccion;

        $cambioDeUnidad->save();

        // Buscar el registro del puesto actual de ese profesional
        $puesto = ProfesionalPuesto::where('id_profesional', $request->id_profesional)->first();

        if ($puesto) 
        {
            $puesto->clues_adscripcion = $clues->clues;
            $puesto->clues_adscripcion_nombre = $clues->nombre;
            $puesto->clues_adscripcion_municipio = $clues->municipio;
            $puesto->clues_adscripcion_jurisdiccion = $clues->clave_jurisdiccion;
            $puesto->clues_adscripcion_tipo = $clues->clave_establecimiento;

            $puesto->save();
        }

        // Eliminar registros de las OCUPACIONES

        // Catalogo 1 - CENTROS DE SALUD URBANOS Y RURALES
        $buscarOcupacionCentroSalud = ProfesionalOcupacionCentroSalud::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 2 - HOSPITALES
        $buscarOcupacionHospital = ProfesionalOcupacionHospital::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 3 - OFICINAS JURISDICCIONALES
        $buscarOcupacionOficinaCentral = ProfesionalOcupacionOfJurisdiccional::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 4 - CRI CREE
        $buscarOcupacionCriCree = ProfesionalOcupacionCriCree::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 5 - SAMU CRUM
        $buscarOcupacionSamuCrum = ProfesionalOcupacionSamuCrum::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 6 - OFICINA CENTRAL
        $buscarOcupacionOficinaCentral = ProfesionalOcupacionOficinaCentral::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 7 - ALMACEN
        $buscarOcupacionAlmacen = ProfesionalOcupacionAlmacen::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 8 - LESP CETS
        $buscarOcupacionCetsLesp = ProfesionalOcupacionCetsLesp::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 9 - CORS
        $buscarOcupacionCors = ProfesionalOcupacionCors::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 11 - CESAME
        $buscarOcupacionCesame = ProfesionalOcupacionCesame::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 12 - PSI PARRAS
        $buscarOcupacionPsiParras = ProfesionalOcupacionPsiParras::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 13 - CEAM
        $buscarOcupacionCeam = ProfesionalOcupacionCeam::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 14 - HOSPITAL DEL NIÑO
        $buscarOcupacionHospitalNino = ProfesionalOcupacionHospitalNino::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Redireccionamos al perfil del usuario
        return redirect()->route('profesionalShow',$profesional->id)->with('successCambioDeUnidad', 'Cambio de unidad registrada correctamente');

    }

    public function descargar($id)
    {
        $cambio = ProfesionalCambioDeUnidad::findOrFail($id);
        $path = $cambio->documento_respaldo;

        if (Storage::disk('local')->exists($path)) {
            // Obtener contenido
            $file = Storage::disk('local')->get($path);
            $mime = Storage::disk('local')->mimeType($path);

            return response($file, 200)
                ->header('Content-Type', $mime)
                ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
        }

        abort(404, 'Archivo no encontrado');
    }
}