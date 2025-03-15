@extends('adminlte::page')

@section('title', 'Dashboard')

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

        <form action="{{ route('storeGrado') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->
                <!-- 1 -->
                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p>Grado académico</p>
                        <select name="grado_academico" id="grado_academico" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($gradosAcademicos as $gradoAcademico)
                                <option value="{{ $gradoAcademico->cve }}" {{ old('grado_academico') == $gradoAcademico->cve ? 'selected' : '' }}>
                                    {{ $gradoAcademico->grado }}
                                </option>
                            @endforeach
                        </select>
                        @error('grado_academico')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>     
                    
                    <div class="col-md-9">
                        <p>Titulo</p>
                        <select name="titulo" id="titulo" class="form-control">
                            <option value="">Seleccione una vigencia</option>
                            @foreach($titulos as $titulo)
                                <option value="{{ $titulo->titulo }}" {{ old('titulo') == $titulo->titulo ? 'selected' : '' }}>
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
                        <p>Institucion Educativa</p>
                        <select name="institucion_educativa" id="institucion_educativa" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($institucionesEducativas as $institucioneEducativa)
                                <option value="{{ $institucioneEducativa->id }}" {{ old('institucion_educativa') == $institucioneEducativa->id ? 'selected' : '' }}>
                                    {{ $institucioneEducativa->institucion }}
                                </option>
                            @endforeach
                        </select>
                        @error('institucion_educativa')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    
                    
                    <div class="col-md-3">
                        <p>Cedula</p>
                        <select name="cedula" id="cedula" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        @error('cedula')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    

                    <div class="col-md-3">
                        <p>Número</p>
                        <input type="text" name="cedula_numero" id="cedula_numero" class="form-control">
                        @error('cedula_numero')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    
                    
                    
                </div>

                <!-- ---------------------------------- -->
                <!-- 2 -->
                <!-- ---------------------------------- -->

        <div class="row mt-3">      

            <div class="col-md-3">
                <p>Grado académico</p>
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
                <p>Titulo</p>
                <select name="titulo_dos" id="titulo_dos" class="form-control">
                    <option value="">Seleccione una vigencia</option>
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
                <p>Institucion Educativa</p>
                <select name="institucion_educativa_dos" id="institucion_educativa_dos" class="form-control">
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
                <p>Cedula</p>
                <select name="cedula_dos" id="cedula_dos" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
                @error('cedula_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p>Número</p>
                <input type="text" name="cedula_numero_dos" id="cedula_numero_dos" class="form-control">
                @error('cedula_numero_dos')
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

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function(){
            // Deshabilitar los select de títulos al cargar la página
            $('#titulo, #titulo_dos').prop('disabled', true);
    
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
            $('#grado_academico').change(function(){
                cargarTitulos('#grado_academico', '#titulo');
            });
    
            // Evento para el segundo grado académico
            $('#grado_academico_dos').change(function(){
                cargarTitulos('#grado_academico_dos', '#titulo_dos');
            });
        });
    </script>
    
    
    
    
    
@stop