@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Grado Academico</strong>></h1>
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

            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>

        </div>

        <form action="{{ route('storeGrado') }}" method="POST" enctype="multipart/form-data">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->
                <!-- 1 -->
                <!-- ---------------------------------- -->

                <div class="row">
                    <div class="col-md-12">
                        <h5><strong>Grado Académico 1</strong></h5>
                    </div>
                </div>

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p><strong>Nivel Académico 1</strong></p>
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
                        <p><strong>Título 1</strong></p>
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
                        <p><strong>Institución Educativa 1</strong></p>
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
                        <p><strong>Cédula 1</strong></p>
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
                        <p><strong>Número 1</strong></p>
                        <input type="text" name="cedula_numero_uno" id="cedula_numero_uno" class="form-control">
                        @error('cedula_numero_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>   
                    
                    <div class="col-md-3">
                        <p><strong>Registro Nacional de Profesionales</strong></p>
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
                    <div class="col-md-12">
                        <h5><strong>Grado Académico 2</strong></h5>
                    </div>
                </div>

        <div class="row mt-3">      

            <div class="col-md-3">
                <p><strong>Grado Académico 2</strong></p>
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
                <p><strong>Título 2</strong></p>
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
                <p><strong>Institución Educativa 2</strong></p>
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
                <p><strong>Cédula 2</strong></p>
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
                <p><strong>Número 2</strong></p>
                <input type="text" name="cedula_numero_dos" id="cedula_numero_dos" class="form-control">
                @error('cedula_numero_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-3">
                <p><strong>Registro Nacional de Profesionales</strong></p>
                <input type="file" name="reg_nac_prof_dos" class="form-control-file">
                @error('reg_nac_prof_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            
        </div>

<!-- ---------------------------------------------------------------------- --> 

<!-- ---------------------------------- -->
                <!-- 2 -->
                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5><strong>Grado Académico 3</strong></h5>
                    </div>
                </div>

        <div class="row mt-3">      

            <div class="col-md-3">
                <p><strong>Grado Académico 3</strong></p>
                <select name="grado_academico_tres" id="grado_academico_tres" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($gradosAcademicos as $gradoAcademico)
                        <option value="{{ $gradoAcademico->cve }}" {{ old('grado_academico_tres') == $gradoAcademico->cve ? 'selected' : '' }}>
                            {{ $gradoAcademico->grado }}
                        </option>
                    @endforeach
                </select>
                @error('grado_academico_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>     
            
            <div class="col-md-9">
                <p><strong>Título 3</strong></p>
                <select name="titulo_tres" id="titulo_tres" class="form-control">
                    <option value="">-- Seleccione una opcion --</option>
                    @foreach($titulos as $titulo)
                        <option value="{{ $titulo->titulo }}" {{ old('titulo_tres') == $titulo->titulo ? 'selected' : '' }}>
                            {{ $titulo->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('titulo_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <!-- -->

        <div class="row mt-3">
            
            <div class="col-md-3">
                <p><strong>Institución Educativa 3</strong></p>
                <select name="institucion_educativa_tres" id="institucion_educativa_tres" class="form-control select2">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($institucionesEducativas as $institucioneEducativa)
                        <option value="{{ $institucioneEducativa->id }}" {{ old('institucion_educativa_tres') == $institucioneEducativa->id ? 'selected' : '' }}>
                            {{ $institucioneEducativa->institucion }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_educativa_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    
            
            <div class="col-md-3">
                <p><strong>Cédula 3</strong></p>
                <select name="cedula_tres" id="cedula_tres" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    <option value="SI" {{ old('cedula_tres') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('cedula_tres') == 'NO' ? 'selected' : '' }}>NO</option>
                    <option value="EN TRAMITE" {{ old('cedula_tres') == 'EN TRAMITE' ? 'selected' : '' }}>EN TRAMITE</option>
                </select>
                @error('cedula_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p><strong>Número 3</strong></p>
                <input type="text" name="cedula_numero_tres" id="cedula_numero_tres" class="form-control">
                @error('cedula_numero_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-3">
                <p><strong>Registro Nacional de Profesionales</strong></p>
                <input type="file" name="reg_nac_prof_tres" class="form-control-file">
                @error('reg_nac_prof_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            
        </div>

        <!-- -------------------------------------------------------------- -->

        <!-- ---------------------------------- -->
                <!-- 2 -->
                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5><strong>Grado Académico 4</strong></h5>
                    </div>
                </div>

        <div class="row mt-3">      

            <div class="col-md-3">
                <p><strong>Grado Académico 2</strong></p>
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
                <p><strong>Título 2</strong></p>
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
                <p><strong>Institución Educativa 2</strong></p>
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
                <p><strong>Cédula 2</strong></p>
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
                <p><strong>Número 2</strong></p>
                <input type="text" name="cedula_numero_dos" id="cedula_numero_dos" class="form-control">
                @error('cedula_numero_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-3">
                <p><strong>Registro Nacional de Profesionales</strong></p>
                <input type="file" name="reg_nac_prof_dos" class="form-control-file">
                @error('reg_nac_prof_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            
        </div>

        <!-- -------------------------------------------------------------- -->
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