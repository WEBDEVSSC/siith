@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Identificación Personal</strong></h1>
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

        <form action="{{ route('storeIne', $profesional->id) }}" method="POST">

        @csrf 

        @method('POST')

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Clave de Elector</strong></p>
                        <input type="text" name="clave_elector" class="form-control" value="{{ old('clave_elector') }}">
                        @error('clave_elector')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Sección</strong></p>
                        <input type="text" name="seccion" class="form-control" value="{{ old('seccion') }}">
                        @error('seccion')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Vigencia</strong></p>
                        <input type="text" name="vigencia" class="form-control" value="{{ old('vigencia') }}">
                        @error('vigencia')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Distrito Local</strong></p>
                        <input type="text" name="dl" class="form-control" value="{{ old('dl') }}">
                        @error('dl')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Distrito Federal</strong></p>
                        <input type="text" name="df" class="form-control" value="{{ old('df') }}">
                        @error('df')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- -->

                

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