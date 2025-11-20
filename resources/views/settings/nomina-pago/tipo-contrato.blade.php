@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Nóminas de Pago y Contratos</strong> <small>Tipo de Contrato</small></h1>
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
            <a href="{{ route('nominaPagoIndex') }}" class="btn btn-success btn-sm">PANEL DE CONTROL</a>
        </div>
        <div class="card-body">

        <form action="{{ route('tipoDeContratoStore') }}" method="POST">

        @csrf

        <input type="hidden" name="nomina_pago" value="{{ $tipoDeNomina->id }}">

        <div class="row">
            
           <div class="col-md-3">
                <p><strong>Descripción</strong></p>

                <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                    <option value="">-- Seleccione una Opción --</option>
                    <option value="ASIMILADOS">ASIMILADOS</option>
                    <option value="BASE">BASE</option>
                    <option value="BECAS">BECAS</option>
                    <option value="CONFIANZA">CONFIANZA</option>
                    <option value="EVENTUAL">EVENTUAL</option>
                    <option value="HONORARIOS">HONORARIOS</option>
                </select>

                @error('label_rol')
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

<div class="card">
    <div class="card-header">
        <strong>Tipos de contrato asignados al tipo de nómina {{ $tipoDeNomina->nomina }}</strong>
    </div>
    <div class="card-body">

        @if ($tiposDeContrato->isEmpty())
            <div class="alert alert-info">No se encontraron contratos para esta nómina.</div>
        @else
            <table class="table table-bordered table-striped">
                <tbody>
                    @foreach ($tiposDeContrato as $tipoDeContrato)
                        <tr>
                            <td>{{ $tipoDeContrato->tipo_contrato }}</td>
                            <td>
                                <form action="{{ route('tipoDeContratoDelete', $tipoDeContrato->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
    <div class="card-footer"></div>
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