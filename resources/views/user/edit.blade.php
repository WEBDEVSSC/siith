@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Usuarios</strong> <small>Editar registro</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('indexUsuario') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

        <form action="{{ route('updateUsuario', $usuario->id) }}" method="POST">

        @csrf 

        @method('PUT')
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $usuario->name) }}">                       
                    
                        @error('name')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Email</strong></p>
                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}">                        
                        @error('email')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Password</strong> <small>* No se muestra por motivos de seguridad</small></p>
                        <input type="text" name="password" id="password" class="form-control" value="{{ old('password') }}">         
                        @error('password')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Unidad</strong></p>
                        <select name="clue_id" id="clue_id" class="form-control select2">
                            <option value="">-- Selecciona una unidad --</option>
                            @foreach ($clues as $clue)                            
                                <option value="{{ $clue->id }}" {{ (old('clue_id') ?? $usuario->id_unidad) == $clue->id ? 'selected' : '' }}>
                                {{ $clue->nombre }}
                            </option>
                        @endforeach
                        </select>
                        @error('clue_id')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                                    

                </div>

                <!-- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Responsable</strong></p>
                        <input type="text" name="responsable" id="responsable" class="form-control" value="{{ old('responsable', $usuario->responsable) }}">              
                        @error('responsable')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Contacto</strong></p>
                        <input type="email" name="contacto" id="contacto" class="form-control" value="{{ old('contacto',$usuario->contacto) }}">              
                        @error('contacto')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Rol</strong></p>
                        <select name="rol" id="rol" class="form-control">
                            <option value="">-- Selecciona una unidad --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->rol }}"
                                    {{ (old('rol') ?? $usuario->role) == $role->rol ? 'selected' : '' }}>
                                    {{ $role->label_rol }}
                                </option>
                            @endforeach
                        </select>
                        @error('rol')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>   

                </div>


        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS DE USUARIO</button>
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
            $('#clue_id').select2({
                placeholder: "-- Selecciona una unidad --",
                allowClear: true
            });
        });
    </script>
@stop