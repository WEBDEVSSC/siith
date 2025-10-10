@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Tipo Nómina</strong></h1>
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

        <form action="{{ route('storeCambioTipoNomina') }}" method="POST">

            @csrf

            <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">

            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">

                    <div class="col-md-6">
                        <p><strong>Código de puesto</strong></p>
                        <select name="codigo_puesto" id="codigo_puesto" class="form-control select2">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($codigosPuesto as $codigoPuesto)
                                <option value="{{ $codigoPuesto->id }}"
                                    {{ old('codigo_puesto') == $codigoPuesto->id ? 'selected' : '' }}>
                                    {{ $codigoPuesto->codigo_puesto }} - {{ $codigoPuesto->codigo }}
                                </option>
                            @endforeach
                        </select>
                        @error('codigo_puesto')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Nómina de pago</strong></p>
                        <select name="nomina_pago" id="nomina_pago" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($nominasPago as $nominaPago)
                                <option value="{{ $nominaPago->id }}"
                                    {{ old('nomina_pago') == $nominaPago->id ? 'selected' : '' }}>
                                    {{ $nominaPago->nomina }}
                                </option>
                            @endforeach
                        </select>
                        @error('nomina_pago')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Tipo de contrato</strong></p>
                        <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($tiposContrato as $tipoContrato)
                                <option value="{{ $tipoContrato->tipo_contrato }}"
                                    {{ old('tipo_contrato') == $tipoContrato->tipo_contrato ? 'selected' : '' }}>
                                    {{ $tipoContrato->tipo_contrato }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_contrato')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>




                </div>

                <!-- ---------------------------------------------------------------------- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Fecha de ingreso</strong></p>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control"
                            value="{{ old('fecha_ingreso') }}">
                            @error('fecha_ingreso')
                                <br>
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Tipo de plaza</strong></p>
                        <select name="tipo_plaza" id="tipo_plaza" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($tiposPlaza as $tipoPlaza)
                                <option value="{{ $tipoPlaza->tipo_plaza }}"
                                    {{ old('tipo_plaza') == $tipoPlaza->tipo_plaza ? 'selected' : '' }}>
                                    {{ $tipoPlaza->tipo_plaza }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_plaza')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Seguro de Salud</strong></p>
                        <select name="seguro_salud" id="seguro_salud" class="form-control">
                            <option value="">-- Seleccione un motivo --</option>
                            <option value="SI" {{ old('seguro_salud') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('seguro_salud') == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>
                        @error('seguro_salud')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- ---------------------------------------------------------------------- -->

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS</button>
            </div>

        </form>
    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nómina de Pago</th>
                        <th>Tipo de Contrato</th>
                        <th>Tipo de Plaza</th>
                        <th>Seguro de Salud</th>
                        <th>Código de Puesto</th>
                        <th>Fecha de Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cambiosTipoNomina as $cambioTipoNomina)
                        <tr>
                            <td>{{ $cambioTipoNomina->nomina_pago ?? 'N/A' }}</td>
                            <td>{{ $cambioTipoNomina->tipo_contrato ?? 'N/A' }}</td>
                            <td>{{ $cambioTipoNomina->tipo_plaza ?? 'N/A' }}</td>
                            <td>{{ $cambioTipoNomina->seguro_salud ?? 'N/A' }}</td>
                            <td>{{ $cambioTipoNomina->codigo_puesto ?? 'N/A' }} -
                                {{ $cambioTipoNomina->codigo_puesto_label ?? 'N/A' }}</td>

                            <td>{{ $cambioTipoNomina->fecha_ingreso ? \Carbon\Carbon::parse($cambioTipoNomina->fecha_ingreso)->format('d-m-Y') : 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>



    </div>

    <br>

    

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    <style>
        /* Asegura que Select2 tenga el mismo alto y bordes redondeados */
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            /* Ajuste de altura */
            border-radius: 0.25rem !important;
            /* Bordes redondeados */
            border: 1px solid #ced4da !important;
            /* Color del borde */
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
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>

    <script>
$(function() {
    const baseUrl = "{{ url('contratos-por-nomina') }}";
    // valor por defecto si estás en edición
    const contratoSeleccionado = "{{ old('tipo_contrato', $profesional->tipo_contrato ?? '') }}";

    function cargarContratos(nomina, seleccionado = contratoSeleccionado) {
        $('#tipo_contrato').prop('disabled', true).html('<option>Cargando...</option>');

        if (!nomina) {
            $('#tipo_contrato').prop('disabled', false).html('<option value="">-- Selecciona una nómina primero --</option>');
            return;
        }

        $.get(`${baseUrl}/${encodeURIComponent(nomina)}`)
            .done(function(data) {
                let html = '<option value="">-- Selecciona una opción --</option>';
                data.forEach(function(item) {
                    const valor = item.tipo_contrato; // o item.id si quieres usar id
                    const selectedAttr = (valor == seleccionado) ? 'selected' : '';
                    html += `<option value="${valor}" ${selectedAttr}>${item.tipo_contrato}</option>`;
                });
                $('#tipo_contrato').html(html).prop('disabled', false);
            })
            .fail(function(xhr) {
                console.error('Error al cargar contratos:', xhr);
                $('#tipo_contrato').html('<option value="">-- Error al cargar --</option>').prop('disabled', false);
            });
    }

    // Cuando cambie la nómina
    $('#nomina_pago').on('change', function() {
        cargarContratos($(this).val(), null);
    });

    // Si la página carga con una nómina ya seleccionada (editar), carga los contratos
    if ($('#nomina_pago').val()) {
        cargarContratos($('#nomina_pago').val());
    }
});
</script>

    <script>
        $(document).ready(function() {
            $('#vigencia').change(function() {
                let vigencia = $(this).val();
                $('#vigencia_motivo').empty().append('<option value="">Seleccione un motivo</option>');

                if (vigencia) {
                    $.ajax({
                        url: `/vigencias-motivos/${vigencia}`,
                        type: 'GET',
                        success: function(response) {
                            $.each(response, function(id, motivo) {
                                $('#vigencia_motivo').append(
                                    `<option value="${motivo}">${motivo}</option>`);
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
