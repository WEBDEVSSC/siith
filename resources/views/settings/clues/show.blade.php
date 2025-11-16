@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>CLUES</strong> <small>Detalles</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('indexClues') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p><strong>CLUES</strong></p>
                        {{ $clue->clues }}                       
                    </div>

                    <div class="col-md-3">
                        <p><strong>Municipio</strong></p>
                        {{ $clue->municipio }}                       
                    </div>

                    <div class="col-md-3">
                       <p><strong>Localidad</strong></p>
                        {{ $clue->localidad }}       
                    </div>

                    <div class="col-md-3">
                        <p><strong>Jurisdiccion</strong></p>
                        {{ $clue->jurisdiccion }}              
                    </div>
                                    

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Nombre</strong></p>
                        {{ $clue->nombre }}             
                    </div>

                    <div class="col-md-3">
                        <p><strong>Catalogo / Cartera de Servicios</strong></p>
                        {{ $clue->clave_establecimiento }}    
                        
                        @if($clue->clave_establecimiento == 1)
                            {{ 'CENTROS DE SALUD URBANO Y RURAL' }}
                        @elseif($clue->clave_establecimiento == 2)
                            {{ 'HOSPITAL' }}
                        @elseif($clue->clave_establecimiento == 3)
                            {{ 'OFICINA JURISDICCIONAL' }}
                        @elseif($clue->clave_establecimiento == 4)
                            {{ 'CRI CREE' }}
                        @elseif($clue->clave_establecimiento == 5)
                            {{ 'SAMU CRUM' }}
                        @elseif($clue->clave_establecimiento == 6)
                            {{ 'OFICINA CENTRAL' }}
                        @elseif($clue->clave_establecimiento == 7)
                            {{ 'ALMACEN ESTATAL' }}
                        @elseif($clue->clave_establecimiento == 8)
                            {{ 'CETS LESP' }}
                        @elseif($clue->clave_establecimiento == 9)
                            {{ 'CORS' }}
                        @elseif($clue->clave_establecimiento == 10)
                            {{ 'ISSREEI' }}
                        @elseif($clue->clave_establecimiento == 11)
                            {{ 'CESAME' }}
                        @elseif($clue->clave_establecimiento == 12)
                            {{ 'PSI PARRAS' }}
                        @elseif($clue->clave_establecimiento == 13)
                            {{ 'CEAM' }}
                        @elseif($clue->clave_establecimiento == 14)
                            {{ 'HOSPITAL DEL NIÑO' }}
                        @elseif($clue->clave_establecimiento == 15)
                            {{ 'PASANTES DE ENFERMERIA' }}
                        @endif
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