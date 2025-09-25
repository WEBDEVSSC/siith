@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Certificaciones</strong></h1>
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

        <form action="{{ route('storeCertificacion') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-6">
                        <p><strong>Colegiación</strong></p>                        
                        <select name="colegiacion_id" id="colegiacion_id" class="form-control">
                            <option value="" disabled selected>Selecciona un tipo de formación</option>
                            @foreach ($colegiaciones as $colegiacion)
                                <option value="{{ $colegiacion->id }}" {{ old('colegiacion_id') == $colegiacion->id ? 'selected' : '' }}>
                                    {{ $colegiacion->colegio }}
                                </option>
                            @endforeach
                        </select>                    
                        @error('colegiacion_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <p><strong>Certificación</strong></p>
                        <select name="certificacion_id" id="certificacion_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($certificaciones as $certificacion)
                                <option value="{{ $certificacion->id }}" {{ old('certificacion_id') == $certificacion->id ? 'selected' : '' }}>
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
                        <p><strong>Idioma</strong></p>
                        <select name="idioma_id" id="idioma_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($idiomas as $idioma)
                                <option value="{{ $idioma->id }}" {{ old('idioma_id') == $idioma->id ? 'selected' : '' }}>
                                    {{ $idioma->idioma }}
                                </option>
                            @endforeach
                        </select>
                        @error('idioma_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Nivel de Dominio</strong></p>
                        <select name="idioma_nivel_de_dominio" id="idioma_nivel_de_dominio" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            <option value="BASICO">BASICO</option>
                            <option value="MEDIO">MEDIO</option>
                            <option value="AVANZADO">AVANZADO</option>
                        </select>               
                        @error('idioma_nivel_de_dominio')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>          
                    
                    <div class="col-md-3">
                        <p><strong>Lengua Indígena</strong></p>
                        <select name="lengua_indigena_id" id="lengua_indigena_id" class="form-control select2">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($lenguajes as $lenguaje)
                                <option value="{{ $lenguaje->id }}" {{ old('lengua_indigena_id') == $lenguaje->id ? 'selected' : '' }}>
                                    {{ $lenguaje->lenguaje }}
                                </option>
                            @endforeach
                        </select>
                        @error('lengua_indigena_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Nivel de Dominio</strong></p>
                        <select name="lengua_nivel_de_dominio" id="lengua_nivel_de_dominio" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            <option value="BASICO">BASICO</option>
                            <option value="MEDIO">MEDIO</option>
                            <option value="AVANZADO">AVANZADO</option>
                        </select>               
                        @error('anio_cursa')
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