@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Datos Generales</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

        </div>

        <form action="{{ route('datosGeneralesStore') }}" method="POST">

        @csrf 

        <!-- ------------------------------------------------ -->
        <!--    MANDAMOS LOS CAMPOS OCULTOS CON LOS VALORES   -->
        <!-- ------------------------------------------------ -->

        <input type="hidden" name="curp" value={{ $curp }}>
        <input type="hidden" name="rfc" value={{ $rfc }}>
        <input type="hidden" name="sexo" value={{ $sexo }}>
        <input type="hidden" name="fechaFormateada" value={{ $fechaFormateada }}>
        <input type="hidden" name="paisNacimiento" value={{ $paisNacimiento }}>
        <input type="hidden" name="entidadNacimiento" value={{ $entidad->nombre }}>
        <input type="hidden" name="nacionalidad" value={{ $nacionalidad }}>
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <p>CURP</p>
                        <input type="text" name="curp" id='curp' class="form-control" value="{{ $curp }}" disabled>
                        @error('curp')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>RFC</p>
                        <input type="text" name="rfc" id='rfc' class="form-control" value="{{ $rfc }}" disabled>
                        @error('rfc')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Homoclave</p>
                        <input type="text" name="homoclave" id='homoclave' class="form-control" value="{{ old('homoclave') }}">
                        @error('homoclave')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Sexo</p>
                        <input type="text" name="sexo" id='sexo' class="form-control" value="{{ $sexo }}" disabled>
                        @error('sexo')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Nombre(s)</p>
                        <input type="text" name="nombre" id='nombre' class="form-control" value="{{ $nombre }}" disabled>
                        @error('nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Apellido paterno</p>
                        <input type="text" name="apellido_paterno" id='apellido_paterno' class="form-control" value="{{ $apellidoPaterno }}" disabled>
                        @error('apellido_paterno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Apellido materno</p>
                        <input type="text" name="apellido_materno" id='apellido_materno' class="form-control" value="{{ $apellidoMaterno }}" disabled>
                        @error('apellido_materno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Fecha de nacimiento</p>
                        <input type="text" name="fecha_nacimiento" id='fecha_nacimiento' class="form-control" value="{{ $fechaFormateada }}" disabled>
                        @error('fecha_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Pais de nacimiento</p>
                        <input type="text" name="pais_nacimiento" id='pais_nacimiento' class="form-control" value="{{ $paisNacimiento }}" disabled>
                        @error('pais_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Entidad de nacimiento</p>
                        <input type="text" name="entidad_nacimiento" id='entidad_nacimiento' class="form-control" value="{{ $entidad->nombre }}" disabled>
                        @error('entidad_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Municipio de nacimiento</p>
                        <select name="municipio_nacimiento" id="municipio_nacimiento" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}" 
                                    {{ old('municipio_nacimiento') == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('municipio_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Nacionalidad</p>
                        <input type="text" name="nacionalidad" id='nacionalidad' class="form-control" value="{{ $nacionalidad }}" disabled>
                        @error('nacionalidad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Estado conyugal</p>
                        <select name="estado_conyugal" id="estado_conyugal" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($estadosConyuales as $estadoConyuale)
                                <option value="{{ $estadoConyuale->estado }}" 
                                    {{ old('estado_conyugal') == $estadoConyuale->estado ? 'selected' : '' }}>
                                    {{ $estadoConyuale->estado }}
                                </option>
                            @endforeach
                        </select>
                        @error('estado_conyugal')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Teléfono de casa</p>
                        <input type="text" name="telefono_casa" id='telefono_casa' class="form-control" value="{{ old('telefono_casa') }}">
                        @error('telefono_casa')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Celular</p>
                        <input type="text" name="celular" id='celular' class="form-control" value="{{ old('celular') }}">
                        @error('celular')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Correo eléctronico</p>
                        <input type="email" name="email" id='email' class="form-control" value="{{ old('email') }}">
                        @error('email')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS GENERALES</button>
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
@stop