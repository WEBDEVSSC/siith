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

        <form action="{{ route('updateGrado', $gradoAcademico->id) }}" method="POST" enctype="multipart/form-data">

        @csrf 

        @method('PUT')

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->
                <!-- 1 -->
                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Grado Académico 1</h4>
                        </blockquote>
                    </div>
                </div>

                <div class="row mt-3">  

                    <div class="col-md-3">
                        <p><strong>Nivel académico</strong></p>
                        <select name="grado_academico_uno" id="grado_academico_uno" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($gradosAcademicos as $grado)
                                <option value="{{ $grado->cve }}" 
                                    {{ old('grado_academico_uno', $gradoAcademico->cve_grado_uno ?? '') == $grado->cve ? 'selected' : '' }}>
                                    {{ $grado->grado }}
                                </option>
                            @endforeach
                        </select>
                        @error('grado_academico_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                      
                    <div class="col-md-9">
                        <p><strong>Título</strong></p>
                        <input type="hidden" name="titulo_uno" id="titulo_uno_hidden" value="{{ old('titulo_uno', $gradoAcademico->titulo_uno_id ?? '') }}">
                        <select name="titulo_uno" id="titulo_uno" class="form-control select2" disabled>
                            <option value="">Seleccione un título</option>
                            @foreach($titulos as $titulo)
                                <option value="{{ $titulo->id }}" {{ old('titulo_uno', $gradoAcademico->titulo_uno_id ?? '') == $titulo->id ? 'selected' : '' }}>
                                    {{ $titulo->titulo }}
                                </option>
                            @endforeach
                        </select>
                        @error('titulo_uno')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>

                <!-- -->

                <div class="row mt-3">
                    
                    <div class="col-md-3">
                        <p><strong>Institucion Educativa</strong></p>
                        <select name="institucion_educativa_uno" id="institucion_educativa_uno" class="form-control select2">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($institucionesEducativas as $institucioneEducativa)
                                <option value="{{ $institucioneEducativa->id }}" 
                                    {{ old('institucion_educativa_uno', $gradoAcademico->institucion_educativa_uno_id) == $institucioneEducativa->id ? 'selected' : '' }}>
                                    {{ $institucioneEducativa->institucion }}
                                </option>
                            @endforeach
                        </select>
                        @error('institucion_educativa_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    
                    
                    <div class="col-md-3">
                        <p><strong>Cedula</strong></p>
                        <select name="cedula_uno" id="cedula_uno" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('cedula_uno', $gradoAcademico->cedula_uno ?? '') == "SI" ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('cedula_uno', $gradoAcademico->cedula_uno ?? '') == "NO" ? 'selected' : '' }}>NO</option>
                            <option value="CARTA PASANTE" {{ old('cedula_uno', $gradoAcademico->cedula_uno ?? '') == "CARTA PASANTE" ? 'selected' : '' }}>CARTA PASANTE</option>
                            <option value="EN TRAMITE" {{ old('cedula_uno', $gradoAcademico->cedula_uno ?? '') == "EN TRAMITE" ? 'selected' : '' }}>EN TRAMITE</option>
                            <option value="TRUNCA" {{ old('cedula_uno', $gradoAcademico->cedula_uno ?? '') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                        </select>
                        @error('cedula_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 

                    <div class="col-md-3">
                        <p><strong>Número</strong></p>
                        <input type="text" name="cedula_numero_uno" id="cedula_numero_uno" class="form-control" value="{{ old('cedula_numero_uno', $gradoAcademico->numero_cedula_uno)}}">
                        @error('cedula_numero_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>    

                    <div class="col-md-3">

                        <p><strong>Archivo de Título, Cédula, R.N.P.</strong></p>
                        
                        @if ($gradoAcademico->reg_nac_prof_uno == NULL)
                            <input type="file" name="reg_nac_prof_uno" class="form-control-file">
                        @else
                            <a href="{{ asset('storage/' . $profesional->gradoAcademico->reg_nac_prof_uno) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                        @endif

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
                <p><strong>Nivel académico</strong></p>
                <select name="grado_academico_dos" id="grado_academico_dos" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($gradosAcademicos as $grado)
                        <option value="{{ $grado->cve }}" 
                            {{ old('grado_academico_dos', $gradoAcademico->cve_grado_dos ?? '') == $grado->cve ? 'selected' : '' }}>
                            {{ $grado->grado }}
                        </option>
                    @endforeach
                </select>
                @error('grado_academico')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-9">
                <p><strong>Título</strong></p>
                <input type="hidden" name="titulo_dos" id="titulo_dos_hidden" value="{{ old('titulo_dos', $gradoAcademico->titulo_dos_id ?? '') }}">
                <select name="titulo_dos" id="titulo_dos" class="form-control select2" disabled>
                    <option value="">Seleccione un título</option>
                    @foreach($titulos as $titulo)
                        <option value="{{ $titulo->id }}" {{ old('titulo_dos', $gradoAcademico->titulo_dos_id ?? '') == $titulo->id ? 'selected' : '' }}>
                            {{ $titulo->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('titulo_dos')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <!-- -->

        <div class="row mt-3">
            
            <div class="col-md-3">
                <p><strong>Institucion Educativa</strong></p>
                <select name="institucion_educativa_dos" id="institucion_educativa_dos" class="form-control select2">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($institucionesEducativas as $institucioneEducativa)
                        <option value="{{ $institucioneEducativa->id }}" 
                            {{ old('institucion_educativa_dos', $gradoAcademico->institucion_educativa_dos_id) == $institucioneEducativa->id ? 'selected' : '' }}>
                            {{ $institucioneEducativa->institucion }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_educativa_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    
            
            <div class="col-md-3">
                <p><strong>Cedula</strong></p>
                <select name="cedula_dos" id="cedula_dos" class="form-control">
                        <option value="">-- Seleccione una opción --</option>
                        <option value="SI" {{ old('cedula_dos', $gradoAcademico->cedula_dos ?? '') == "SI" ? 'selected' : '' }}>SI</option>
                        <option value="NO" {{ old('cedula_dos', $gradoAcademico->cedula_dos ?? '') == "NO" ? 'selected' : '' }}>NO</option>
                        <option value="CARTA PASANTE" {{ old('cedula_dos', $gradoAcademico->cedula_dos ?? '') == "CARTA PASANTE" ? 'selected' : '' }}>CARTA PASANTE</option>
                        <option value="EN TRAMITE" {{ old('cedula_dos', $gradoAcademico->cedula_dos ?? '') == "EN TRAMITE" ? 'selected' : '' }}>EN TRAMITE</option>
                        <option value="TRUNCA" {{ old('cedula_dos', $gradoAcademico->cedula_dos ?? '') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                </select>
                @error('cedula_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p><strong>Número</strong></p>
                <input type="text" name="cedula_numero_dos" id="cedula_numero_dos" class="form-control" value="{{ old('cedula_numero_dos', $gradoAcademico->numero_cedula_dos)}}">
                @error('cedula_numero_dos')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 

            <div class="col-md-3">
                        
                <p><strong>Archivo de Título, Cédula, R.N.P.</strong></p>
                        
                @if ($gradoAcademico->reg_nac_prof_dos == NULL)
                    <input type="file" name="reg_nac_prof_dos" class="form-control-file">
                @else
                    <a href="{{ asset('storage/' . $profesional->gradoAcademico->reg_nac_prof_dos) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                @endif

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

                <!-- ---------------------------------- -->
                <!-- 3 -->
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
                <p><strong>Nivel académico</strong></p>
                <select name="grado_academico_tres" id="grado_academico_tres" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($gradosAcademicos as $grado)
                        <option value="{{ $grado->cve }}" 
                            {{ old('grado_academico_tres', $gradoAcademico->cve_grado_tres ?? '') == $grado->cve ? 'selected' : '' }}>
                            {{ $grado->grado }}
                        </option>
                    @endforeach
                </select>
                @error('grado_academico_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-9">
                <p><strong>Título</strong></p>
                <input type="hidden" name="titulo_tres" id="titulo_tres_hidden" value="{{ old('titulo_tres', $gradoAcademico->titulo_tres_id ?? '') }}">
                <select name="titulo_tres" id="titulo_tres" class="form-control select2" disabled>
                    <option value="">Seleccione un título</option>
                    @foreach($titulos as $titulo)
                        <option value="{{ $titulo->id }}" {{ old('titulo_tres', $gradoAcademico->titulo_tres_id ?? '') == $titulo->id ? 'selected' : '' }}>
                            {{ $titulo->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('titulo_tres')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <!-- -->

        <div class="row mt-3">
            
            <div class="col-md-3">
                <p><strong>Institucion Educativa</strong></p>
                <select name="institucion_educativa_tres" id="institucion_educativa_tres" class="form-control select2">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($institucionesEducativas as $institucioneEducativa)
                        <option value="{{ $institucioneEducativa->id }}" 
                            {{ old('institucion_educativa_tres', $gradoAcademico->institucion_educativa_tres_id) == $institucioneEducativa->id ? 'selected' : '' }}>
                            {{ $institucioneEducativa->institucion }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_educativa_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    
            
            <div class="col-md-3">
                <p><strong>Cedula</strong></p>
                <select name="cedula_tres" id="cedula_tres" class="form-control">
                        <option value="">-- Seleccione una opción --</option>
                        <option value="SI" {{ old('cedula_tres', $gradoAcademico->cedula_tres ?? '') == "SI" ? 'selected' : '' }}>SI</option>
                        <option value="NO" {{ old('cedula_tres', $gradoAcademico->cedula_tres ?? '') == "NO" ? 'selected' : '' }}>NO</option>
                        <option value="CARTA PASANTE" {{ old('cedula_tres', $gradoAcademico->cedula_tres ?? '') == "CARTA PASANTE" ? 'selected' : '' }}>CARTA PASANTE</option>
                        <option value="EN TRAMITE" {{ old('cedula_tres', $gradoAcademico->cedula_tres ?? '') == "EN TRAMITE" ? 'selected' : '' }}>EN TRAMITE</option>
                        <option value="TRUNCA" {{ old('cedula_tres', $gradoAcademico->cedula_tres ?? '') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                </select>
                @error('cedula_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p><strong>Número</strong></p>
                <input type="text" name="cedula_numero_tres" id="cedula_numero_tres" class="form-control" value="{{ old('cedula_numero_tres', $gradoAcademico->numero_cedula_tres)}}">
                @error('cedula_numero_tres')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 
            
            <div class="col-md-3">
                        
                <p><strong>Archivo de Título, Cédula, R.N.P.</strong></p>
                        
                @if ($gradoAcademico->reg_nac_prof_tres == NULL)
                    <input type="file" name="reg_nac_prof_tres" class="form-control-file">
                @else
                    <a href="{{ asset('storage/' . $profesional->gradoAcademico->reg_nac_prof_tres) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                @endif

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

                <!-- ---------------------------------- -->
                <!-- 4 -->
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
                <p><strong>Nivel académico </strong></p>
                <select name="grado_academico_cuatro" id="grado_academico_cuatro" class="form-control">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($gradosAcademicos as $grado)
                        <option value="{{ $grado->cve }}" 
                            {{ old('grado_academico_cuatro', $gradoAcademico->cve_grado_cuatro ?? '') == $grado->cve ? 'selected' : '' }}>
                            {{ $grado->grado }}
                        </option>
                    @endforeach
                </select>
                @error('grado_academico_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            
            <div class="col-md-9">
                <p><strong>Título</strong></p>
                <input type="hidden" name="titulo_cuatro" id="titulo_cuatro_hidden" value="{{ old('titulo_cuatro', $gradoAcademico->titulo_cuatro_id ?? '') }}">
                <select name="titulo_cuatro" id="titulo_cuatro" class="form-control select2" disabled>
                    <option value="">Seleccione un título</option>
                    @foreach($titulos as $titulo)
                        <option value="{{ $titulo->id }}" {{ old('titulo_cuatro', $gradoAcademico->titulo_cuatro_id ?? '') == $titulo->id ? 'selected' : '' }}>
                            {{ $titulo->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('titulo_cuatro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <!-- -->

        <div class="row mt-3">
            
            <div class="col-md-3">
                <p><strong>Institucion Educativa</strong></p>
                <select name="institucion_educativa_cuatro" id="institucion_educativa_cuatro" class="form-control select2">
                    <option value="">-- Seleccione una opción --</option>
                    @foreach($institucionesEducativas as $institucioneEducativa)
                        <option value="{{ $institucioneEducativa->id }}" 
                            {{ old('institucion_educativa_cuatro', $gradoAcademico->institucion_educativa_cuatro_id) == $institucioneEducativa->id ? 'selected' : '' }}>
                            {{ $institucioneEducativa->institucion }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_educativa_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    
            
            <div class="col-md-3">
                <p><strong>Cedula</strong></p>
                <select name="cedula_cuatro" id="cedula_cuatro" class="form-control">
                        <option value="">-- Seleccione una opción --</option>
                        <option value="SI" {{ old('cedula_cuatro', $gradoAcademico->cedula_cuatro ?? '') == "SI" ? 'selected' : '' }}>SI</option>
                        <option value="NO" {{ old('cedula_cuatro', $gradoAcademico->cedula_cuatro ?? '') == "NO" ? 'selected' : '' }}>NO</option>
                        <option value="CARTA PASANTE" {{ old('cedula_cuatro', $gradoAcademico->cedula_cuatro ?? '') == "CARTA PASANTE" ? 'selected' : '' }}>CARTA PASANTE</option>
                        <option value="EN TRAMITE" {{ old('cedula_cuatro', $gradoAcademico->cedula_cuatro ?? '') == "EN TRAMITE" ? 'selected' : '' }}>EN TRAMITE</option>
                        <option value="TRUNCA" {{ old('cedula_cuatro', $gradoAcademico->cedula_cuatro ?? '') == "TRUNCA" ? 'selected' : '' }}>TRUNCA</option>
                </select>
                @error('cedula_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="col-md-3">
                <p><strong>Número</strong></p>
                <input type="text" name="cedula_numero_cuatro" id="cedula_numero_cuatro" class="form-control" value="{{ old('cedula_numero_cuatro', $gradoAcademico->numero_cedula_cuatro)}}">
                @error('cedula_numero_cuatro')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> 

            <div class="col-md-3">
                        
                <p><strong>Archivo de Título, Cédula, R.N.P.</strong></p>
                        
                @if ($gradoAcademico->reg_nac_prof_cuatro == NULL)
                    <input type="file" name="reg_nac_prof_cuatro" class="form-control-file">
                @else
                    <a href="{{ asset('storage/' . $profesional->gradoAcademico->reg_nac_prof_cuatro) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                @endif

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

<!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS</button>
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
            $('#titulo_uno').change(function() {
                $('#titulo_uno_hidden').val($(this).val());
            });
            
            $('#titulo_dos').change(function() {
                $('#titulo_dos_hidden').val($(this).val());
            });
            
            $('form').submit(function() {
                $('#titulo_uno, #titulo_dos').prop('disabled', false);
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
    
    <script>
        $(document).ready(function() {
            $('#titulo_uno').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>  
    
    <script>
        $(document).ready(function() {
            $('#titulo_dos').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>   

    <script>
        $(document).ready(function() {
            $('#institucion_educativa_uno').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>   

    <script>
        $(document).ready(function() {
            $('#institucion_educativa_dos').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>   
    
@stop