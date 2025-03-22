@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Certificaciones</small></h1>
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

            <a href="{{ route('profesionalIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

        <form action="{{ route('updateCertificacion', $certificacio->id) }}" method="POST">

        @csrf 

        @method('PUT')

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-6">
                        <p>Colegiación</p>                        
                        <select name="colegiacion_id" id="colegiacion_id" class="form-control">
                            <option value="" disabled selected>Selecciona un tipo de formación</option>
                            @foreach ($colegiaciones as $colegiacion)
                                <option value="{{ $colegiacion->id }}" {{ old('colegiacion_id', $certificacio->colegiacion_id) == $colegiacion->id ? 'selected' : '' }}>
                                    {{ $colegiacion->colegio }}
                                </option>
                            @endforeach
                        </select>                    
                        @error('colegiacion_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <p>Certificación</p>
                        <select name="certificacion_id" id="certificacion_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($certificaciones as $certificacion)
                                <option value="{{ $certificacion->id }}" {{ old('certificacion_id', $certificacio->certificacion_id) == $certificacion->id ? 'selected' : '' }}>
                                    {{ $certificacion->certificacion }}
                                </option>
                            @endforeach
                        </select>
                        @error('certificacion_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p>Idioma</p>
                        <select name="idioma_id" id="idioma_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($idiomas as $idioma)
                                <option value="{{ $idioma->id }}" {{ old('idioma_id', $certificacio->idioma_id) == $idioma->id ? 'selected' : '' }}>
                                    {{ $idioma->idioma }}
                                </option>
                            @endforeach
                        </select>
                        @error('idioma_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Nivel de dominio</p>
                        <select name="idioma_nivel_de_dominio" id="idioma_nivel_de_dominio" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="BASICO" {{ old('idioma_nivel_de_dominio', $certificacio->idioma_nivel_de_dominio) == 'BASICO' ? 'selected' : '' }}>BÁSICO</option>
                            <option value="MEDIO" {{ old('idioma_nivel_de_dominio', $certificacio->idioma_nivel_de_dominio) == 'MEDIO' ? 'selected' : '' }}>MEDIO</option>
                            <option value="AVANZADO" {{ old('idioma_nivel_de_dominio', $certificacio->idioma_nivel_de_dominio) == 'AVANZADO' ? 'selected' : '' }}>AVANZADO</option>
                        </select>            
                        @error('idioma_nivel_de_dominio')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>          
                    
                    <div class="col-md-3">
                        <p>Lengua Indigena</p>
                        <select name="lengua_indigena_id" id="lengua_indigena_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($lenguajes as $lenguaje)
                                <option value="{{ $lenguaje->id }}" {{ old('lengua_indigena_id', $certificacio->lengua_indigena_id) == $lenguaje->id ? 'selected' : '' }}>
                                    {{ $lenguaje->lenguaje }}
                                </option>
                            @endforeach
                        </select>
                        @error('lengua_indigena_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Nivel de dominio</p>
                        <select name="lengua_nivel_de_dominio" id="lengua_nivel_de_dominio" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            <option value="BASICO" {{ old('lengua_nivel_de_dominio', $certificacio->lengua_nivel_de_dominio) == 'BASICO' ? 'selected' : '' }}>BASICO</option>
                            <option value="MEDIO" {{ old('lengua_nivel_de_dominio', $certificacio->lengua_nivel_de_dominio) == 'MEDIO' ? 'selected' : '' }}>MEDIO</option>
                            <option value="AVANZADO" {{ old('lengua_nivel_de_dominio', $certificacio->lengua_nivel_de_dominio) == 'AVANZADO' ? 'selected' : '' }}>AVANZADO</option>
                        </select>               
                        @error('lengua_nivel_de_dominio')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>          

                </div>

        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS DE CERTIFICACIONES</button>
        </div>

    </form>
</div>

@stop

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
            $('#colegiacion_id').select2({
                placeholder: "-- Selecciona una opcion --",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#certificacion_id').select2({
                placeholder: "-- Selecciona una opcion --",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#lengua_indigena_id').select2({
                placeholder: "-- Selecciona una opcion --",
                allowClear: true
            });
        });
    </script>
@stop