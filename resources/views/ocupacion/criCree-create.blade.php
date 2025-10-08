@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Catálogo / Cartera de Servicios</strong> <small>CRI CREE</small></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">
    <ul>
        <li><strong>Nombre:</strong> {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
        <li><strong>CURP:</strong> {{ $profesional->curp }}</li>
    </ul>
</div>

<div class="card">
    <div class="card-header">
        <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>
    </div>

    <form action="{{ route('storeCriCree') }}" method="POST">
        @csrf
        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">

        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="ocupacion_uno">Ocupación 1</label>
                    <select name="ocupacion_uno" id="ocupacion_uno" class="form-control select2">
                        <option value="">-- Seleccione una opción --</option>
                        @foreach($ocupaciones as $ocupacion)
                            <option value="{{ $ocupacion->id }}">
                                {{ $ocupacion->unidad }} - {{ $ocupacion->area }} - {{ $ocupacion->subarea }} - {{ $ocupacion->ocupacion }}
                            </option>
                        @endforeach
                    </select>
                    @error('ocupacion_uno')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- 
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="ocupacion_dos">Ocupación 2</label>
                    <select name="ocupacion_dos" id="ocupacion_dos" class="form-control select2">
                        <option value="">-- Seleccione una opción --</option>
                        @foreach($ocupaciones as $ocupacion)
                            <option value="{{ $ocupacion->id }}">
                                {{ $ocupacion->unidad }} - {{ $ocupacion->area }} - {{ $ocupacion->subarea }} - {{ $ocupacion->ocupacion }}
                            </option>
                        @endforeach
                    </select>
                    @error('ocupacion_dos')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            --}}
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">REGISTRAR DATOS DE OCUPACIÓN</button>
        </div>
    </form>
</div>

@stop

@include('partials.footer')

@section('css')
<style>
    /* Ajustes de Select2 */
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
        border-radius: 0.25rem !important;
        border: 1px solid #ced4da !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: calc(2.25rem - 2px) !important;
        padding-left: 0.75rem !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }
</style>
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");

    $(document).ready(function() {
        // Inicializa Select2 para ocupacion_uno
        $('#ocupacion_uno').select2({
            placeholder: "-- Seleccione una opción --",
            allowClear: true
        });

        // Inicializa Select2 para ocupacion_dos si se habilita
        $('#ocupacion_dos').select2({
            placeholder: "-- Seleccione una opción --",
            allowClear: true
        });
    });
</script>
@stop
