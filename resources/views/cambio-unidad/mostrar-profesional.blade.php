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

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{-- Puedes agregar un título aquí si lo deseas --}}
            </div>
            <div class="card-body">
                {{-- Contenido adicional --}}
                <form action="{{ route('storeCambioDeUnidad') }}" method="POST" enctype="multipart/form-data">
                    
                    @csrf

                    <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">

                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Tipo de movimiento :</strong></p>
                            <select name="tipo_movimiento" id="tipo_movimiento" class="form-control">
                                <option value="">[-- Seleccione una opción --]</option>
                                <option value="1">Regresa a su unidad de origen</option>
                                <option value="2">Comisionado a otra unidad</option>
                                <option value="3">Movimiento Escalafonario</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p><strong>Documento de respaldo</strong></p>
                            <input type="file" name="documento_respaldo" class="form-control-file">
                        </div>
                        <div class="col-md-3">
                            <p><strong>Fecha de inicio</strong></p>
                            <input type="date" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <p><strong>Fecha de término</strong></p>
                            <input type="date" name="fecha_termino" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-sm">CAMBIAR DE UNIDAD</button>
            </div>
        </form>
        </div>
    </div>
</div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
