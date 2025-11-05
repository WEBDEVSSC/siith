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
                <form action="{{ route('documentoRespaldoStore', $cambio->id) }}" method="POST" enctype="multipart/form-data">
                    
                    @csrf

                    @method('PUT')                    

                    <div class="row mt-3">

                        <div class="col-md-6">
                            <p><strong>Documento de respaldo</strong></p>
                            <input type="file" name="documento_respaldo" class="form-control-file">

                            @error('documento_respaldo')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-sm">REGISTRAR DOCUMENTO</button>
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
