@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1><strong>Vinculación y Gestión</strong></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.1. - Piedras Negras</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.2. - Acuña</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.3. - Sabinas</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.4. - Monclova</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
    </div>

    {{----}}

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.5. - Cuatro Ciénegas</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.6. - Torreón</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.7. - Fco. I. Madero</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><strong>J.8. - Saltillo</strong></p>
                <a href="#" class="btn btn-info btn-sm">Detalles</a>
            </div>
            </div>
        </div>
    </div>

    {{----}}
@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop