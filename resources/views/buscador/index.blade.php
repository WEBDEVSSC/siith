@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Buscador</strong></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <strong>Buscador por CURP | Nombre | Apellido Paterno | Apellido Materno</strong>
    </div>
    <div class="card-body">

        <form action="{{ route('profesionalBuscadorCurp') }}" method="GET">

            @csrf

            <input type="text" name="curp" id="curp" class="form-control" value="{{ old('curp') }}">

            <br>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info btn-sm">BUSCAR DATOS</button>

        </form>

        

    </div>
</div>

{{--
    
<div class="card">
        <div class="card-header">

            <strong>Mostrar plantilla de unidad</strong>

        </div>

        <form action="{{ route('miJurisdiccionShow') }}" method="POST">

        @csrf 
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        
                        <select name="clues" id="clues" class="form-control select2">
                            <option value="">-- Selecciona una CLUES --</option>
                            @foreach($clues as $clue)
                                <option value="{{ $clue->clues }}">{{ $clue->clave_jurisdiccion }} - {{ $clue->clues }} - {{ $clue->nombre }}</option>
                            @endforeach
                        </select>

                        @error('curp')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">MOSTRAR PLANTILLA</button>
        </div>

    </form>
</div>

--}}

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
            $('#clues').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>  
@stop