@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Emergencias</strong></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">

    <ul>
        <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
        <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
    </ul>
    
</div>


    
    <div class="card">
        <div class="card-header">
            
            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>

        </div>

        <form action="{{ route('storeEmergencia') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Datos Personales</h4>
                        </blockquote>
                    </div>
                </div>

                <div class="row mt-3">
                    
                    <div class="col-md-3">
                        <p><strong>Teléfono Celular</strong></p>
                        <input type="text" name="telefono_celular" class="form-control" maxlength="10" value="{{ old('telefono_celular') }}">
                        
                        @error('telefono_celular')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="col-md-3">
                        <p><strong>Correo Electrónico</strong></p>
                        <input type="email" name="correo_electronico" class="form-control" value="{{ old('correo_electronico') }}"> 

                        @error('correo_electronico')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Tipo de Sangre</strong></p>
                        <select name="tipo_sangre" id="tipo_sangre" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach ($tiposDeSangre as $tipo)
                                <option value="{{ $tipo->tipo_sangre }}" {{ old('tipo_sangre') == $tipo->tipo_sangre ? 'selected' : '' }}>
                                    {{ $tipo->tipo_sangre }}
                                </option>
                            @endforeach
                        </select>

                        @error('tipo_sangre')
                            <small class="alert alert-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Alergia</strong></p>
                        <select name="tipo_alergia_id" id="tipo_alergia_id" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach ($tiposDeAlergia as $alergia)
                                <option value="{{ $alergia->id }}" {{ old('tipo_alergia_id') == $alergia->id ? 'selected' : '' }}>
                                    {{ $alergia->tipo_alergia }}
                                </option>
                            @endforeach
                        </select>

                        @error('tipo_alergia_id')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-12">
                        <p><strong>Describa Brevemente</strong></p>
                        <input type="text" name="alergia_descripcion" id="alergia_descripcion" class="form-control"  value="{{ old('alergia_descripcion') }}">                     
                        @error('alergia_descripcion')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">
                    
                    <div class="col-md-6">
                        <p><strong>Enfermedades Preexistentes</strong></p>
                        <input type="text" name="enfermedad" id="enfermedad" class="form-control" value="{{ old('enfermedad') }}">                     
                        @error('enfermedad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-6">
                        <p><strong>Medicamentos que Toma Regularmente</strong></p>
                        <input type="text" name="medicamentos" id="medicamentos" class="form-control" value="{{ old('medicamentos') }}">                     
                        @error('medicamentos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  
                    
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-12">
                        <p><strong>Tratamiento Médico Actual</strong></p>
                        <textarea name="tratamiento" id="tratamiento" cols="30" rows="5" class="form-control">{{ old('tratamiento') }}</textarea>                    
                        @error('tratamiento')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Médico de Cabecera</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="medico_nombre" id="medico_nombre" class="form-control" value="{{ old('medico_nombre') }}">                     
                        @error('medico_nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-3">
                        <p><strong>Teléfono de Contacto</strong></p>
                        <input type="text" name="medico_telefono" id="medico_telefono" class="form-control" value="{{ old('medico_telefono') }}">                     
                        @error('medico_telefono')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                </div>

                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 1</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="emergencia_nombre_uno" id="emergencia_nombre_uno" class="form-control" value="{{ old('emergencia_nombre_uno') }}">                     
                        @error('emergencia_nombre_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-2">                        
                            <p><strong>Parentesco</strong></p>
                            <select name="emergencia_relacion_uno" id="emergencia_relacion_uno" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($relacionesDeEmergencia as $relacion)
                                    <option value="{{ $relacion->id }}" 
                                        {{ old('emergencia_relacion_uno') == $relacion->id ? 'selected' : '' }}>
                                        {{ $relacion->relacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('emergencia_relacion_uno')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <div class="col-md-2">
                        <p><strong>Teléfono Principal</strong></p>
                        <input type="text" name="emergencia_telefono_uno_uno" id="emergencia_telefono_uno_uno" class="form-control" value="{{ old('emergencia_telefono_uno_uno') }}">                     
                        @error('emergencia_telefono_uno_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Teléfono Secundario</strong></p>
                        <input type="text" name="emergencia_telefono_dos_uno" id="emergencia_telefono_dos_uno" class="form-control" value="{{ old('emergencia_telefono_dos_uno') }}">                     
                        @error('emergencia_telefono_dos_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>E-mail</strong></p>
                        <input type="text" name="emergencia_email_uno" id="emergencia_email_uno" class="form-control" value="{{ old('emergencia_email_uno') }}">                     
                        @error('emergencia_email_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="emergencia_calle_uno" id="emergencia_calle_uno" class="form-control" value="{{ old('emergencia_calle_uno') }}">                     
                        @error('emergencia_calle_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Número</strong></p>
                        <input type="text" name="emergencia_numero_uno" id="emergencia_numero_uno" class="form-control" value="{{ old('emergencia_numero_uno') }}">                     
                        @error('emergencia_numero_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Colonia</strong></p>
                        <input type="text" name="emergencia_colonia_uno" id="emergencia_colonia_uno" class="form-control" value="{{ old('emergencia_colonia_uno') }}">                     
                        @error('emergencia_colonia_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Código Postal</strong></p>
                        <input type="text" name="emergencia_codigo_postal_uno" id="emergencia_codigo_postal_uno" class="form-control" value="{{ old('emergencia_codigo_postal_uno') }}">                     
                        @error('emergencia_codigo_postal_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Municipio</strong></p>
                        <select name="emergencia_municipio_uno" id="emergencia_municipio_uno" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}" 
                                    {{ old('emergencia_municipio_uno') == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('emergencia_municipio_uno')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 2</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="emergencia_nombre_dos" id="emergencia_nombre_dos" class="form-control" value="{{ old('emergencia_nombre_dos') }}">                     
                        @error('emergencia_nombre_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-2">                        
                            <p><strong>Parentesco</strong></p>
                            <select name="emergencia_relacion_dos" id="emergencia_relacion_dos" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($relacionesDeEmergencia as $relacion)
                                    <option value="{{ $relacion->id }}" 
                                        {{ old('emergencia_relacion_dos') == $relacion->id ? 'selected' : '' }}>
                                        {{ $relacion->relacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('emergencia_relacion_dos')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <div class="col-md-2">
                        <p><strong>Teléfono Principal</strong></p>
                        <input type="text" name="emergencia_telefono_uno_dos" id="emergencia_telefono_uno_dos" class="form-control" value="{{ old('emergencia_telefono_uno_dos') }}">                     
                        @error('emergencia_telefono_uno_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Teléfono Secundario</strong></p>
                        <input type="text" name="emergencia_telefono_dos_dos" id="emergencia_telefono_dos_dos" class="form-control" value="{{ old('emergencia_telefono_dos_dos') }}">                     
                        @error('emergencia_telefono_dos_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>E-mail</strong></p>
                        <input type="text" name="emergencia_email_dos" id="emergencia_email_dos" class="form-control" value="{{ old('emergencia_email_dos') }}">                     
                        @error('emergencia_email_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="emergencia_calle_dos" id="emergencia_calle_dos" class="form-control" value="{{ old('emergencia_calle_dos') }}">                     
                        @error('emergencia_calle_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Número</strong></p>
                        <input type="text" name="emergencia_numero_dos" id="emergencia_numero_dos" class="form-control" value="{{ old('emergencia_numero_dos') }}">                     
                        @error('emergencia_numero_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Colonia</strong></p>
                        <input type="text" name="emergencia_colonia_dos" id="emergencia_colonia_dos" class="form-control" value="{{ old('emergencia_colonia_dos') }}">                     
                        @error('emergencia_colonia_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Código Postal</strong></p>
                        <input type="text" name="emergencia_codigo_postal_dos" id="emergencia_codigo_postal_dos" class="form-control" value="{{ old('emergencia_codigo_postal_dos') }}">                     
                        @error('emergencia_codigo_postal_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Municipio</strong></p>
                        <select name="emergencia_municipio_dos" id="emergencia_municipio_dos" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}" 
                                    {{ old('emergencia_municipio_dos') == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('emergencia_municipio_dos')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 3</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="emergencia_nombre_tres" id="emergencia_nombre" class="form-control" value="{{ old('emergencia_nombre_tres') }}">

                        @error('emergencia_nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-2">                        
                            <p><strong>Relación de Emergencia</strong></p>
                            <select name="emergencia_relacion_tres" id="emergencia_relacion_tres" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($relacionesDeEmergencia as $relacion)
                                    <option value="{{ $relacion->id }}" 
                                        {{ old('emergencia_relacion_tres') == $relacion->id ? 'selected' : '' }}>
                                        {{ $relacion->relacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('emergencia_relacion_tres')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <div class="col-md-2">
                        <p><strong>Teléfono Principal</strong></p>
                        <input type="text" name="emergencia_telefono_uno_tres" id="emergencia_telefono_uno_tres" class="form-control" value="{{ old('emergencia_telefono_uno_tres') }}">                     
                        @error('emergencia_telefono_uno_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Teléfono Secundario</strong></p>
                        <input type="text" name="emergencia_telefono_dos_tres" id="emergencia_telefono_dos_tres" class="form-control" value="{{ old('emergencia_telefono_dos_tres') }}">                     
                        @error('emergencia_telefono_dos_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>E-mail</strong></p>
                        <input type="text" name="emergencia_email_tres" id="emergencia_email_tres" class="form-control" value="{{ old('emergencia_email_tres') }}">                     
                        @error('emergencia_email_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="emergencia_calle_tres" id="emergencia_calle_tres" class="form-control" value="{{ old('emergencia_calle_tres') }}">                     
                        @error('emergencia_calle_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Número</strong></p>
                        <input type="text" name="emergencia_numero_tres" id="emergencia_numero_tres" class="form-control" value="{{ old('emergencia_numero_tres') }}">                     
                        @error('emergencia_numero_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Colonia</strong></p>
                        <input type="text" name="emergencia_colonia_tres" id="emergencia_colonia_tres" class="form-control" value="{{ old('emergencia_colonia_tres') }}">                     
                        @error('emergencia_colonia_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Código Postal</strong></p>
                        <input type="text" name="emergencia_codigo_postal_tres" id="emergencia_codigo_postal_tres" class="form-control" value="{{ old('emergencia_codigo_postal_tres') }}">                     
                        @error('emergencia_codigo_postal_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Municipio</strong></p>
                        <select name="emergencia_municipio_tres" id="emergencia_municipio_tres" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}" 
                                    {{ old('emergencia_municipio_tres') == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('emergencia_municipio_tres')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS</button>
        </div>

    </form>
</div>

<br>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop