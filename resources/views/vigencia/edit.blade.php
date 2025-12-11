@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Vigencia</strong></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">

    <ul>
        <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
        <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
    </ul>
    
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>
            
        </div>

        <form action="{{ route('updateVigencia', $profesionalVigencia->id) }}" method="POST">

        @csrf 

        @method('PUT')
            
        <div class="card-body">

        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Vigencia</strong></p>
                <select name="vigencia" id="vigencia" class="form-control">
                    <option value="">Seleccione una vigencia</option>
                    @foreach($vigencias as $vigencia)
                        <option value="{{ $vigencia->vigencia }}" {{ old('vigencia', $profesionalVigencia->vigencia) == $vigencia->vigencia ? 'selected' : '' }}>
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
                    <option value="">Seleccione un motivo</option>
                </select>
                @error('vigencia_motivo')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p><strong>Fecha de inicio</strong></p>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio',$profesionalVigencia->fecha_inicio) }}">
                @error('fecha_inicio')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3">
                <p><strong>Fecha de término</strong></p>
                <input type="date" name="fecha_final" class="form-control" value="{{ old('fecha_final',$profesionalVigencia->fecha_final) }}">
                @error('fecha_final')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>           
            
        </div>

        <!-- ---------------------------------------------------------------------- --> 

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS DE VIGENCIA</button>
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
            // Inicializar todos los tooltips de la página
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route('storeVigencia') }}"]');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Evita que se envíe automáticamente

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas confirmar el registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, registrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Envía el formulario si confirma
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
        let vigenciaSeleccionada = $('#vigencia').val();
        let motivoSeleccionado = "{{ old('vigencia_motivo', $profesionalVigencia->vigencia_motivo) }}";
        let tipoNomina = "{{ $profesional->puesto->nomina_pago }}"; // Tipo de nómina

        function cargarMotivos(vigencia, motivoSeleccionado = null) {
            $('#vigencia_motivo').empty().append('<option value="">Seleccione un motivo</option>');

            if(vigencia) {
                $.ajax({
                    url: `/vigencias-motivos/${vigencia}`,
                    type: 'GET',
                    data: { nomina: tipoNomina },
                    success: function(response) {
                        $.each(response, function(index, motivo){
                            let selected = (motivoSeleccionado && motivoSeleccionado == motivo) ? 'selected' : '';
                            $('#vigencia_motivo').append(`<option value="${motivo}" ${selected}>${motivo}</option>`);
                        });
                    }
                });
            }
        }

        if (vigenciaSeleccionada) {
            cargarMotivos(vigenciaSeleccionada, motivoSeleccionado);
        }

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