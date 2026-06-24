@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Descargas</strong></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="row">

                    <div class="col-md-2">
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Académicos</h3>

                            <p>Archivo ZIP</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('descargarArchivos') }}" class="small-box-footer">Descargar <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
            </div>

        </div>
    </div>

    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop