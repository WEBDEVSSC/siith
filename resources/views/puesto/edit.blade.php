@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Puesto</strong></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">

    <ul>
        <li><strong>Nombre</strong> : {{ $profesionalData->nombre }} {{ $profesionalData->apellido_paterno }} {{ $profesionalData->apellido_materno }}</li>
        <li><strong>CURP</strong> : {{ $profesionalData->curp }}</li>
    </ul>
    
</div>
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>
            
        </div>

        <form action="{{ route('updatePuesto', $profesional->id) }}" method="POST">

        <input type="hidden" name="id_profesional" value={{ $profesional->id_profesional }}>

        @csrf 

        @method('PUT')
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Fiel</strong></p>
                        <select name="fiel" id="fiel" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('fiel', $profesional->fiel) == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('fiel' ,$profesional->fiel) == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>

                        @error('fiel')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Vigencia</strong></p>
                        <input type="date" name="fiel_vigencia" id='fiel_vigencia' class="form-control" value="{{ old('fiel_vigencia', $profesional->fiel_vigencia) }}">

                        @error('fiel_vigencia')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Actividad</strong></p>
                        <select name="actividad" id="actividad" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($actividades as $actividad)
                                <option value="{{ $actividad->actividad }}" {{ old('actividad', $profesional->actividad) == $actividad->actividad ? 'selected' : '' }}>
                                    {{ $actividad->actividad }}
                                </option>
                            @endforeach
                        </select>
                        @error('actividad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Adicional</strong></p>
                        <select name="adicional" id="adicional" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($adicionales as $adicional)
                                <option value="{{ $adicional->adicional }}" {{ old('adicional', $profesional->adicional) == $adicional->adicional ? 'selected' : '' }}>
                                    {{ $adicional->adicional }}
                                </option>
                            @endforeach
                        </select>
                        @error('adicional')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Tipo de personal</strong></p>
                        <select name="tipo_personal" id="tipo_personal" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($tiposPersonal as $tipoPersonal)
                                <option value="{{ $tipoPersonal->tipo_personal }}" {{ old('tipo_personal', $profesional->tipo_personal) == $tipoPersonal->tipo_personal ? 'selected' : '' }}>
                                    {{ $tipoPersonal->tipo_personal }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_personal')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>Código de puesto</strong></p>
                        <select name="codigo_puesto" id="codigo_puesto" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($codigosPuesto as $codigoPuesto)
                                <option value="{{ $codigoPuesto->codigo_puesto }}" {{ old('codigo_puesto', $profesional->codigo_puesto) == $codigoPuesto->codigo_puesto ? 'selected' : '' }}>
                                    {{ $codigoPuesto->codigo_puesto }} - {{ $codigoPuesto->codigo }}
                                </option>
                            @endforeach
                        </select>
                        @error('codigo_puesto')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>CLUES Nómina</strong></p>
                        <select name="clues_nomina" id="clues_nomina" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($clues as $clue)
                                <option value="{{ $clue->clues }}" {{ old('clues_nomina' ,$profesional->clues_nomina) == $clue->clues ? 'selected' : '' }}>
                                    {{ $clue->clave_jurisdiccion }} - {{ $clue->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('clues_nomina')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p><strong>CLUES Adscripción Física</strong></p>
                        <select name="clue_adscripcion" id="clue_adscripcion" class="form-control" disabled>
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($clues as $clue)
                                <option value="{{ $clue->clues }}" {{ old('clues_adscripcion', $profesional->clues_adscripcion) == $clue->clues ? 'selected' : '' }}>
                                    {{ $clue->clave_jurisdiccion }} - {{ $clue->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('clues_adscripcion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="clues_adscripcion" value="{{ $profesional->clues_adscripcion }}">

                <!-- -->

                <div class="row mt-3">

                        <div class="col-md-3">
                            <p><strong><strong>Área de Trabajo</strong></strong></p>
                            <select name="area_trabajo" id="area_trabajo" class="form-control select2">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($areasTrabajo as $areaTrabajo)
                                    <option value="{{ $areaTrabajo->area_trabajo }}" {{ old('area_trabajo', $profesional->area_trabajo) == $areaTrabajo->area_trabajo ? 'selected' : '' }}>
                                        {{ $areaTrabajo->area_trabajo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('area_trabajo')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p><strong>Ocupación</strong></p>
                            <select name="ocupacion" id="ocupacion" class="form-control select2">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($ocupaciones as $ocupacion)
                                    <option value="{{ $ocupacion->ocupacion }}" {{ old('ocupacion', $profesional->ocupacion) == $ocupacion->ocupacion ? 'selected' : '' }}>
                                        {{ $ocupacion->ocupacion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ocupacion')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p><strong>Nómina de pago</strong></p>
                            <select name="nomina_pago" id="nomina_pago" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($nominasPago as $nominaPago)
                                    <option value="{{ $nominaPago->nomina }}" {{ old('nomina_pago', $profesional->nomina_pago) == $nominaPago->nomina ? 'selected' : '' }}>
                                        {{ $nominaPago->nomina }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nomina_pago')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p><strong>Tipo de contrato</strong></p>
                            <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($tiposContrato as $tipoContrato)
                                    <option value="{{ $tipoContrato->tipo_contrato }}" {{ old('tipo_contrato', $profesional->tipo_contrato) == $tipoContrato->tipo_contrato ? 'selected' : '' }}>
                                        {{ $tipoContrato->tipo_contrato }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_contrato')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                </div>
        <!-- ---------------------------------------------------------------------- --> 
            
        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Fecha de ingreso</strong></p>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso' ,$profesional->fecha_ingreso) }}">
                @error('fecha_ingreso')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p><strong>Tipo de plaza</strong></p>
                <select name="tipo_plaza" id="tipo_plaza" class="form-control">
                    <option value="">-- Selecciona una opción --</option>
                    @foreach ($tiposPlaza as $tipoPlaza)
                        <option value="{{ $tipoPlaza->tipo_plaza }}" {{ old('tipo_plaza', $profesional->tipo_plaza) == $tipoPlaza->tipo_plaza ? 'selected' : '' }}>
                            {{ $tipoPlaza->tipo_plaza }}
                        </option>
                    @endforeach
                </select>
                @error('tipo_plaza')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <p><strong>Institución a la que pertenece el puesto</strong></p>
                <select name="institucion_puesto" id="institucion_puesto" class="form-control">
                    <option value="">-- Selecciona una opción --</option>
                    @foreach ($institucionesPuesto as $institucionPuesto)
                        <option value="{{ $institucionPuesto->abreviatura }}" {{ old('institucion_puesto',$profesional->institucion_puesto) == $institucionPuesto->abreviatura ? 'selected' : '' }}>
                            {{ $institucionPuesto->abreviatura }} - {{ $institucionPuesto->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_puesto')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            

        </div>


        <!-- ---------------------------------------------------------------------- --> 

        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Vigencia</strong></p>
                <select name="vigencia" id="vigencia" class="form-control">
                    <option value="">Seleccione una vigencia</option>
                    @foreach($vigencias as $vigencia)
                        <option value="{{ $vigencia->vigencia }}" {{ old('vigencia', $profesional->vigencia) == $vigencia->vigencia ? 'selected' : '' }}>
                            {{ $vigencia->vigencia }}
                        </option>
                    @endforeach
                </select>
                @error('vigencia')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p><strong>Motivo</strong></p>
                <select name="vigencia_motivo" id="vigencia_motivo" class="form-control">
                    <option value="">Seleccione una vigencia</option>
                    @foreach($vigenciasMotivos as $vigenciaMotivo)
                        <option value="{{ $vigenciaMotivo->motivo }}" {{ old('vigencia_motivo', $profesional->vigencia_motivo) == $vigenciaMotivo->motivo ? 'selected' : '' }}>
                            {{ $vigenciaMotivo->motivo }}
                        </option>
                    @endforeach
                </select>
                @error('vigencia_motivo')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p><strong>Temporalidad</strong></p>
                <select name="temporalidad" id="temporalidad" class="form-control">
                    <option value="">-- Seleccione un motivo --</option>
                    <option value="SI" {{ old('temporalidad' ,$profesional->temporalidad) == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('temporalidad', $profesional->temporalidad) == 'NO' ? 'selected' : '' }}>NO</option>
                </select>
                @error('temporalidad')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p><strong>Licencia de Maternidad</strong></p>
                <select name="licencia_maternidad" id="licencia_maternidad" class="form-control">
                    <option value="">-- Seleccione un motivo --</option>
                    <option value="SI" {{ old('licencia_maternidad' ,$profesional->licencia_maternidad) == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('licencia_maternidad' ,$profesional->licencia_maternidad) == 'NO' ? 'selected' : '' }}>NO</option>
                </select>
                @error('licencia_maternidad')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- ---------------------------------------------------------------------- --> 

        
        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Seguro de Salud</strong></p>
                <select name="seguro_salud" id="seguro_salud" class="form-control">
                    <option value="">-- Seleccione un motivo --</option>
                    <option value="SI" {{ old('seguro_salud' ,$profesional->seguro_salud) == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('seguro_salud' ,$profesional->seguro_salud) == 'NO' ? 'selected' : '' }}>NO</option>
                </select>
                @error('seguro_salud')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        


        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS DE PUESTO</button>
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
        $(document).ready(function(){
            let vigenciaSeleccionada = $('#vigencia').val();
            let motivoSeleccionado = "{{ old('vigencia_motivo', $profesional->vigencia_motivo) }}";
    
            function cargarMotivos(vigencia, motivoSeleccionado = null) {
                $('#vigencia_motivo').empty().append('<option value="">Seleccione un motivo</option>');
    
                if(vigencia) {
                    $.ajax({
                        url: `/vigencias-motivos/${vigencia}`,
                        type: 'GET',
                        success: function(response) {
                            $.each(response, function(id, motivo){
                                let selected = (motivoSeleccionado && motivoSeleccionado == motivo) ? 'selected' : '';
                                $('#vigencia_motivo').append(`<option value="${motivo}" ${selected}>${motivo}</option>`);
                            });
                        }
                    });
                }
            }
    
            // Cargar motivos cuando se carga el formulario (edición)
            if (vigenciaSeleccionada) {
                cargarMotivos(vigenciaSeleccionada, motivoSeleccionado);
            }
    
            // Cargar motivos dinámicamente cuando cambia la vigencia
            $('#vigencia').change(function(){
                let nuevaVigencia = $(this).val();
                cargarMotivos(nuevaVigencia);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#codigo_puesto').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#clues_nomina').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#area_trabajo').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#ocupacion').select2({
                placeholder: "-- Seleccione una opcion --",
                allowClear: true
            });
        });
    </script>
    
@stop