@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1><strong>Vinculación y Gestión</strong></h1>
@stop

@section('content')

    {{----}}

    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Piedras Negras</h3>

                <p>Jurisdicción 1</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Acuña</h3>

                <p>Jurisdicción 2</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Sabinas</h3>

                <p>Jurisdicción 3</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Monclova</h3>

                <p>Jurisdicción 4</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
    </div>

    {{----}}

    {{----}}

    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Cuatro Ciénegas</h3>

                <p>Jurisdicción 5</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Torreón</h3>

                <p>Jurisdicción 6</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Fco. I. Madero</h3>

                <p>Jurisdicción 7</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Saltillo</h3>

                <p>Jurisdicción 8</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="#" class="small-box-footer">
                Ver detalles <i class="fas fa-arrow-circle-right"></i>
              </a>
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