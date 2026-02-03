@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Código Postal</strong></h1>
@stop

@section('content')

<!-- -->

@php
    $alerts = [
        'success',
        'update',
        'delete'
    ];
@endphp

@foreach ($alerts as $alert)
    @if(session($alert))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Éxito',
                    text: "{{ session($alert) }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            });
        </script>
    @endif
@endforeach

<!-- -->
    
<div class="card">
        <div class="card-header">
            <a href="{{ route('indexCodigoPostal') }}" class="btn btn-success btn-sm">PANEL DE CONTROL</a>
        </div>
        <div class="card-body">

        <form action="{{ route('storeCodigoPostal') }}" method="POST">

        @csrf

        @method('POST')

        <div class="row">
            
           <div class="col-md-3">
                <p><strong>Código Postal</strong></p>
                <input type="text" name="codigo_postal" class="form-control" value="{{ old('codigo_postal') }}">
                @error('codigo_postal')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
           </div>

           <div class="col-md-3">
                <p><strong>Colonia</strong></p>
                <input type="text" name="colonia" class="form-control" value="{{ old('colonia') }}">
                @error('colonia')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
           </div>

           <div class="col-md-3">
            <p><strong>Entidad</strong></p>
            <select id="entidad" class="form-control" name="entidad">
                <option value="">Seleccione una entidad</option>
                @foreach($entidades as $entidad)
                    <option value="{{ $entidad->id }}">
                        {{ $entidad->nombre }}
                    </option>
                @endforeach
            </select>
            @error('entidad')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="col-md-3">
            <p><strong>Municipio</strong></p>
            <select id="municipio" class="form-control" disabled name="municipio">
                <option value="">Seleccione un municipio</option>
            </select>
            @error('municipio')
                <br><div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        </div>

        </div>
        <div class="card-footer">

            <button type="submit" class="btn btn-success btn-sm">REGISTRAR DATOS</button>

        </form>
        </div>
</div>

        

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
        $(document).ready(function() {
            // Inicializar todos los tooltips de la página
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>$(document).ready( function () {
        $(document).ready(function() {
        $('#profesionalesTable').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
    } );
    </script>

    
<script>
document.getElementById('entidad').addEventListener('change', function () {

    let entidadId = this.value;
    let municipioSelect = document.getElementById('municipio');

    municipioSelect.innerHTML = '<option value="">Cargando...</option>';
    municipioSelect.disabled = true;

    if (!entidadId) {
        municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
        return;
    }

    fetch(`/municipios/${entidadId}`)
        .then(response => response.json())
        .then(data => {
            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';

            data.forEach(municipio => {
                municipioSelect.innerHTML += 
                    `<option value="${municipio.id}">
                        ${municipio.nombre}
                    </option>`;
            });

            municipioSelect.disabled = false;
        })
        .catch(error => {
            console.error(error);
            municipioSelect.innerHTML = '<option>Error al cargar</option>';
        });
});
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-eliminar');
    
        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Detener el envío inmediato
    
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Enviar el formulario si el usuario confirma
                    }
                });
            });
        });
    });
    </script>

@stop