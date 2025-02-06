@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Buscar CURP</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

        </div>

        <form action="{{ route('mostrarCurp') }}" method="POST">

        @csrf 
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <p>Ingresa la CURP</p>
                        <input type="text" name="curp" id='curp' class="form-control" value="{{ old('curp') }}">
                        @error('curp')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
<br>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">BUSCAR DATOS</button>
        </div>

    </form>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop