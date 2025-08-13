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
            <a href="{{ route('profesionalIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

        <form action="{{ route('storeEmergencia') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

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
                        <p><strong>Alergía</strong></p>
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

                    <div class="col-md-6">
                        <p><strong>Describa brevemente</strong></p>
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
                        <p><strong>Medicamentos que toma regularmente</strong></p>
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

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>Médico de cabecera</strong></p>
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

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>Contacto de Emergencia</strong></p>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="emergencia_nombre" id="emergencia_nombre" class="form-control" value="{{ old('emergencia_nombre') }}">                     
                        @error('emergencia_nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-3">
                        <p><strong>Relación</strong></p>
                        <input type="text" name="emergencia_relacion" id="emergencia_relacion" class="form-control" value="{{ old('emergencia_relacion') }}">                     
                        @error('emergencia_relacion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <p><strong>Telefono Principal</strong></p>
                        <input type="text" name="emergencia_telefono_uno" id="emergencia_telefono_uno" class="form-control" value="{{ old('emergencia_telefono_uno') }}">                     
                        @error('emergencia_telefono_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Teléfono Secundario</strong></p>
                        <input type="text" name="emergencia_telefono_dos" id="emergencia_telefono_dos" class="form-control" value="{{ old('emergencia_telefono_dos') }}">                     
                        @error('emergencia_telefono_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>E-mail</strong></p>
                        <input type="text" name="emergencia_email" id="emergencia_email" class="form-control" value="{{ old('emergencia_email') }}">                     
                        @error('emergencia_email')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <!-- -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>Dirección</strong></p>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="emergencia_calle" id="emergencia_calle" class="form-control" value="{{ old('emergencia_calle') }}">                     
                        @error('emergencia_calle')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Número</strong></p>
                        <input type="text" name="emergencia_numero" id="emergencia_numero" class="form-control" value="{{ old('emergencia_numero') }}">                     
                        @error('emergencia_numero')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Colónia</strong></p>
                        <input type="text" name="emergencia_colonia" id="emergencia_colonia" class="form-control" value="{{ old('emergencia_colonia') }}">                     
                        @error('emergencia_colonia')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Municipio</strong></p>
                        <select name="emergencia_municipio" id="emergencia_municipio" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}" 
                                    {{ old('emergencia_municipio') == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('emergencia_municipio')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS DE EMERGENCIA</button>
        </div>

    </form>
</div>

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