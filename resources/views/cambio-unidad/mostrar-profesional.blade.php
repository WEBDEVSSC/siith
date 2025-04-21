@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Cambio de Unidad</small></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <strong>Datos generales del trabajador</strong>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                @if($fotoUrl)
                    <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" width="200" class="img-thumbnail"/>
                @else
                    <p>No se ha cargado una fotografía.</p>
                @endif
            </div>

            <div class="col-md-9">
                <p><strong>Nombre:</strong> {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p>
                <p><strong>CURP:</strong> {{ $profesional->curp }}</p>
                <p><strong>RFC:</strong> {{ $profesional->rfc }} {{ $profesional->homoclave }}</p>
                <p><strong>CLUES Nómina:</strong> {{ $profesional->puesto->clues_nomina }} - {{ $profesional->puesto->clues_nomina_nombre }}</p>
                <p><strong>CLUES Adscripción:</strong> {{ $profesional->puesto->clues_adscripcion }} - {{ $profesional->puesto->clues_adscripcion_nombre }}</p>
            </div>
        </div>
    </div>
</div>

<!-- --------------------------------------------- -->

<a href="{{ route('createCambioDeUnidad', $profesional->id) }}"> SELECCIONAR TRABAJADOR</a>

<!-- --------------------------------------------- -->


@stop

@include('partials.footer')

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
