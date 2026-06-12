@extends('adminlte::page')

@section('title', 'Profesionales Eliminados')

@section('content_header')
    <h1><strong>Profesionales</strong> <small class="text-muted">Registros Eliminados</small></h1>
@stop

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha de eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($profesionales as $profesional)
                        <tr>
                            <td>{{ $profesional->id }}</td>
                            <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                            <td>{{ $profesional->curp }}</td>
                            <td>{{ $profesional->email }}</td>
                            <td>{{ $profesional->deleted_at }}</td>
                            <td>
                                <form action="{{ route('profesionalesRestaurar', $profesional->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-success btn-sm">
                                        RESTAURAR REGISTRO
                                    </button>
                                </form>

                                {{--<form action="{{ route('profesionales.forceDelete', $profesional->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('¿Eliminar definitivamente este registro?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar Definitivamente
                                    </button>
                                </form>--}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay registros eliminados.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

@stop