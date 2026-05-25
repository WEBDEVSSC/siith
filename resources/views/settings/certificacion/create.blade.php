@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Certificaciones</strong> <small>Nuevo registro</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('indexCertificacion') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <form action="{{ route('storeCertificacion') }}" method="POST">

                @csrf

                <div class="row mt-3">      

                    <div class="col-md-6">
                        <p><strong>Certificación</strong></p>     
                        <input type="text" name="certificacion" class="form-control" value="{{ old('certificacion') }}">
                        @error('certificacion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">

            <button type="submit" class="btn btn-info btn-sm">REGISTRAR DATOS</button>
            
            </form>
        </div>


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
            $('#clue_id').select2({
                placeholder: "-- Selecciona una unidad --",
                allowClear: true
            });
        });
    </script>
@stop