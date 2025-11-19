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
use App\Models\ProfesionalOcupacionEnsenanza;
use App\Models\ProfesionalOcupacionHospital;
use App\Models\ProfesionalOcupacionHospitalNino;
use App\Models\ProfesionalOcupacionIssreei;
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

        // Obtenemos el puesto
        $puesto = $profesional->puesto;

        // Verificamos clues_nomina
        if (!$puesto || $puesto->clues_nomina == null) {
            return redirect()->back()
                            ->with('error', 'El registro no tiene CLUES NOMINA, no se puede hacer el cambio de unidad. Revisar el módulo de puesto')
                            ->withInput();
        }

        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía desde storage
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;

        // Regresamos la vista con el objeto
        return view('cambio-unidad.mostrar-profesional', compact('profesional', 'fotoUrl'));
    }

    public function createCambioDeUnidad($id)
    {
        // Asignamos el valor id a la variable profeisonal
        $profesional = Profesional::findOrFail($id);
        
        // Cargamos el usuario en sesion
        $user = Auth::user();

        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía desde storage
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;

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
        elseif($user->role == 'criCree')
        {
            // Cargamos los clues

            $clues = Clue::whereIn('clues_adscripcion', ['CLSSA009989','CLSSA009988','CLSSA009987','CLSSA009986','CLSSA009985'])
                        ->get();
        }
        // Para los otros muestra solo la clues que le pertenece al usuario
        else
        {
            // Cargamos los clues
            $clues = Clue::where('id',$user->id_unidad)->get();
        }

        // REGLAS DE VALIDACION DE NOMINA

        // SI MI CLUES NOMINA = CLUES ADSCRIPCION SOLO ME PERMITIRA MOVIMIENTO ESCALAFONARIO

        
        
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
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_termino' => 'required_if:tipo_movimiento,2|nullable|date_format:Y-m-d|after:fecha_inicio',
        ], [
            'id_profesional.required'       => 'El profesional es obligatorio.',
            'clues.required'                => 'La unidad de destino es obligatoria.',
            'tipo_movimiento.required'      => 'El tipo de movimiento es obligatorio.',
            'tipo_movimiento.in'            => 'El tipo de movimiento seleccionado no es válido.',

            'documento_respaldo.mimes'      => 'El documento de respaldo debe ser un archivo en formato PDF.',
            'documento_respaldo.max'        => 'El documento de respaldo no debe superar los 5 MB.',
            'documento_respaldo.uploaded'   => 'No se pudo subir el archivo de respaldo. Verifica el tamaño y formato.',

            'fecha_inicio.required'         => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date_format'      => 'La fecha de inicio debe tener el formato correcto (YYYY-MM-DD).',

            'fecha_termino.required_if'     => 'La fecha de término es obligatoria cuando el movimiento es COMISIONADO A OTRA UNIDAD.',
            'fecha_termino.date_format'     => 'La fecha de término debe tener el formato correcto (YYYY-MM-DD).',
            'fecha_termino.after'           => 'La fecha de término debe ser posterior a la fecha de inicio.',
        ]);

        // Obtener el registro
        $profesional = ProfesionalPuesto::where('id_profesional', $request->id_profesional)->first();

        // Consultamos los datos de la CLUES Nueva
        $clues = Clue::findOrFail($request->clues);

        // Verificar si existe y si tiene clues_nomina
        if (!$profesional || $profesional->clues_nomina == null) {
            return redirect()->back()
                            ->with('error', 'El registro no tiene CLUES NOMINA, no se puede hacer el cambio de unidad. Revisar el módulo de puesto')
                            ->withInput(); 
        }

        // Validamos si tipo de movimiento es REGRESA A UNIDAD DE ORIGEN
        if($tipoMovimiento = 1)
        {
            if($clues->clues != $profesional->clues_nomina)
            {
                return redirect()->back()
                            ->with('error', 'Unidad de Destino Errónea ( CLUES Nómina Diferente )')
                            ->withInput(); 
            }
        }

        // Verificar si existe y si tiene clues_nomina
        if (!$profesional || $profesional->clues_nomina == null) {
            return redirect()->back()
                            ->with('error', 'El registro no tiene CLUES NOMINA, no se puede hacer el cambio de unidad. Revisar el módulo de puesto')
                            ->withInput(); 
        }

        

        // Consultamos los datos de la adscripcion antigua
        $cluesAnterior = Clue::where('clues',$profesional->clues_adscripcion)->first();

        // Consultamos la curp del profesional
        $profesional = Profesional::findOrFail($request->id_profesional);

        // Obtener la fecha y hora actual en el formato deseado
        $timestamp = now()->format('Ymd_His');

        // Generamos rutas vacias para evitar error si no se sube archivo
        $archivoNombre = null; 
        $archivoPath = null;

        // Asignamos el label cal tipo de movimiento
        switch ($request->tipo_movimiento) 
        {
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

        

        // Generamos un uevo objeto para almacenar los datos

        $cambioDeUnidad = new ProfesionalCambioDeUnidad();

        $cambioDeUnidad->id_profesional = $request->id_profesional;
        $cambioDeUnidad->tipo_movimiento_id = $request->tipo_movimiento;
        $cambioDeUnidad->tipo_movimiento = $tipoMovimiento;
        $cambioDeUnidad->documento_respaldo = $archivoPath;
        $cambioDeUnidad->fecha_inicio = $request->fecha_inicio;
        $cambioDeUnidad->fecha_final = $request->fecha_termino;

        $cambioDeUnidad->unidad_origen_clues = $cluesAnterior->clues;
        $cambioDeUnidad->unidad_origen_nombre = $cluesAnterior->nombre;
        $cambioDeUnidad->unidad_origen_jurisdiccion = $cluesAnterior->jurisdiccion;

        $cambioDeUnidad->unidad_destino_clues = $clues->clues;
        $cambioDeUnidad->unidad_destino_nombre = $clues->nombre;
        $cambioDeUnidad->unidad_destino_jurisdiccion = $clues->jurisdiccion;

        $cambioDeUnidad->save();

        // Buscar el registro del puesto actual de ese profesional para actualizar el dato
        $puesto = ProfesionalPuesto::where('id_profesional', $request->id_profesional)->first();

        if ($puesto) 
        {
            $puesto->clues_adscripcion = $clues->clues;
            $puesto->clues_adscripcion_nombre = $clues->nombre;
            $puesto->clues_adscripcion_municipio = $clues->municipio;
            $puesto->clues_adscripcion_jurisdiccion = $clues->jurisdiccion;
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

        // Catalogo 10 - ISSREEI
        $buscarOcupacionIssreei = ProfesionalOcupacionIssreei::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 11 - CESAME
        $buscarOcupacionCesame = ProfesionalOcupacionCesame::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 12 - PSI PARRAS
        $buscarOcupacionPsiParras = ProfesionalOcupacionPsiParras::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 13 - CEAM
        $buscarOcupacionCeam = ProfesionalOcupacionCeam::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 14 - HOSPITAL DEL NIÑO
        $buscarOcupacionHospitalNino = ProfesionalOcupacionHospitalNino::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 15 - PERSONAL EN FORMACION

        $buscarOcupacionPersonalEnFormacion = ProfesionalOcupacionEnsenanza::where('id_profesional',$request->id_profesional)->first()?->delete();


        // Redireccionamos al perfil del usuario
        return redirect()->route('profesionalShow',$profesional->id)->with('success', 'Cambio de unidad registrada correctamente');

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

    public function documentoRespaldoCreate($id)
    {
        // Consultamos el registro
        $cambio = ProfesionalCambioDeUnidad::findOrFail($id);

        // Consultamos el profesional
        $profesional = Profesional::where('id',$cambio->id_profesional)->first();

        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía desde storage
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;

        // Regresamos la vista con el objeto
        return view('cambio-unidad.documento-respaldo', compact('cambio','profesional','fotoUrl'));
    }

    public function documentoRespaldoStore(Request $request, $id)
    {
        // Validamos los datos de entrada
        $request->validate([
            'documento_respaldo' => 'nullable|mimes:pdf|max:5120',
        ],[
            'documento_respaldo.mimes' => 'El documento de respaldo debe estar en formato PDF.',
            'documento_respaldo.max' => 'El documento de respaldo no debe superar los 5 MB de tamaño.',
        ]);

        // Consultamos el registro
        $cambio = ProfesionalCambioDeUnidad::findOrFail($id);

        // Consultamos el profesional
        $profesional = Profesional::where('id',$cambio->id_profesional)->first();

        $extension = $request->documento_respaldo->extension();
        $timestamp = now()->format('Ymd_His'); // Ejemplo: 20251001_213045

        switch ($cambio->tipo_movimiento_id) {
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

        // Asignamos los valores al registro
        $cambio->documento_respaldo = $archivoPath;
        
        // Guardamos el registro
        $cambio->save();

        // Redireccionamos al perfil del usuario
        return redirect()->route('profesionalShow',$profesional->id)->with('success', 'Documento de Respaldo registrado correctamente');
    }

    public function cambioDeUnidadForzoso(Request $request)
    {
        $request->validate([
            'id_profesional' => 'required',
            'clues_nomina' => 'required',
            'clues_adscripcion' => 'required',
        ],[]);

        // Consultamos los datos de las CLUES
        $cluesNomina = Clue::where('clues',$request->clues_nomina)->first();

        $cluesAdscripcion = Clue::where('clues',$request->clues_adscripcion)->first();

        // Buscamos el registro en el modulo de puesto
        $puesto = ProfesionalPuesto::where('id_profesional',$request->id_profesional)->first();

        // Actualizamos y asignamos los valores

        $puesto->clues_nomina = $cluesNomina->clues;
        $puesto->clues_nomina_nombre = $cluesNomina->nombre;
        $puesto->clues_nomina_municipio = $cluesNomina->municipio;
        $puesto->clues_nomina_jurisdiccion = $cluesNomina->jurisdiccion;

        $puesto->clues_adscripcion = $cluesAdscripcion->clues;
        $puesto->clues_adscripcion_nombre = $cluesAdscripcion->nombre;
        $puesto->clues_adscripcion_municipio = $cluesAdscripcion->municipio;
        $puesto->clues_adscripcion_jurisdiccion = $cluesAdscripcion->jurisdiccion;
        $puesto->clues_adscripcion_tipo = $cluesAdscripcion->clave_establecimiento;

        $puesto->save();

        // Eliminamos todos los registros de los catalogos

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

        // Catalogo 10 - ISSREEI
        $buscarOcupacionIssreei = ProfesionalOcupacionIssreei::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 11 - CESAME
        $buscarOcupacionCesame = ProfesionalOcupacionCesame::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 12 - PSI PARRAS
        $buscarOcupacionPsiParras = ProfesionalOcupacionPsiParras::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 13 - CEAM
        $buscarOcupacionCeam = ProfesionalOcupacionCeam::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 14 - HOSPITAL DEL NIÑO
        $buscarOcupacionHospitalNino = ProfesionalOcupacionHospitalNino::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 15 - PERSONAL EN FORMACION
        $buscarOcupacionPersonalEnFormacion = ProfesionalOcupacionEnsenanza::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Redireccionamos al perfil del usuario
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Cambio de Unidad Forzoso Correctamente');

    }
}