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
                
            </div>

            <div class="col-md-6">
                <p><strong>Nombre:</strong> {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p>
                <p><strong>CURP:</strong> {{ $profesional->curp }}</p>
                <p><strong>RFC:</strong> {{ $profesional->rfc }} {{ $profesional->homoclave }}</p>
                <p><strong>CLUES Nómina:</strong> {{ $profesional->puesto->clues_nomina }} - {{ $profesional->puesto->clues_nomina_nombre }}</p>
                <p><strong>CLUES Adscripción:</strong> {{ $profesional->puesto->clues_adscripcion }} - {{ $profesional->puesto->clues_adscripcion_nombre }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Destino :</strong>  {{$clues->clues}} - {{ $clues->nombre }}</p>
                <p><strong>Municipio :</strong>  {{$clues->municipio}}</p>
                <p><strong>Jurisdicción :</strong>  {{$clues->clave_jurisdiccion}}</p>
                <p><strong>Catalogo ocupación :</strong>  {{$clues->clave_establecimiento}}</p>
            </div>
        </div>
    </div>
</div>

<!-- --------------------------------------------- -->



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
                    <input type="hidden" name="clues_adscripcion" value="{{ $clues->clues }}">
                    <input type="hidden" name="clues_adscripcion_nombre" value="{{ $clues->nombre }}">
                    <input type="hidden" name="clues_adscripcion_municipio" value="{{ $clues->municipio }}">
                    <input type="hidden" name="clues_adscripcion_jurisdiccion" value="{{ $clues->clave_jurisdiccion }}">
                    <input type="hidden" name="clues_adscripcion_tipo" value="{{$clues->clave_establecimiento}}">

                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Tipo de movimiento :</strong></p>
                            <select name="tipo_movimiento" id="tipo_movimiento" class="form-control">
                                <option value="">[-- Seleccione una opción --]</option>
                                <option value="1" {{ old('tipo_movimiento') == '1' ? 'selected' : '' }}>Regresa a su unidad de origen</option>
                                <option value="2" {{ old('tipo_movimiento') == '2' ? 'selected' : '' }}>Comisionado a otra unidad</option>
                                <option value="3" {{ old('tipo_movimiento') == '3' ? 'selected' : '' }}>Movimiento Escalafonario</option>
                            </select>
                        </div>
                    </div>
                    @error('tipo_movimiento')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mt-3">

                        <div class="col-md-6">
                            <p><strong>Documento de respaldo</strong></p>
                            <input type="file" name="documento_respaldo" class="form-control-file">

                            @error('documento_respaldo')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-3">
                            <p><strong>Fecha de inicio</strong></p>
                            <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
                        
                            @error('fecha_inicio')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-3">
                            <p><strong>Fecha de término</strong></p>
                            <input type="date" name="fecha_termino" class="form-control" value="{{ old('fecha_termino') }}">
                        
                            @error('fecha_termino')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
