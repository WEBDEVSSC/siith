@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Usuarios</strong> <small>Detalles</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('indexUsuario') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p><strong>Nombre</strong></p>
                        {{ $usuario->name }}                       
                    </div>

                    <div class="col-md-3">
                        <p><strong>Email</strong></p>
                        {{ $usuario->email }}                       
                    </div>

                    <div class="col-md-3">
                        <p><strong>Password</strong> <small>* No se muestra por motivos de seguridad</small></p>
                        ***********************         
                    </div>

                    <div class="col-md-3">
                        <p><strong>Unidad</strong></p>
                        J{{ $usuario->jurisdiccion_unidad }} - {{ $usuario->clues_unidad }} - {{ $usuario->nombre_unidad }}                    
                    </div>
                                    

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Responsable</strong></p>
                        {{ $usuario->responsable }}             
                    </div>

                    <div class="col-md-3">
                        <p><strong>Contacto</strong></p>
                        {{ $usuario->contacto }}            
                    </div>

                    <div class="col-md-3">
                        <p><strong>Rol</strong></p>
                        {{ $rol->label_rol }}          
                    </div>   

                </div>


        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            
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