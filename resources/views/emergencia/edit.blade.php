@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Emergencias</strong></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">

    <ul>
        <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
        <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
    </ul>
    
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



    <!-- -->
    
    <div class="card">
        <div class="card-header">
            
            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>

            <a href="{{ route('emergenciaPDF', $profesional->id) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa-solid fa-print"></i> IMPRIMIR</a>

        </div>

        <form action="{{ route('updateEmergencia', $profesional->id) }}" method="POST">

        @csrf 

        @method('PUT')

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Datos Personales</h4>
                        </blockquote>
                    </div>
                </div>

                <div class="row mt-3">
                    
                    <div class="col-md-3">
                        <p><strong>Teléfono Celular</strong></p>
                        <input type="text" name="telefono_celular" class="form-control" maxlength="10" value="{{ old('telefono_celular', $emergencia->telefono) }}">
                        
                        @error('telefono_celular')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    

                    <div class="col-md-3">
                        <p><strong>Correo Electrónico</strong></p>
                        <input type="email" name="correo_electronico" class="form-control" value="{{ old('correo_electronico', $emergencia->correo_electronico) }}"> 

                        @error('correo_electronico')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Tipo de Sangre</strong></p>
                        <select name="tipo_sangre" id="tipo_sangre" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach ($tiposDeSangre as $tipo)
                                <option value="{{ $tipo->tipo_sangre }}"
                                    {{ old('tipo_sangre', $emergencia->tipo_sangre) == $tipo->tipo_sangre ? 'selected' : '' }}>
                                    {{ $tipo->tipo_sangre }}
                                </option>
                            @endforeach
                        </select>

                        @error('tipo_sangre')
                            <small class="alert alert-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Alergia</strong></p>
                        <select name="tipo_alergia_id" id="tipo_alergia_id" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach ($tiposDeAlergia as $alergia)
                                <option value="{{ $alergia->id }}" 
                                    {{ old('tipo_alergia_id',$emergencia->tipo_alergia_id) == $alergia->id ? 'selected' : '' }}>
                                    {{ $alergia->tipo_alergia }}
                                </option>
                            @endforeach
                        </select>

                        @error('tipo_alergia_id')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-12">
                        <p><strong>Describa Brevemente</strong></p>
                        <input type="text" name="alergia_descripcion" id="alergia_descripcion" class="form-control"  value="{{ old('alergia_descripcion', $emergencia->alergia_descripcion) }}">                     
                        @error('alergia_descripcion')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">
                    
                    <div class="col-md-6">
                        <p><strong>Enfermedades Preexistentes</strong></p>
                        <input type="text" name="enfermedad" id="enfermedad" class="form-control" value="{{ old('enfermedad', $emergencia->enfermedad) }}">                     
                        @error('enfermedad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-6">
                        <p><strong>Medicamentos que Toma Regularmente</strong></p>
                        <input type="text" name="medicamentos" id="medicamentos" class="form-control" value="{{ old('medicamentos', $emergencia->medicamentos) }}">                     
                        @error('medicamentos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  
                    
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-12">
                        <p><strong>Tratamiento Médico Actual</strong></p>
                        <textarea name="tratamiento" id="tratamiento" cols="30" rows="5" class="form-control">{{ old('tratamiento', $emergencia->tratamiento) }}</textarea>                    
                        @error('tratamiento')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Médico de Cabecera</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="medico_nombre" id="medico_nombre" class="form-control" value="{{ old('medico_nombre', $emergencia->medico_nombre) }}">                     
                        @error('medico_nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-3">
                        <p><strong>Teléfono de Contacto</strong></p>
                        <input type="text" name="medico_telefono" id="medico_telefono" class="form-control" value="{{ old('medico_telefono', $emergencia->medico_telefono) }}">                     
                        @error('medico_telefono')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                </div>

                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 1</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="emergencia_nombre_uno" id="emergencia_nombre_uno" class="form-control" value="{{ old('emergencia_nombre_uno', $emergencia->emergencia_nombre_uno) }}">                     
                        @error('emergencia_nombre_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-2">                        
                            <p><strong>Parentesco</strong></p>
                            <select name="emergencia_relacion_uno" id="emergencia_relacion_uno" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($relacionesDeEmergencia as $relacion)
                                    <option value="{{ $relacion->id }}" 
                                        {{ old('emergencia_relacion_uno', $emergencia->emergencia_relacion_uno_id) == $relacion->id ? 'selected' : '' }}>
                                        {{ $relacion->relacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('emergencia_relacion_uno')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <div class="col-md-2">
                        <p><strong>Teléfono Principal</strong></p>
                        <input type="text" name="emergencia_telefono_uno_uno" id="emergencia_telefono_uno_uno" class="form-control" value="{{ old('emergencia_telefono_uno_uno', $emergencia->emergencia_telefono_uno_uno) }}">                     
                        @error('emergencia_telefono_uno_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Teléfono Secundario</strong></p>
                        <input type="text" name="emergencia_telefono_dos_uno" id="emergencia_telefono_dos_uno" class="form-control" value="{{ old('emergencia_telefono_dos_uno', $emergencia->emergencia_telefono_dos_uno) }}">                     
                        @error('emergencia_telefono_dos_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>E-mail</strong></p>
                        <input type="text" name="emergencia_email_uno" id="emergencia_email_uno" class="form-control" value="{{ old('emergencia_email_uno', $emergencia->emergencia_email_uno) }}">                     
                        @error('emergencia_email_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="emergencia_calle_uno" id="emergencia_calle_uno" class="form-control" value="{{ old('emergencia_calle_uno', $emergencia->emergencia_calle_uno) }}">                     
                        @error('emergencia_calle_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Número</strong></p>
                        <input type="text" name="emergencia_numero_uno" id="emergencia_numero_uno" class="form-control" value="{{ old('emergencia_numero_uno', $emergencia->emergencia_numero_uno) }}">                     
                        @error('emergencia_numero_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Colonia</strong></p>
                        <input type="text" name="emergencia_colonia_uno" id="emergencia_colonia_uno" class="form-control" value="{{ old('emergencia_colonia_uno', $emergencia->emergencia_colonia_uno) }}">                     
                        @error('emergencia_colonia_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Código Postal</strong></p>
                        <input type="text" name="emergencia_codigo_postal_uno" id="emergencia_codigo_postal_uno" class="form-control" value="{{ old('emergencia_codigo_postal_uno', $emergencia->emergencia_codigo_postal_uno) }}">                     
                        @error('emergencia_codigo_postal_uno')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    

                </div>

                <!-- -->

                <!-- -->

            
                <div class="col-md-3">
    <p><strong>Entidad</strong></p>
    <select class="form-control entidad-select"
            name="emergencia_estado_uno_id"
            data-target="municipio_uno"
            data-selected-municipio="{{ old('emergencia_municipio_uno_id', $emergencia->emergencia_municipio_uno_id) }}">
        <option value="">Seleccione una entidad</option>
        @foreach($entidades as $entidad)
            <option value="{{ $entidad->id }}"
                {{ old('emergencia_estado_uno_id', $emergencia->emergencia_estado_uno_id) == $entidad->id ? 'selected' : '' }}>
                {{ $entidad->nombre }}
            </option>
        @endforeach
    </select>

    @error('emergencia_estado_uno_id')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-3">
    <p><strong>Municipio</strong></p>
    <select id="municipio_uno"
            class="form-control"
            name="emergencia_municipio_uno_id">
        <option value="">Seleccione un municipio</option>
    </select>

    @error('emergencia_municipio_uno_id')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>




                

                


                <!-- -->

                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 2</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="emergencia_nombre_dos" id="emergencia_nombre_dos" class="form-control" value="{{ old('emergencia_nombre_dos',$emergencia->emergencia_nombre_dos) }}">                     
                        @error('emergencia_nombre_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-2">                        
                            <p><strong>Parentesco</strong></p>
                            <select name="emergencia_relacion_dos" id="emergencia_relacion_dos" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($relacionesDeEmergencia as $relacion)
                                    <option value="{{ $relacion->id }}" 
                                        {{ old('emergencia_relacion_dos', $emergencia->emergencia_relacion_dos_id) == $relacion->id ? 'selected' : '' }}>
                                        {{ $relacion->relacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('emergencia_relacion_dos')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <div class="col-md-2">
                        <p><strong>Teléfono Principal</strong></p>
                        <input type="text" name="emergencia_telefono_uno_dos" id="emergencia_telefono_uno_dos" class="form-control" value="{{ old('emergencia_telefono_uno_dos', $emergencia->emergencia_telefono_uno_dos) }}">                     
                        @error('emergencia_telefono_uno_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Teléfono Secundario</strong></p>
                        <input type="text" name="emergencia_telefono_dos_dos" id="emergencia_telefono_dos_dos" class="form-control" value="{{ old('emergencia_telefono_dos_dos', $emergencia->emergencia_telefono_dos_dos) }}">              
                        @error('emergencia_telefono_dos_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>E-mail</strong></p>
                        <input type="text" name="emergencia_email_dos" id="emergencia_email_dos" class="form-control" value="{{ old('emergencia_email_dos', $emergencia->emergencia_email_dos) }}">                    
                        @error('emergencia_email_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="emergencia_calle_dos" id="emergencia_calle_dos" class="form-control" value="{{ old('emergencia_calle_dos', $emergencia->emergencia_calle_dos) }}">                
                        @error('emergencia_calle_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Número</strong></p>
                        <input type="text" name="emergencia_numero_dos" id="emergencia_numero_dos" class="form-control" value="{{ old('emergencia_numero_dos', $emergencia->emergencia_numero_dos) }}">                   
                        @error('emergencia_numero_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Colonia</strong></p>
                        <input type="text" name="emergencia_colonia_dos" id="emergencia_colonia_dos" class="form-control" value="{{ old('emergencia_colonia_dos', $emergencia->emergencia_colonia_dos) }}">               
                        @error('emergencia_colonia_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Código Postal</strong></p>
                        <input type="text" name="emergencia_codigo_postal_dos" id="emergencia_codigo_postal_dos" class="form-control" value="{{ old('emergencia_codigo_postal_dos', $emergencia->emergencia_codigo_postal_dos) }}">             
                        @error('emergencia_codigo_postal_dos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    

                </div>

                <!-- -->

                <!-- -->

                <div class="row mt-3">

    <div class="col-md-3">
        <p><strong>Entidad</strong></p>
        <select class="form-control entidad-select"
                name="emergencia_estado_dos_id"
                data-target="municipio_dos"
                data-selected-municipio="{{ old('emergencia_municipio_dos_id', $emergencia->emergencia_municipio_dos_id ?? '') }}">
            <option value="">Seleccione una entidad</option>
            @foreach($entidades as $entidad)
                <option value="{{ $entidad->id }}"
                    {{ old('emergencia_estado_dos_id', $emergencia->emergencia_estado_dos_id ?? '') == $entidad->id ? 'selected' : '' }}>
                    {{ $entidad->nombre }}
                </option>
            @endforeach
        </select>

        @error('emergencia_estado_dos_id')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <p><strong>Municipio</strong></p>
        <select id="municipio_dos"
                class="form-control"
                name="emergencia_municipio_dos_id"
                >
            <option value="">Seleccione un municipio</option>
        </select>

        @error('emergencia_municipio_dos_id')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

</div>


                




                <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 3</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="emergencia_nombre_tres" id="emergencia_nombre" class="form-control" value="{{ old('emergencia_nombre_tres', $emergencia->emergencia_nombre_tres) }}">

                        @error('emergencia_nombre')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="col-md-2">                        
                            <p><strong>Relación de Emergencia</strong></p>
                            <select name="emergencia_relacion_tres" id="emergencia_relacion_tres" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($relacionesDeEmergencia as $relacion)
                                    <option value="{{ $relacion->id }}" 
                                        {{ old('emergencia_relacion_tres', $emergencia->emergencia_relacion_tres_id) == $relacion->id ? 'selected' : '' }}>
                                        {{ $relacion->relacion }}
                                    </option>
                                @endforeach
                            </select>

                            @error('emergencia_relacion_tres')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <div class="col-md-2">
                        <p><strong>Teléfono Principal</strong></p>
                        <input type="text" name="emergencia_telefono_uno_tres" id="emergencia_telefono_uno_tres" class="form-control" value="{{ old('emergencia_telefono_uno_tres', $emergencia->emergencia_telefono_uno_tres) }}">          
                        @error('emergencia_telefono_uno_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Teléfono Secundario</strong></p>
                        <input type="text" name="emergencia_telefono_dos_tres" id="emergencia_telefono_dos_tres" class="form-control" value="{{ old('emergencia_telefono_dos_tres', $emergencia->emergencia_telefono_dos_tres) }}">              
                        @error('emergencia_telefono_dos_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>E-mail</strong></p>
                        <input type="text" name="emergencia_email_tres" id="emergencia_email_tres" class="form-control" value="{{ old('emergencia_email_tres', $emergencia->emergencia_email_tres) }}">                             
                        @error('emergencia_email_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="emergencia_calle_tres" id="emergencia_calle_tres" class="form-control" value="{{ old('emergencia_calle_tres', $emergencia->emergencia_calle_tres) }}">                        
                        @error('emergencia_calle_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Número</strong></p>
                        <input type="text" name="emergencia_numero_tres" id="emergencia_numero_tres" class="form-control" value="{{ old('emergencia_numero_tres', $emergencia->emergencia_numero_tres) }}">                         
                        @error('emergencia_numero_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Colonia</strong></p>
                        <input type="text" name="emergencia_colonia_tres" id="emergencia_colonia_tres" class="form-control" value="{{ old('emergencia_colonia_tres', $emergencia->emergencia_colonia_tres) }}">                      
                        @error('emergencia_colonia_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <p><strong>Código Postal</strong></p>
                        <input type="text" name="emergencia_codigo_postal_tres" id="emergencia_codigo_postal_tres" class="form-control" value="{{ old('emergencia_codigo_postal_tres', $emergencia->emergencia_codigo_postal_tres) }}">                  
                        @error('emergencia_codigo_postal_tres')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    

                </div>

        <!-- ---------------------------------------------------------------------- --> 

        

        <!-- ------------------------------------------------------------- -->

                <div class="row mt-3">

    <div class="col-md-3">
        <p><strong>Entidad</strong></p>
        <select class="form-control entidad-select"
                name="emergencia_estado_tres_id"
                data-target="municipio_tres"
                data-selected-municipio="{{ old('emergencia_municipio_tres_id', $emergencia->emergencia_municipio_tres_id ?? '') }}">
            <option value="">Seleccione una entidad</option>
            @foreach($entidades as $entidad)
                <option value="{{ $entidad->id }}"
                    {{ old('emergencia_estado_tres_id', $emergencia->emergencia_estado_tres_id ?? '') == $entidad->id ? 'selected' : '' }}>
                    {{ $entidad->nombre }}
                </option>
            @endforeach
        </select>

        @error('emergencia_estado_tres_id')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <p><strong>Municipio</strong></p>
        <select id="municipio_tres"
                class="form-control"
                name="emergencia_municipio_tres_id">
            <option value="">Seleccione un municipio</option>
        </select>

        @error('emergencia_municipio_tres_id')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

</div>


                <!-- ------------------------------------------------------------- -->
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS</button>
        </div>

    </form>
</div>

<br>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{--
    <script>
                document.addEventListener('DOMContentLoaded', function () {

                    document.querySelectorAll('.entidad-select').forEach(entidadSelect => {

                        const targetMunicipioId = entidadSelect.dataset.target;
                        const municipioSelect = document.getElementById(targetMunicipioId);

                        // 👉 Si existe old() de entidad, dispara el change automáticamente
                        if (entidadSelect.value) {
                            cargarMunicipios(entidadSelect.value, municipioSelect);
                        }

                        entidadSelect.addEventListener('change', function () {
                            cargarMunicipios(this.value, municipioSelect);
                        });

                    });

                    function cargarMunicipios(entidadId, municipioSelect) {

                        municipioSelect.innerHTML = '<option value="">Cargando...</option>';

                        if (!entidadId) {
                            municipioSelect.innerHTML = '<option value="">Seleccione municipio</option>';
                            return;
                        }

                        fetch(`{{ route('municipios', '') }}/${entidadId}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Error en la respuesta');
                                }
                                return response.json();
                            })
                            .then(data => {

                                municipioSelect.innerHTML = '<option value="">Seleccione municipio</option>';

                                const municipioOld = municipioSelect.dataset.old;

                                data.forEach(municipio => {
                                    const selected = municipioOld == municipio.id ? 'selected' : '';
                                    municipioSelect.innerHTML +=
                                        `<option value="${municipio.id}" ${selected}>${municipio.nombre}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                municipioSelect.innerHTML = '<option value="">Error al cargar municipios</option>';
                            });
                    }

                });
                </script>--}}
                

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.entidad-select').forEach(entidadSelect => {

        const municipioSelectId = entidadSelect.dataset.target;
        const municipioSelect = document.getElementById(municipioSelectId);
        const selectedMunicipio = entidadSelect.dataset.selectedMunicipio ?? null;

        function cargarMunicipios(entidadId) {

            municipioSelect.innerHTML = '<option value="">Cargando...</option>';

            if (!entidadId) {
                municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                return;
            }

            fetch(`/municipios/${entidadId}`)
                .then(response => response.json())
                .then(data => {

                    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';

                    data.forEach(municipio => {

                        const option = document.createElement('option');
                        option.value = municipio.id;
                        option.textContent = municipio.nombre;

                        if (
                            selectedMunicipio !== null &&
                            String(municipio.id) === String(selectedMunicipio)
                        ) {
                            option.selected = true;
                        }

                        municipioSelect.appendChild(option);
                    });

                })
                .catch(error => {
                    console.error('Error al cargar municipios:', error);
                    municipioSelect.innerHTML = '<option value="">Error al cargar</option>';
                });
        }

        // Cambio manual
        entidadSelect.addEventListener('change', function () {
            cargarMunicipios(this.value);
        });

        // Carga automática en edición
        if (entidadSelect.value) {
            cargarMunicipios(entidadSelect.value);
        }

    });

});
</script>



@endsection