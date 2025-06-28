@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>C.O.R.S.</small></h1>
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

    <form action="{{ route('updateCors', $profesionalOcupaciones->id) }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="card-body">
            <div class="row mt-3">      
                <div class="col-md-12">
                    <label for="ocupacion_uno">Ocupación 1</label>
                    <select name="ocupacion_uno" id="ocupacion_uno" class="form-control select2">
                        <option value="">-- Seleccione una opción --</option>
                        @foreach($ocupaciones as $ocupacion)
                            <option value="{{ $ocupacion->id }}" 
                                {{ old('ocupacion_uno', optional($profesionalOcupaciones)->id_catalogo_uno) == $ocupacion->id ? 'selected' : '' }}>
                                {{ $ocupacion->unidad }} - {{ $ocupacion->area }} - {{ $ocupacion->subarea_servicio }} - {{ $ocupacion->componente }} - {{ $ocupacion->ocupacion }}
                            </option>
                        @endforeach
                    </select>
                    @error('ocupacion_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>  
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="ocupacion_dos">Ocupación 2</label>
                    <select name="ocupacion_dos" id="ocupacion_dos" class="form-control select2">
                        <option value="">-- Seleccione una opción --</option>
                        @foreach($ocupaciones as $ocupacion)
                            <option value="{{ $ocupacion->id }}" 
                                {{ old('ocupacion_dos', optional($profesionalOcupaciones)->id_catalogo_dos) == $ocupacion->id ? 'selected' : '' }}>
                                {{ $ocupacion->unidad }} - {{ $ocupacion->area }} - {{ $ocupacion->subarea_servicio }} - {{ $ocupacion->componente }} - {{ $ocupacion->ocupacion }}
                            </option>
                        @endforeach
                    </select>
                    @error('ocupacion_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>  
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">REGISTRAR DATOS DE OCUPACIÓN</button>
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
            $('#ocupacion_uno').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>  

    <script>
        $(document).ready(function() {
            $('#ocupacion_dos').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>  
@stop