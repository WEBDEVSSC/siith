@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>CLUES</strong> <small>Editar</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('indexClues') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <form action="{{ route('updateClues', $clue->id) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p><strong>CLUES</strong></p>     
                        <input type="text" name="clues" class="form-control" value="{{ old('clues', $clue->clues) }}">
                        @error('clues')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Municipio</strong></p>

                        <select name="municipio" id="municipio" class="form-control">
                            <option value="">-- SELECCIONA UN MUNICIPIO --</option>

                            @php
                                $municipios = [
                                    "ABASOLO", "ACUÑA", "ALLENDE", "ARTEAGA", "CANDELA", "CASTAÑOS",
                                    "CUATRO CIÉNEGAS", "ESCOBEDO", "FRANCISCO I. MADERO", "FRONTERA",
                                    "GENERAL CEPEDA", "GUERRERO", "HIDALGO", "JIMÉNEZ", "JUÁREZ",
                                    "LAMADRID", "MATAMOROS", "MONCLOVA", "MORELOS", "MÚZQUIZ",
                                    "NADADORES", "NAVA", "OCAMPO", "PARRAS", "PIEDRAS NEGRAS",
                                    "PROGRESO", "RAMOS ARIZPE", "SABINAS", "SACRAMENTO", "SALTILLO",
                                    "SAN BUENAVENTURA", "SAN JUAN DE SABINAS", "SAN PEDRO", "SIERRA MOJADA",
                                    "TORREÓN", "VIESCA", "VILLA UNIÓN", "ZARAGOZA"
                                ];
                            @endphp

                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio }}"
                                    {{ old('municipio', $clue->municipio) == $municipio ? 'selected' : '' }}>
                                    {{ $municipio }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-3">
                       <p><strong>Localidad</strong></p>
                        <input type="text" name="localidad" class="form-control" value="{{ old('localidad', $clue->localidad) }}">
                        @error('localidad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Jurisdicción</strong></p>

                        <select name="jurisdiccion" id="jurisdiccion" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="1" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '1' ? 'selected' : '' }}>J 1 - Piedras Negras</option>
                            <option value="2" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '2' ? 'selected' : '' }}>J 2 - Acuña</option>
                            <option value="3" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '3' ? 'selected' : '' }}>J 3 - Sabinas</option>
                            <option value="4" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '4' ? 'selected' : '' }}>J 4 - Piedras Negras</option>
                            <option value="5" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '5' ? 'selected' : '' }}>J 5 - Acuña</option>
                            <option value="6" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '6' ? 'selected' : '' }}>J 6 - Torreón</option>
                            <option value="7" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '7' ? 'selected' : '' }}>J 7 - San Pedro</option>
                            <option value="8" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '8' ? 'selected' : '' }}>J 8 - Saltillo</option>
                            <option value="9" {{ old('jurisdiccion', $clue->clave_jurisdiccion) == '9' ? 'selected' : '' }}>J 9 - Unidades de Apoyo</option>
                        </select>
                    </div>                

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-6">
                        <p><strong>Nombre</strong></p>
                        
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $clue->nombre) }}">
                        @error('nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Catalogo</strong></p>
                        
                        <select name="clave_establecimiento" id="clave_establecimiento" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="1" {{ old('jurisdiccion', $clue->clave_establecimiento) == '1' ? 'selected' : '' }}>CENTROS DE SALUD U y R</option>
                            <option value="2" {{ old('jurisdiccion', $clue->clave_establecimiento) == '2' ? 'selected' : '' }}>HOSPITALES</option>
                            <option value="3" {{ old('jurisdiccion', $clue->clave_establecimiento) == '3' ? 'selected' : '' }}>OF. JURISDICCIONAL</option>
                            <option value="4" {{ old('jurisdiccion', $clue->clave_establecimiento) == '4' ? 'selected' : '' }}>CRI CREE</option>
                            <option value="5" {{ old('jurisdiccion', $clue->clave_establecimiento) == '5' ? 'selected' : '' }}>SAMU CRUM</option>
                            <option value="6" {{ old('jurisdiccion', $clue->clave_establecimiento) == '6' ? 'selected' : '' }}>OF. CENTRAL</option>
                            <option value="7" {{ old('jurisdiccion', $clue->clave_establecimiento) == '7' ? 'selected' : '' }}>ALMACEN</option>
                            <option value="8" {{ old('jurisdiccion', $clue->clave_establecimiento) == '8' ? 'selected' : '' }}>CETS LESP</option>
                            <option value="9" {{ old('jurisdiccion', $clue->clave_establecimiento) == '9' ? 'selected' : '' }}>CORS</option>
                            <option value="10" {{ old('jurisdiccion', $clue->clave_establecimiento) == '9' ? 'selected' : '' }}>ISSREEI</option>
                            <option value="11" {{ old('jurisdiccion', $clue->clave_establecimiento) == '9' ? 'selected' : '' }}>CESAME</option>
                            <option value="12" {{ old('jurisdiccion', $clue->clave_establecimiento) == '9' ? 'selected' : '' }}>PSI. PARRAS</option>
                            <option value="13" {{ old('jurisdiccion', $clue->clave_establecimiento) == '9' ? 'selected' : '' }}>CEAM</option>
                            <option value="14" {{ old('jurisdiccion', $clue->clave_establecimiento) == '9' ? 'selected' : '' }}>HOSPITAL DEL NIÑO</option>
                            <option value="15" {{ old('jurisdiccion', $clue->clave_establecimiento) == '9' ? 'selected' : '' }}>PASANTES ENFERMERIA</option>
                        </select>
                    </div>

                    

                </div>


        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">

            <button type="submit" class="btn btn-info btn-sm">ACTUALIZAR DATOS</button>
            
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