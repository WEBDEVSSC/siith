@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Datos Generales</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>
            <a href="{{ route('profesionalIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>
            
        </div>

        <form action="{{ route('profesionalUpdate', $profesional->id) }}" method="POST">

        @csrf
        @method('PUT')

        <!-- ------------------------------------------------ -->
        <!--    MANDAMOS LOS CAMPOS OCULTOS CON LOS VALORES   -->
        <!-- ------------------------------------------------ -->

            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <p>CURP</p>
                        <input type="text" name="curp" id='curp' class="form-control" value="{{ $profesional->curp }}" disabled>
                        @error('curp')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>RFC</p>
                        <input type="text" name="rfc" id='rfc' class="form-control" value="{{ $profesional->rfc }}" disabled>
                        @error('rfc')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Homoclave</p>
                        <input type="text" name="homoclave" id='homoclave' class="form-control" value="{{ old('homoclave', $profesional->homoclave) }}">
                        @error('homoclave')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Sexo</p>
                        <input type="text" name="sexo" id='sexo' class="form-control" value="{{ $profesional->sexo }}" disabled>
                        @error('sexo')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Nombre(s)</p>
                        <input type="text" name="nombre" id='nombre' class="form-control" value="{{ old('nombre', $profesional->nombre) }}">
                        @error('nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Apellido paterno</p>
                        <input type="text" name="apellido_paterno" id='apellido_paterno' class="form-control" value="{{ old('apellido_paterno', $profesional->apellido_paterno) }}">
                        @error('apellido_paterno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Apellido materno</p>
                        <input type="text" name="apellido_materno" id='apellido_materno' class="form-control" value="{{ old('apellido_materno', $profesional->apellido_materno) }}">
                        @error('apellido_materno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Fecha de nacimiento</p>
                        <input type="text" name="fecha_nacimiento" id='fecha_nacimiento' class="form-control" value="{{ $profesional->fecha_nacimiento }}" disabled>
                        @error('fecha_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Pais de nacimiento</p>
                        <input type="text" name="pais_nacimiento" id='pais_nacimiento' class="form-control" value="{{ $profesional->pais_nacimiento }}" disabled>
                        @error('pais_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Entidad de nacimiento</p>
                        <input type="text" name="entidad_nacimiento" id='entidad_nacimiento' class="form-control" value="{{ $profesional->entidad_nacimiento }}" disabled>
                        @error('entidad_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Municipio de nacimiento</p>
                        <select name="municipio_nacimiento" id="municipio_nacimiento" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->nombre }}" 
                                    {{ old('municipio_nacimiento', $profesional->municipio_nacimiento ?? '') == $municipio->nombre ? 'selected' : '' }}>
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
                        <input type="text" name="nacionalidad" id='nacionalidad' class="form-control" value="{{ $profesional->nacionalidad }}" disabled>
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
                                    {{ old('estado_conyugal', $profesional->estado_conyugal ?? '') == $estadoConyuale->estado ? 'selected' : '' }}>
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
                        <input type="text" name="telefono_casa" id='telefono_casa' class="form-control" value="{{ old('telefono_casa', $profesional->telefono_casa) }}">
                        @error('telefono_casa')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Celular</p>
                        <input type="text" name="celular" id='celular' class="form-control" value="{{ old('celular', $profesional->celular) }}">
                        @error('celular')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Correo eléctronico</p>
                        <input type="email" name="email" id='email' class="form-control" value="{{ old('email' , $profesional->email) }}">
                        @error('email')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS GENERALES</button>
        </div>

    </form>
</div>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    <style>
        /* Asegura que Select2 tenga el mismo alto y bordes redondeados */
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px) !important; /* Ajuste de altura */
            border-radius: 0.25rem !important; /* Bordes redondeados */
            border: 1px solid #ced4da !important; /* Color del borde */
        }
        
        /* Alineación del texto */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: calc(2.25rem - 2px) !important;
            padding-left: 0.75rem !important;
        }
        
        /* Ajuste del ícono desplegable */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px) !important;
        }
    </style>

@stop

@section('js')
    
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
        $(document).ready(function() {
            $('#municipio_nacimiento').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>

@stop