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

        <a href="{{ route('profesionalExport') }}">MI UNIDAD XLS</a>

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