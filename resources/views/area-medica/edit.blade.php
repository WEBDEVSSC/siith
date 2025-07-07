@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Area Médica</small></h1>
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

        <form action="{{ route('updateAreaMedica', $areaMedica->id) }}" method="POST">

        @csrf 

        @method('PUT')

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p>Tipo de formación Area médica-enfermeria-profesional</p>
                        
                        <select name="tipo_formacion" id="tipo_formacion" class="form-control">
                            <option value="" disabled selected>Selecciona un tipo de formación</option>
                            @foreach ($tiposFormacion as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_formacion', $areaMedica->tipo_formacion_id) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->tipo }}
                                </option>
                            @endforeach
                        </select>                    
                        @error('tipo_formacion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Carrera</p>
                        <select name="carrera_id" id="carrera_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}" {{ old('carrera_id', $areaMedica->carrera_id) == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->carrera }}
                                </option>
                            @endforeach
                        </select>
                        @error('carrera_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Institución Educativa Formadora</p>
                        <select name="institucion_educativa_id" id="institucion_educativa_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($institucionesEducativas as $institucionEducativa)
                                <option value="{{ $institucionEducativa->id }}" {{ old('institucion_educativa_id', $areaMedica->institucion_educativa_id) == $institucionEducativa->id ? 'selected' : '' }}>
                                    {{ $institucionEducativa->institucion }}
                                </option>
                            @endforeach
                        </select>
                        @error('institucion_educativa_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Año que cursa</p>
                        <input type="text" name="anio_cursa" id="anio_cursa" class="form-control" value="{{ old('anio_cursa', $areaMedica->anio_cursa) }}">                 
                        @error('anio_cursa')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                   

                </div>

                <!-- -->

                <div class="row mt-3">
                    
                    <div class="col-md-3">
                        <p>Duración de Años de Formación</p>
                        <input type="text" name="duracion_formacion" id="duracion_formacion" class="form-control" value="{{ old('duracion_formacion', $areaMedica->duracion_formacion) }}">                     
                        @error('duracion_formacion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  
                    
                </div>

        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS DE AREA MEDICA</button>
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
            $('#carrera_id').select2({
                placeholder: "-- Selecciona una unidad --",
                allowClear: true
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('#institucion_educativa_id').select2({
            placeholder: "-- Selecciona una unidad --",
            allowClear: true
        });
    });
</script>
@stop