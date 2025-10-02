@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Grado Academico</strong></h1>
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
                        <blockquote class="quote-secondary">
                            <h4>Grado Académico 1</h4>
                        </blockquote>
                    </div>
                </div>

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p><strong>Nivel Académico</strong></p>
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
                        <p><strong>Título</strong></p>
                        <select name="titulo_uno" id="titulo_uno" class="form-control select2">
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
                        <p><strong>Institución Educativa</strong></p>
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
                        <p><strong>Cédula</strong></p>
                        <select name="cedula_uno" id="cedula_uno" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('cedula_uno') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('cedula_uno') == 'NO' ? 'selected' : '' }}>NO</option>
                            <option value="EN TRAMITE" {{ old('cedula_uno') == 'EN TRAMITE' ? 'selected' : '' }}>EN TRAMITE</option>
                            <option value="CARTA PASANTE" {{ old('cedula_uno') == 'CARTA PASANTE' ? 'selected' : '' }}>CARTA PASANTE</option>
                            <option value="TRUNCA" {{ old('cedula_uno') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                        </select>
                        @error('cedula_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    

                    <div class="col-md-3">
                        <p><strong>Número</strong></p>
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

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>* Observaciones</strong></p>
                        <input type="text" name="observaciones_uno" id="observaciones_uno" class="form-control" value="{{ old('observaciones_uno', $gradoAcademico->observaciones_uno)}}">

                        @error('observaciones_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------- -->
                <!-- 2 -->
                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Grado Académico 2</h4>
                        </blockquote>
                    </div>
                </div>

        <div class="row mt-3">      

            <div class="col-md-3">
                <p><strong>Grado Académico</strong></p>
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
                <p><strong>Título</strong></p>
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
                <p><strong>Institución Educativa</strong></p>
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
                <p><strong>Cédula</strong></p>
                <select name="cedula_dos" id="cedula_dos" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    <option value="SI" {{ old('cedula_dos') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('cedula_dos') == 'NO' ? 'selected' : '' }}>NO</option>
                    <option value="EN TRAMITE" {{ old('cedula_dos') == 'EN TRAMITE' ? 'selected' : '' }}>EN TRAMITE</option>
                    <option value="CARTA PASANTE" {{ old('cedula_dos') == 'CARTA PASANTE' ? 'selected' : '' }}>CARTA PASANTE</option>
                    <option value="TRUNCA" {{ old('cedula_dos') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                </select>
                @error('cedula_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p><strong>Número</strong></p>
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

        <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>* Observaciones</strong></p>
                        <input type="text" name="observaciones_dos" id="observaciones_dos" class="form-control" value="{{ old('observaciones_dos', $gradoAcademico->observaciones_dos)}}">

                        @error('observaciones_dos')
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

                        <blockquote class="quote-secondary">
                            <h4>Grado Académico 3</h4>
                        </blockquote>

                    </div>
                </div>

        <div class="row mt-3">      

            <div class="col-md-3">
                <p><strong>Grado Académico</strong></p>
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
                <p><strong>Título</strong></p>
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
                <p><strong>Institución Educativa</strong></p>
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
                <p><strong>Cédula</strong></p>
                <select name="cedula_tres" id="cedula_tres" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    <option value="SI" {{ old('cedula_tres') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('cedula_tres') == 'NO' ? 'selected' : '' }}>NO</option>
                    <option value="EN TRAMITE" {{ old('cedula_tres') == 'EN TRAMITE' ? 'selected' : '' }}>EN TRAMITE</option>
                    <option value="CARTA PASANTE" {{ old('cedula_tres') == 'CARTA PASANTE' ? 'selected' : '' }}>CARTA PASANTE</option>
                    <option value="TRUNCA" {{ old('cedula_tres') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                </select>
                @error('cedula_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p><strong>Número</strong></p>
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

        <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>* Observaciones</strong></p>
                        <input type="text" name="observaciones_tres" id="observaciones_tres" class="form-control" value="{{ old('observaciones_tres', $gradoAcademico->observaciones_tres)}}">

                        @error('observaciones_tres')
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
                        <blockquote class="quote-secondary">
                            <h4>Grado Académico 4</h4>
                        </blockquote>
                    </div>
                </div>

        <div class="row mt-3">      

            <div class="col-md-3">
                <p><strong>Grado Académico</strong></p>
                <select name="grado_academico_cuatro" id="grado_academico_cuatro" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($gradosAcademicos as $gradoAcademico)
                        <option value="{{ $gradoAcademico->cve }}" {{ old('grado_academico_cuatro') == $gradoAcademico->cve ? 'selected' : '' }}>
                            {{ $gradoAcademico->grado }}
                        </option>
                    @endforeach
                </select>
                @error('grado_academico_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>     
            
            <div class="col-md-9">
                <p><strong>Título</strong></p>
                <select name="titulo_cuatro" id="titulo_cuatro" class="form-control">
                    <option value="">-- Seleccione una opcion --</option>
                    @foreach($titulos as $titulo)
                        <option value="{{ $titulo->titulo }}" {{ old('titulo_cuatro') == $titulo->titulo ? 'selected' : '' }}>
                            {{ $titulo->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('titulo_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <!-- -->

        <div class="row mt-3">
            
            <div class="col-md-3">
                <p><strong>Institución Educativa</strong></p>
                <select name="institucion_educativa_cuatro" id="institucion_educativa_cuatro" class="form-control select2">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($institucionesEducativas as $institucioneEducativa)
                        <option value="{{ $institucioneEducativa->id }}" {{ old('institucion_educativa_cuatro') == $institucioneEducativa->id ? 'selected' : '' }}>
                            {{ $institucioneEducativa->institucion }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_educativa_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    
            
            <div class="col-md-3">
                <p><strong>Cédula</strong></p>
                <select name="cedula_cuatro" id="cedula_cuatro" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    <option value="SI" {{ old('cedula_cuatro') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('cedula_cuatro') == 'NO' ? 'selected' : '' }}>NO</option>
                    <option value="EN TRAMITE" {{ old('cedula_cuatro') == 'EN TRAMITE' ? 'selected' : '' }}>EN TRAMITE</option>
                    <option value="CARTA PASANTE" {{ old('cedula_cuatro') == 'CARTA PASANTE' ? 'selected' : '' }}>CARTA PASANTE</option>
                    <option value="TRUNCA" {{ old('cedula_cuatro') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                </select>
                @error('cedula_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p><strong>Número</strong></p>
                <input type="text" name="cedula_numero_cuatro" id="cedula_numero_cuatro" class="form-control">
                @error('cedula_numero_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-3">
                <p><strong>Registro Nacional de Profesionales</strong></p>
                <input type="file" name="reg_nac_prof_cuatro" class="form-control-file">
                @error('reg_nac_prof_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            
        </div>

        <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>* Observaciones</strong></p>
                        <input type="text" name="observaciones_cuatro" id="observaciones_cuatro" class="form-control" value="{{ old('observaciones_cuatro', $gradoAcademico->observaciones_cuatro)}}">

                        @error('observaciones_cuatro')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

        <!-- -------------------------------------------------------------- -->
        </div>
        <div class="card-footer">
            
            
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS</button>
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
            $('#institucion_educativa_uno, #institucion_educativa_dos, #institucion_educativa_tres, #institucion_educativa_cuatro, #titulo_uno, #titulo_dos, #titulo_tres, #titulo_cuatro').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script> 
    
    <script>
        $(document).ready(function(){
            // Deshabilitar los select de títulos al cargar la página
            $('#titulo_uno, #titulo_dos, #titulo_tres, #titulo_cuatro').prop('disabled', true);

            function cargarTitulos(gradoSelect, tituloSelect, oldValue = null) {
                let gradoCve = $(gradoSelect).val();
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

                            // Si hay un oldValue, lo seleccionamos
                            if(oldValue){
                                $(tituloSelect).val(oldValue);
                            }
                        },
                        error: function() {
                            alert("Error al obtener los títulos.");
                        }
                    });
                } else {
                    $(tituloSelect).prop('disabled', true);
                }
            }

            // Recuperar valores anteriores de Laravel (old)
            let oldTituloUno   = @json(old('titulo_uno'));
            let oldTituloDos   = @json(old('titulo_dos'));
            let oldTituloTres  = @json(old('titulo_tres'));
            let oldTituloCuatro= @json(old('titulo_cuatro'));

            // Si había grados seleccionados antes del error, recargamos títulos automáticamente
            if($('#grado_academico_uno').val()){
                cargarTitulos('#grado_academico_uno', '#titulo_uno', oldTituloUno);
            }
            if($('#grado_academico_dos').val()){
                cargarTitulos('#grado_academico_dos', '#titulo_dos', oldTituloDos);
            }
            if($('#grado_academico_tres').val()){
                cargarTitulos('#grado_academico_tres', '#titulo_tres', oldTituloTres);
            }
            if($('#grado_academico_cuatro').val()){
                cargarTitulos('#grado_academico_cuatro', '#titulo_cuatro', oldTituloCuatro);
            }

            // Eventos para recargar dinámicamente
            $('#grado_academico_uno').change(function(){
                cargarTitulos('#grado_academico_uno', '#titulo_uno');
            });
            $('#grado_academico_dos').change(function(){
                cargarTitulos('#grado_academico_dos', '#titulo_dos');
            });
            $('#grado_academico_tres').change(function(){
                cargarTitulos('#grado_academico_tres', '#titulo_tres');
            });
            $('#grado_academico_cuatro').change(function(){
                cargarTitulos('#grado_academico_cuatro', '#titulo_cuatro');
            });
        });
    </script>
@stop
