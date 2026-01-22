@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Datos Generales</strong></h1>
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
                        <p><strong>CURP</strong></p>
                        <input type="text" name="curp" id='curp' class="form-control" value="{{ $curp }}" disabled>

                        @error('curp')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>RFC</strong></p>
                        <input type="text" name="rfc" id='rfc' class="form-control" value="{{ $rfc }}" disabled>

                        @error('rfc')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Homoclave</strong></p>
                        <input type="text" name="homoclave" id='homoclave' class="form-control" value="{{ old('homoclave') }}">

                        @error('homoclave')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Sexo</strong></p>
                        <input type="text" name="sexo" id='sexo' class="form-control" value="{{ $sexo }}" disabled>

                        @error('sexo')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Nombre(s)</strong></p>

                        @if (empty($nombre))
                            <input type="text" name="nombre" id='nombre' class="form-control" value="{{ old('nombre') }}" onpaste="return false">
                        @else
                            <input type="text" name="nombre" id='nombre' class="form-control" value="{{ $nombre }}" disabled>
                        @endif
                        
                        @error('nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Apellido paterno</strong></p>

                        @if (empty($apellidoPaterno))
                            <input type="text" name="apellido_paterno" id='apellido_paterno' class="form-control" value="{{ old('apellido_paterno') }}" onpaste="return false">
                        @else
                            <input type="text" name="apellido_paterno" id='apellido_paterno' class="form-control" value="{{ $apellidoPaterno }}" disabled>
                        @endif
                        
                        @error('apellido_paterno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Apellido materno</strong></p>

                        @if (empty($apellidoPaterno))
                            <input type="text" name="apellido_materno" id='apellido_materno' class="form-control" value="{{ old('apellido_materno') }}" onpaste="return false">
                        @else
                            <input type="text" name="apellido_materno" id='apellido_materno' class="form-control" value="{{ $apellidoMaterno }}" disabled>
                        @endif

                        @error('apellido_materno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Fecha de nacimiento</strong></p>
                        <input type="text" name="fecha_nacimiento" id='fecha_nacimiento' class="form-control" value="{{ $fechaFormateada }}" disabled>

                        @error('fecha_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------- -->

                

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>País de nacimiento</strong></p>

                        <select name="pais_nacimiento" id="pais_nacimiento" class="form-control select2"  {{ $nacionalidad === 'MEXICANA' ? 'disabled' : '' }}>
                            <option value="">-- Seleccione una opción --</option>
                            @foreach ($paisNacimiento as $pais)                                
                                <option value="{{ $pais->pais }}"
                                    {{ old('pais_nacimiento') == $pais->pais || $nacionalidad === 'MEXICANA' ? 'selected' : '' }}>
                                    {{ $pais->pais }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Input oculto para enviar el valor cuando esté disabled --}}
                        @if($nacionalidad === 'MEXICANA')
                            <input type="hidden" name="pais_nacimiento" value="{{ $paisNacimiento->first()->pais }}">
                        @endif

                        @error('pais_nacimiento')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--<div class="col-md-3">
                        <p><strong>Pais de nacimiento</strong></p>
                        <input type="text" name="pais_nacimiento" id='pais_nacimiento' class="form-control" value="{{ $paisNacimiento }}" disabled>

                        @error('pais_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>--}}
                    <div class="col-md-3">
                        <p><strong>Entidad de nacimiento</strong></p>
                        <input type="text" name="entidad_nacimiento" id='entidad_nacimiento' class="form-control" value="{{ $entidad->nombre }}" disabled>

                        @error('entidad_nacimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Municipio de nacimiento</strong></p>
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
                        <p><strong>Nacionalidad</strong></p>

                        @if ($nacionalidad == "MEXICANA")

                            <input type="text" name="nacionalidad" id='nacionalidad' class="form-control" value="{{ $nacionalidad }}" disabled>
                        
                        @else

                            <select name="nacionalidad" id="nacionalidad" class="form-control">
                                <option value="">-- Seleccione una opación --</option>
                                <option value="MEXICANA" {{ old('nacionalidad') === 'MEXICANA' ? 'selected' : '' }}>MEXICANA</option>
                                <option value="EXTRANJERA"{{ old('nacionalidad') === 'EXTRANJERA' ? 'selected' : '' }}>EXTRANJERA</option>
                            </select>

                        @endif

                        @error('nacionalidad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- ---------------------------------------------------- -->
                    </div>
                </div>

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Estado civil</strong></p>
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
                        <p><strong>Teléfono de casa</strong></p>
                        <input type="text" name="telefono_casa" id='telefono_casa' class="form-control" value="{{ old('telefono_casa') }}">

                        @error('telefono_casa')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Celular</strong></p>
                        <input type="text" name="celular" id='celular' class="form-control" value="{{ old('celular') }}">

                        @error('celular')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Correo eléctronico</strong></p>
                        <input type="email" name="email" id='email' class="form-control" value="{{ old('email') }}">

                        @error('email')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Padre / Madre de familia</strong></p>
                        <select name="padre_madre_familia" id="padre_madre_familia" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('padre_madre_familia') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('padre_madre_familia') == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>

                        @error('padre_madre_familia')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Fecha de ingreso a la Institución</strong></p>
                        <input type="date" name="fecha_inicio" id='fecha_inicio' class="form-control" value="{{ old('fecha_inicio') }}">
                        
                        @error('fecha_inicio')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <p><strong>CLUES Adscripción Física</strong></p>
                        <select name="clues_adscripcion" id="clues_adscripcion" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @forelse ($cluesAdscripcion as $clueAdscripcion)
                                <option value="{{ $clueAdscripcion->clues }}" 
                                    {{ old('clues_adscripcion', $profesional->clues_adscripcion ?? '') == $clueAdscripcion->clues ? 'selected' : '' }}>
                                    {{ $clueAdscripcion->clave_jurisdiccion }} - {{ $clueAdscripcion->nombre }}
                                </option>
                            @empty
                                <option value="">No hay registros disponibles</option>
                            @endforelse
                        </select>

                        @error('clues_adscripcion')
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

<br>

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
            $('#clues_adscripcion').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#pais_nacimiento').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>
@stop