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

    @if(auth()->user()->role == 'ofJurisdiccional')

    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">

            <form action="{{ route('descargarArchivosClues') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="clues">CLUES</label>
                <select name="clues" id="clues" class="form-control">
                    <option value="">-- Seleccione una opción --</option>

                    @foreach($clues as $clue)
                        <option value="{{ $clue->clues }}">
                            {{ $clue->clues }} - {{ $clue->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-hospital-alt mr-1"></i> SELECCIONAR CLUES
            </button>
        </div>
    </div>
        
    @endif
    
    

    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop