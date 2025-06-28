@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Grado Academico</small></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">

    <ul>
        <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
        <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
    </ul>
    
</div>
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('profesionalIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

        <form action="{{ route('storeGrado') }}" method="POST" enctype="multipart/form-data">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->
                <!-- 1 -->
                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p>Grado académico 1</p>
                        <select name="grado_academico_uno" id="grado_academico_uno" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($gradosAcademicos as $gradoAcademico)
                                <option value="{{ $gradoAcademico->cve }}" {{ old('grado_academico_uno') == $gradoAcademico->cve ? 'selected' : '' }}>
                                    {{ $gradoAcademico->grado }}
                                </option>
                            @endforeach
                        </select>
                        @error('grado_academico_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>     
                    
                    <div class="col-md-9">
                        <p>Titulo 1</p>
                        <select name="titulo_uno" id="titulo_uno" class="form-control">
                            <option value="">-- Seleccione una opcion --</option>
                            @foreach($titulos as $titulo)
                                <option value="{{ $titulo->titulo }}" {{ old('titulo_uno') == $titulo->titulo ? 'selected' : '' }}>
                                    {{ $titulo->titulo }}
                                </option>
                            @endforeach
                        </select>
                        @error('titulo_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">
                    
                    <div class="col-md-3">
                        <p>Institucion Educativa 1</p>
                        <select name="institucion_educativa_uno" id="institucion_educativa_uno" class="form-control select2">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($institucionesEducativas as $institucioneEducativa)
                                <option value="{{ $institucioneEducativa->id }}" {{ old('institucion_educativa_uno') == $institucioneEducativa->id ? 'selected' : '' }}>
                                    {{ $institucioneEducativa->institucion }}
                                </option>
                            @endforeach
                        </select>
                        @error('institucion_educativa_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    
                    
                    <div class="col-md-3">
                        <p>Cedula 1</p>
                        <select name="cedula_uno" id="cedula_uno" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('cedula_uno') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('cedula_uno') == 'NO' ? 'selected' : '' }}>NO</option>
                            <option value="EN TRAMITE" {{ old('cedula_uno') == 'EN TRAMITE' ? 'selected' : '' }}>EN TRAMITE</option>
                        </select>
                        @error('cedula_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    

                    <div class="col-md-3">
                        <p>Número 1</p>
                        <input type="text" name="cedula_numero_uno" id="cedula_numero_uno" class="form-control">
                        @error('cedula_numero_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>   
                    
                    <div class="col-md-3">
                        <p>Registro Nacional de Profesionales</p>
                        <input type="file" name="reg_nac_prof_uno" id="reg_nac_prof_uno" class="form-control-file">
                        @error('reg_nac_prof_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    
                    
                    
                </div>

                <!-- ---------------------------------- -->
                <!-- 2 -->
                <!-- ---------------------------------- -->

        <div class="row mt-3">      

            <div class="col-md-3">
                <p>Grado académico 2</p>
                <select name="grado_academico_dos" id="grado_academico_dos" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($gradosAcademicos as $gradoAcademico)
                        <option value="{{ $gradoAcademico->cve }}" {{ old('grado_academico_dos') == $gradoAcademico->cve ? 'selected' : '' }}>
                            {{ $gradoAcademico->grado }}
                        </option>
                    @endforeach
                </select>
                @error('grado_academico_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>     
            
            <div class="col-md-9">
                <p>Titulo 2</p>
                <select name="titulo_dos" id="titulo_dos" class="form-control">
                    <option value="">-- Seleccione una opcion --</option>
                    @foreach($titulos as $titulo)
                        <option value="{{ $titulo->titulo }}" {{ old('titulo_dos') == $titulo->titulo ? 'selected' : '' }}>
                            {{ $titulo->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('titulo')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <!-- -->

        <div class="row mt-3">
            
            <div class="col-md-3">
                <p>Institucion Educativa 2</p>
                <select name="institucion_educativa_dos" id="institucion_educativa_dos" class="form-control select2">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($institucionesEducativas as $institucioneEducativa)
                        <option value="{{ $institucioneEducativa->id }}" {{ old('institucion_educativa_dos') == $institucioneEducativa->id ? 'selected' : '' }}>
                            {{ $institucioneEducativa->institucion }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_educativa_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    
            
            <div class="col-md-3">
                <p>Cedula 2</p>
                <select name="cedula_dos" id="cedula_dos" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    <option value="SI" {{ old('cedula_uno') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('cedula_uno') == 'NO' ? 'selected' : '' }}>NO</option>
                    <option value="EN TRAMITE" {{ old('cedula_uno') == 'EN TRAMITE' ? 'selected' : '' }}>EN TRAMITE</option>
                </select>
                @error('cedula_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p>Número 2</p>
                <input type="text" name="cedula_numero_dos" id="cedula_numero_dos" class="form-control">
                @error('cedula_numero_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-3">
                <p>Registro Nacional de Profesionales</p>
                <input type="file" name="reg_nac_prof_dos" class="form-control-file">
                @error('reg_nac_prof_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            
        </div>

<!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS DE GRADO ACADEMICO</button>
        </div>

    </form>
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
            $('#institucion_educativa_uno, #institucion_educativa_dos').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script> 
    
    <script>
        $(document).ready(function(){
            // Deshabilitar los select de títulos al cargar la página
            $('#titulo_uno, #titulo_dos').prop('disabled', true);
    
            function cargarTitulos(gradoSelect, tituloSelect) {
                let gradoCve = $(gradoSelect).val(); // Obtener el valor seleccionado
                $(tituloSelect).empty().append('<option value="">-- Seleccione un título --</option>');
    
                if(gradoCve) {
                    $(tituloSelect).prop('disabled', false);
                    
                    $.ajax({
                        url: `/titulos/${gradoCve}`,
                        type: 'GET',
                        success: function(response) {
                            $.each(response, function(id, titulo){
                                $(tituloSelect).append(`<option value="${id}">${titulo}</option>`);
                            });
                        },
                        error: function() {
                            alert("Error al obtener los títulos.");
                        }
                    });
                } else {
                    $(tituloSelect).prop('disabled', true);
                }
            }
    
            // Evento para el primer grado académico
            $('#grado_academico_uno').change(function(){
                cargarTitulos('#grado_academico_uno', '#titulo_uno');
            });
    
            // Evento para el segundo grado académico
            $('#grado_academico_dos').change(function(){
                cargarTitulos('#grado_academico_dos', '#titulo_dos');
            });
        });
    </script>
    
    
    
    
    
@stop