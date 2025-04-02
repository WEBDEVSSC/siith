@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Puesto</small></h1>
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

        <form action="{{ route('storePuesto') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Fiel</p>
                        <select name="fiel" id="fiel" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('fiel') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('fiel') == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>

                        @error('fiel')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Vigencia</p>
                        <input type="date" name="fiel_vigencia" id='fiel_vigencia' class="form-control" value="{{ old('fiel_vigencia') }}">

                        @error('fiel_vigencia')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Actividad</p>
                        <select name="actividad" id="actividad" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($actividades as $actividad)
                                <option value="{{ $actividad->actividad }}" {{ old('actividad') == $actividad->actividad ? 'selected' : '' }}>
                                    {{ $actividad->actividad }}
                                </option>
                            @endforeach
                        </select>
                        @error('actividad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Adicional</p>
                        <select name="adicional" id="adicional" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($adicionales as $adicional)
                                <option value="{{ $adicional->adicional }}" {{ old('adicional') == $adicional->adicional ? 'selected' : '' }}>
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
                        <p>Tipo de personal</p>
                        <select name="tipo_personal" id="tipo_personal" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($tiposPersonal as $tipoPersonal)
                                <option value="{{ $tipoPersonal->tipo_personal }}" {{ old('tipo_personal') == $tipoPersonal->tipo_personal ? 'selected' : '' }}>
                                    {{ $tipoPersonal->tipo_personal }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_personal')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Código de puesto</p>
                        <select name="codigo_puesto" id="codigo_puesto" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($codigosPuesto as $codigoPuesto)
                                <option value="{{ $codigoPuesto->codigo_puesto }}" {{ old('codigo_puesto') == $codigoPuesto->codigo_puesto ? 'selected' : '' }}>
                                    {{ $codigoPuesto->codigo_puesto }}
                                </option>
                            @endforeach
                        </select>
                        @error('codigo_puesto')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>CLUES Nomina</p>
                        <select name="clues_nomina" id="clues_nomina" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($clues as $clue)
                                <option value="{{ $clue->id }}" {{ old('clues_nomina') == $clue->id ? 'selected' : '' }}>
                                    {{ $clue->clave_jurisdiccion }} - {{ $clue->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('clues_nomina')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>CLUES Adscripcion</p>
                        <select name="clues_adscripcion" id="clues_adscripcion" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($clues as $clue)
                                <option value="{{ $clue->id }}" {{ old('clues_adscripcion') == $clue->id ? 'selected' : '' }}>
                                    {{ $clue->clave_jurisdiccion }} - {{ $clue->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('clues_adscripcion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                        <div class="col-md-3">
                            <p>Área de trabajo</p>
                            <select name="area_trabajo" id="area_trabajo" class="form-control select2">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($areasTrabajo as $areaTrabajo)
                                    <option value="{{ $areaTrabajo->area_trabajo }}" {{ old('area_trabajo') == $areaTrabajo->area_trabajo ? 'selected' : '' }}>
                                        {{ $areaTrabajo->area_trabajo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('area_trabajo')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p>Ocupación</p>
                            <select name="ocupacion" id="ocupacion" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($ocupaciones as $ocupacion)
                                    <option value="{{ $ocupacion->ocupacion }}" {{ old('ocupacion') == $ocupacion->ocupacion ? 'selected' : '' }}>
                                        {{ $ocupacion->ocupacion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ocupacion')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p>Nomina de pago</p>
                            <select name="nomina_pago" id="nomina_pago" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($nominasPago as $nominaPago)
                                    <option value="{{ $nominaPago->nomina }}" {{ old('nomina_pago') == $nominaPago->nomina ? 'selected' : '' }}>
                                        {{ $nominaPago->nomina }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nomina_pago')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p>Tipo de contrato</p>
                            <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                                <option value="">-- Selecciona una opción --</option>
                                @foreach ($tiposContrato as $tipoContrato)
                                    <option value="{{ $tipoContrato->tipo_contrato }}" {{ old('tipo_contrato') == $tipoContrato->tipo_contrato ? 'selected' : '' }}>
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
                <p>Fecha de ingreso</p>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso') }}">
                @error('fecha_ingreso')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p>Tipo de plaza</p>
                <select name="tipo_plaza" id="tipo_plaza" class="form-control">
                    <option value="">-- Selecciona una opción --</option>
                    @foreach ($tiposPlaza as $tipoPlaza)
                        <option value="{{ $tipoPlaza->tipo_plaza }}" {{ old('tipo_plaza') == $tipoPlaza->tipo_plaza ? 'selected' : '' }}>
                            {{ $tipoPlaza->tipo_plaza }}
                        </option>
                    @endforeach
                </select>
                @error('tipo_plaza')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <p>Institución a la que pertenece el puesto</p>
                <select name="institucion_puesto" id="institucion_puesto" class="form-control">
                    <option value="">-- Selecciona una opción --</option>
                    @foreach ($institucionesPuesto as $institucionPuesto)
                        <option value="{{ $institucionPuesto->abreviatura }}" {{ old('institucion_puesto') == $institucionPuesto->abreviatura ? 'selected' : '' }}>
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
                <p>Vigencia</p>
                <select name="vigencia" id="vigencia" class="form-control">
                    <option value="">Seleccione una vigencia</option>
                    @foreach($vigencias as $vigencia)
                        <option value="{{ $vigencia->vigencia }}" {{ old('vigencia') == $vigencia->vigencia ? 'selected' : '' }}>
                            {{ $vigencia->vigencia }}
                        </option>
                    @endforeach
                </select>
                @error('vigencia')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p>Motivo</p>
                <select name="vigencia_motivo" id="vigencia_motivo" class="form-control">
                    <option value="">Seleccione una vigencia</option>
                    @foreach($vigenciasMotivos as $vigenciaMotivo)
                        <option value="{{ $vigenciaMotivo->motivo }}" {{ old('vigencia_motivo') == $vigenciaMotivo->motivo ? 'selected' : '' }}>
                            {{ $vigenciaMotivo->motivo }}
                        </option>
                    @endforeach
                </select>
                @error('vigencia_motivo')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p>Temporalidad</p>
                <select name="temporalidad" id="temporalidad" class="form-control">
                    <option value="">-- Seleccione un motivo --</option>
                    <option value="SI" {{ old('temporalidad') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('temporalidad') == 'NO' ? 'selected' : '' }}>NO</option>
                </select>
                @error('temporalidad')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p>Licencia de Maternidad</p>
                <select name="licencia_maternidad" id="licencia_maternidad" class="form-control">
                    <option value="">-- Seleccione un motivo --</option>
                    <option value="SI" {{ old('licencia_maternidad') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('licencia_maternidad') == 'NO' ? 'selected' : '' }}>NO</option>
                </select>
                @error('licencia_maternidad')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- ---------------------------------------------------------------------- --> 

        
        <div class="row mt-3">
            <div class="col-md-3">
                <p>Seguro de Salud</p>
                <select name="seguro_salud" id="seguro_salud" class="form-control">
                    <option value="">-- Seleccione un motivo --</option>
                    <option value="SI" {{ old('seguro_salud') == 'SI' ? 'selected' : '' }}>SI</option>
                    <option value="NO" {{ old('seguro_salud') == 'NO' ? 'selected' : '' }}>NO</option>
                </select>
                @error('seguro_salud')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        


        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS DE PUESTO</button>
        </div>

    </form>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

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
            $('#vigencia').change(function(){
                let vigencia = $(this).val();
                $('#vigencia_motivo').empty().append('<option value="">Seleccione un motivo</option>');
    
                if(vigencia) {
                    $.ajax({
                        url: `/vigencias-motivos/${vigencia}`,
                        type: 'GET',
                        success: function(response) {
                            $.each(response, function(id, motivo){
                                $('#vigencia_motivo').append(`<option value="${motivo}">${motivo}</option>`);
                            });
                        }
                    });
                }
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
            $('#clues_adscripcion').select2({
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