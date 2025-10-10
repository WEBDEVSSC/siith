@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Cambio de Unidad</strong></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <strong>Datos generales del trabajador</strong>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">

               <center>
                    @if($fotoUrl)
                        <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" style="max-width:200px; height:auto;" class="img-thumbnail"/>
                    @else
                        <img src="{{ asset('images/avatar-placeholder.png') }}" alt="Sin foto" style="max-width:200px; height:auto;" class="img-thumbnail"/>
                    @endif
               </center>
                
            </div>

            <div class="col-md-6">
                <p><strong>Nombre:</strong> {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p>
                <p><strong>CURP:</strong> {{ $profesional->curp }}</p>
                <p><strong>RFC:</strong> {{ $profesional->rfc }} {{ $profesional->homoclave }}</p>
                <p><strong>CLUES Nómina:</strong> {{ $profesional->puesto->clues_nomina }} - {{ $profesional->puesto->clues_nomina_nombre }}</p>
                <p><strong>CLUES Adscripción:</strong> {{ $profesional->puesto->clues_adscripcion }} - {{ $profesional->puesto->clues_adscripcion_nombre }}</p>
            </div>
            <div class="col-md-3">
                
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
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                {{-- Contenido adicional --}}
                <form action="{{ route('storeCambioDeUnidad') }}" method="POST" enctype="multipart/form-data">
                    
                    @csrf

                    <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Tipo de movimiento</strong></p>
                            <select name="tipo_movimiento" id="tipo_movimiento" class="form-control">
                                <option value="">[-- Seleccione una opción --]</option>
                                <option value="1" {{ old('tipo_movimiento') == '1' ? 'selected' : '' }}>Regresa a su unidad de origen</option>
                                <option value="2" {{ old('tipo_movimiento') == '2' ? 'selected' : '' }}>Comisionado a mi unidad</option>
                                <option value="3" {{ old('tipo_movimiento') == '3' ? 'selected' : '' }}>Movimiento escalafonario</option>
                            </select>

                            @error('tipo_movimiento')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <p><strong>Unidad de destino</strong></p>
                            <select id="clues" name="clues" class="form-control select2">
                                <option value="">-- Selecciona una unidad --</option>
                                @foreach($clues as $clue)
                                    <option value="{{ $clue->id }}" {{ old('clues') == $clue->id ? 'selected' : '' }}>
                                        {{ $clue->clues }} - {{ $clue->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @error('clues')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

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

@include('partials.footer')

@section('css')
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
            $('#clues').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>  
@stop
