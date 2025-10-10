@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Reportes</strong></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header"></div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-2">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>Mi Unidad</h3>

                    <p>Archivo Excel</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('profesionalExport') }}" class="small-box-footer">Descargar <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-2">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>Fotografías</h3>

                    <p>Carpeta</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('descargarCarpetaFotografias') }}" class="small-box-footer">Descargar <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>


    </div>
    <div class="card-footer"></div>
</div>


@stop

@include('partials.footer')

@section('css')
 

@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    


@stop