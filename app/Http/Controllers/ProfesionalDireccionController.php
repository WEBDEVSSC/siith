<?php

namespace App\Http\Controllers;

use App\Models\CatCodigoPostal;
use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalesDireccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalDireccionController extends Controller
{
    //

    public function createDireccion($id)
    {
        $profesional = Profesional::findOrFail($id);
    
        $codigosPostales = CatCodigoPostal::all();

        return view('direccion.create', compact('profesional','codigosPostales'));
    }

    public function storeDireccion(Request $request,$id)
    {
        $request->validate([
            'calle' => 'required|max:120|string',
            'numero_interior' => 'nullable|max:120|string',
            'numero_exterior' => 'required|max:120|string',
            'codigo_postal' => 'required|max:120|string',
            'clave_elector' => 'nullable|max:120|string',
            'seccion' => 'nullable|digits:4',
            'vigencia' => 'nullable|digits:4|string',
            'ine' => 'nullable|file|mimes:pdf|max:10000',
            'comprobante_domicilio' => 'nullable|file|mimes:pdf|max:10000',
            'curp' => 'nullable|file|mimes:pdf|max:10000',
            'rfc' => 'nullable|file|mimes:pdf|max:10000',
        ],[
            'calle.required'           => 'La calle es obligatoria.',
            'calle.string'             => 'La calle debe ser un texto válido.',
            'calle.max'                => 'La calle no debe exceder los 120 caracteres.',

            'numero_interior.required' => 'El número interior es obligatorio.',
            'numero_interior.string'   => 'El número interior debe ser un texto válido.',
            'numero_interior.max'      => 'El número interior no debe exceder los 120 caracteres.',

            'numero_exterior.required' => 'El número exterior es obligatorio.',
            'numero_exterior.string'   => 'El número exterior debe ser un texto válido.',
            'numero_exterior.max'      => 'El número exterior no debe exceder los 120 caracteres.',

            'codigo_postal.required'   => 'El código postal es obligatorio.',
            'codigo_postal.string'     => 'El código postal debe ser un texto válido.',
            'codigo_postal.max'        => 'El código postal no debe exceder los 120 caracteres.',

            'clave_elector.max'        => 'La clave de elector no debe exceder los 120 caracteres.',
            'seccion.digits'           => 'La sección debe tener 4 dígitos.',
            'vigencia.digits'          => 'La vigencia debe tener 4 dígitos.',

            'ine.file'                  => 'El archivo debe ser un archivo válido.',
            'ine.mimes'                 => 'El archivo debe ser un PDF.',
            'ine.max'                   => 'El archivo no debe exceder los 10 MB.',

            'comprobante_domicilio.file' => 'El archivo debe ser un archivo válido.',
            'comprobante_domicilio.mimes' => 'El archivo debe ser un PDF.',
            'comprobante_domicilio.max' => 'El archivo no debe exceder los 10 MB.',

            'curp.file' => 'El archivo debe ser un archivo válido.',
            'curp.mimes' => 'El archivo debe ser un PDF.',
            'curp.max' => 'El archivo no debe exceder los 10 MB.',

            'rfc.file' => 'El archivo debe ser un archivo válido.',
            'rfc.mimes' => 'El archivo debe ser un PDF.',
            'rfc.max' => 'El archivo no debe exceder los 10 MB.',
        ]);

        $codigoPostal = CatCodigoPostal::findOrFail($request->codigo_postal);

        $profesional = Profesional::findOrFail($id);

        if ($request->hasFile('ine')) {

            $archivo = $request->file('ine');

            $nombreArchivo = strtoupper($profesional->curp) . '_INE.' . $archivo->getClientOriginalExtension();

            $ruta = $archivo->storeAs('ine',$nombreArchivo,'public');
        }
        else
        {
            $ruta = null;
        }

        if ($request->hasFile('comprobante_domicilio')) {

            $archivoComprobanteDomicilio = $request->file('comprobante_domicilio');

            $nombreArchivoComprobanteDomicilio = strtoupper($profesional->curp) . '_COMPROBANTE_DOMICILIO.' . $archivoComprobanteDomicilio->getClientOriginalExtension();

            $rutaComprobanteDomicilio = $archivoComprobanteDomicilio->storeAs('comprobante_domicilio',$nombreArchivoComprobanteDomicilio,'public');
        }
        else
        {
            $rutaComprobanteDomicilio = null;
        }

        if ($request->hasFile('curp')) {

            $archivoCurp = $request->file('curp');

            $nombreArchivoCurp = strtoupper($profesional->curp) . '_CURP.' . $archivoCurp->getClientOriginalExtension();

            $rutaCurp = $archivoCurp->storeAs('curp',$nombreArchivoCurp,'public');
        }
        else
        {
            $rutaCurp = null;
        }

        if ($request->hasFile('rfc')) {

            $archivoRfc = $request->file('rfc');

            $nombreArchivoRfc = strtoupper($profesional->rfc) . '_RFC.' . $archivoRfc->getClientOriginalExtension();

            $rutaRfc = $archivoRfc->storeAs('rfc',$nombreArchivoRfc,'public');
        }
        else
        {
            $rutaRfc = null;
        }

        $direccion = new ProfesionalesDireccion();

        $direccion->id_profesional = $id;
        $direccion->calle = $request->calle;
        $direccion->numero_exterior = $request->numero_exterior;
        $direccion->numero_interior = $request->numero_interior;
        $direccion->id_codigo_postal = $request->codigo_postal;
        $direccion->codigo_postal = $codigoPostal->codigo_postal;
        $direccion->colonia = $codigoPostal->colonia;
        $direccion->municipio = $codigoPostal->municipio;
        $direccion->estado = $codigoPostal->estado;
        $direccion->ciudad = $codigoPostal->ciudad;
        $direccion->tipo_asentamiento = $codigoPostal->tipo_asentamiento;
        $direccion->zona = $codigoPostal->zona;

        $direccion->clave_elector = $request->clave_elector;
        $direccion->seccion = $request->seccion;
        $direccion->vigencia = $request->vigencia;

        $direccion->ine = $ruta;
        $direccion->comprobante_domicilio = $rutaComprobanteDomicilio;
        $direccion->curp = $rutaCurp;
        $direccion->rfc = $rutaRfc;

        $direccion->mdl_direccion = 1;

        $direccion->save();

        // Bitácora
        $usuario = Auth::user();

        ProfesionalBitacora::create([
            'id_capturista' => $usuario->id,
            'capturista_label' => $usuario->responsable,
            'accion' => "REGISTRO EN MODULO DIRECCION",
            'id_profesional' => $id,
        ]);

        return redirect()->route('profesionalShow', $id)->with('success', 'Registro realizado correctamente.');
    }

    public function editDireccion($id)
    {
        // Buscamos el registro con el id del profesional
        $profesional = Profesional::findOrFail($id);

        // Buscamos el registro de la direccion
        $direccion = ProfesionalesDireccion::where('id_profesional', $id)->first();

        // Cargamos el arreglo de los Codigos Postales
        $codigosPostales = CatCodigoPostal::all();

        // Retornamos con los objetos
        return view('direccion.edit',compact('profesional','direccion', 'codigosPostales'));
    }

    public function updateDireccion(Request $request, $id)
    {
        $request->validate([
            'calle' => 'required|max:120|string',
            'numero_interior' => 'nullable|max:120|string',
            'numero_exterior' => 'required|max:120|string',
            'codigo_postal' => 'required|max:120|string',
            'clave_elector' => 'nullable|max:120|string',
            'seccion' => 'nullable|digits:4',
            'vigencia' => 'nullable|digits:4|string',

            // Si viene un archivo físico, aplicamos validación de archivo; si viene texto (URL precargada), se ignora
            'ine' => $request->hasFile('ine') ? 'file|mimes:pdf|max:10240' : 'nullable',
            'comprobante_domicilio' => $request->hasFile('comprobante_domicilio') ? 'file|mimes:pdf|max:10240' : 'nullable',
            'curp' => $request->hasFile('curp') ? 'file|mimes:pdf|max:10240' : 'nullable',
            'rfc' => $request->hasFile('rfc') ? 'file|mimes:pdf|max:10240' : 'nullable',
        ],[
            // CALLE
            'calle.required' => 'La calle es obligatoria.',
            'calle.string' => 'La calle debe ser un texto válido.',
            'calle.max' => 'La calle no debe exceder los 120 caracteres.',

            // NÚMERO INTERIOR
            'numero_interior.string' => 'El número interior debe ser un texto válido.',
            'numero_interior.max' => 'El número interior no debe exceder los 120 caracteres.',

            // NÚMERO EXTERIOR
            'numero_exterior.required' => 'El número exterior es obligatorio.',
            'numero_exterior.string' => 'El número exterior debe ser un texto válido.',
            'numero_exterior.max' => 'El número exterior no debe exceder los 120 caracteres.',

            // CÓDIGO POSTAL
            'codigo_postal.required' => 'El código postal es obligatorio.',
            'codigo_postal.string' => 'El código postal debe ser un texto válido.',
            'codigo_postal.max' => 'El código postal no debe exceder los 120 caracteres.',

            // INE
            'clave_elector.max' => 'La clave de elector no debe exceder los 120 caracteres.',

            'seccion.digits' => 'La sección debe tener exactamente 4 dígitos.',

            'vigencia.digits' => 'La vigencia debe tener exactamente 4 dígitos.',
            'vigencia.string' => 'La vigencia debe ser un texto válido.',

            'ine.file' => 'El archivo de la INE debe ser un archivo válido.',
            'ine.mimes' => 'El archivo de la INE debe estar en formato PDF.',
            'ine.max' => 'El archivo de la INE no debe exceder los 10 MB.',

            'comprobante_domicilio.file' => 'El comprobante de domicilio debe ser un archivo válido.',
            'comprobante_domicilio.mimes' => 'El comprobante de domicilio debe estar en formato PDF.',
            'comprobante_domicilio.max' => 'El comprobante de domicilio no debe exceder los 10 MB.',

            'curp.file' => 'El archivo de la CURP debe ser un archivo válido.',
            'curp.mimes' => 'El archivo de la CURP debe estar en formato PDF.',
            'curp.max' => 'El archivo de la CURP no debe exceder los 10 MB.',

            'rfc.file' => 'El archivo del RFC debe ser un archivo válido.',
            'rfc.mimes' => 'El archivo del RFC debe estar en formato PDF.',
            'rfc.max' => 'El archivo del RFC no debe exceder los 10 MB.',
        ]);

        $codigoPostal = CatCodigoPostal::findOrFail($request->codigo_postal);

        $direccion = ProfesionalesDireccion::findOrFail($id);

        $profesional = Profesional::where('id', $direccion->id_profesional)->first();

        //$profesional = Profesional::findOrFail($id);

        if ($request->hasFile('ine')) {

            $archivo = $request->file('ine');

            $nombreArchivo = strtoupper($profesional->curp) . '_INE.' . $archivo->getClientOriginalExtension();

            $ruta = $archivo->storeAs('ine',$nombreArchivo,'public');
        }
        else
        {
            $ruta = $profesional->direccion->ine;
        }

        if ($request->hasFile('comprobante_domicilio')) {

            $archivoComprobanteDomicilio = $request->file('comprobante_domicilio');

            $nombreArchivoComprobanteDomicilio = strtoupper($profesional->curp) . '_COMPROBANTE_DOMICILIO.' . $archivoComprobanteDomicilio->getClientOriginalExtension();

            $rutaComprobanteDomicilio = $archivoComprobanteDomicilio->storeAs('comprobante_domicilio',$nombreArchivoComprobanteDomicilio,'public');
        }
        else
        {
            $rutaComprobanteDomicilio = $profesional->direccion->comprobante_domicilio;
        }

        if ($request->hasFile('curp')) {

            $archivoCurp = $request->file('curp');

            $nombreArchivoCurp = strtoupper($profesional->curp) . 'CURP.' . $archivoCurp->getClientOriginalExtension();

            $rutaCurp = $archivoCurp->storeAs('curp',$nombreArchivoCurp,'public');
        }
        else
        {
            $rutaCurp = $profesional->direccion->curp;
        }

        if ($request->hasFile('rfc')) {

            $archivoRfc = $request->file('rfc');

            $nombreArchivoRfc = strtoupper($profesional->rfc) . 'RFC.' . $archivoRfc->getClientOriginalExtension();

            $rutaRfc = $archivoRfc->storeAs('rfc',$nombreArchivoRfc,'public');
        }
        else
        {
            $rutaRfc = $profesional->direccion->rfc;
        }


        $direccion->calle = $request->calle;
        $direccion->numero_exterior = $request->numero_exterior;
        $direccion->numero_interior = $request->numero_interior;
        $direccion->id_codigo_postal = $request->codigo_postal;
        $direccion->codigo_postal = $codigoPostal->codigo_postal;
        $direccion->colonia = $codigoPostal->colonia;
        $direccion->municipio = $codigoPostal->municipio;
        $direccion->estado = $codigoPostal->estado;
        $direccion->ciudad = $codigoPostal->ciudad;
        $direccion->tipo_asentamiento = $codigoPostal->tipo_asentamiento;
        $direccion->zona = $codigoPostal->zona;

        $direccion->clave_elector = $request->clave_elector;
        $direccion->seccion = $request->seccion;
        $direccion->vigencia = $request->vigencia;

        $direccion->ine = $ruta;
        $direccion->comprobante_domicilio = $rutaComprobanteDomicilio;
        $direccion->curp = $rutaCurp;
        $direccion->rfc = $rutaRfc;

        $direccion->mdl_direccion = 1;

        $direccion->save();

        // Bitácora
        $usuario = Auth::user();

        ProfesionalBitacora::create([
            'id_capturista' => $usuario->id,
            'capturista_label' => $usuario->responsable,
            'accion' => "ACTUALIZACION EN MODULO DIRECCION",
            'id_profesional' => $profesional->id,
        ]);

        return redirect()->route('profesionalShow', $profesional->id)->with('success', 'Registro actualizado correctamente.');
    }
}
