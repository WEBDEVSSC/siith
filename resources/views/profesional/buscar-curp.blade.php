@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Nuevo Registro de Trabajador</strong></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <p><strong>Ingresa la CURP</strong></p>

        </div>

        <form action="{{ route('mostrarCurp') }}" method="POST">

        @csrf 
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="curp" id='curp' class="form-control" value="{{ old('curp') }}" onpaste="return false;">
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
                    <div class="col-md-6">
                        <input type="text" name="curp_confirma" id='curp_confirma' class="form-control" value="{{ old('curp_confirma') }}" onpaste="return false;">
                        @error('curp_confirma')
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

<form action="{{ route('guardar.qr') }}" method="POST">
    @csrf

    <div class="card">
        <div class="card-header">
            <strong>Escanee el Código QR de la CURP</strong>
        </div>
        <div class="card-body">

            <div id="reader" style="width: 300px;"></div>
            <div id="qr-result" class="mt-4 text-green-600 font-bold"></div>

            <p><strong>Escaneado:</strong> <span id="scanned-text"></span></p>

            <input type="hidden" name="qr" id="datos_escaneados">

            <button type="submit" id="guardar-btn" class="btn btn-primary btn-sm mt-2" style="display: none;">
                GUARDAR DATOS
            </button>

        </div>
        <div class="card-footer"></div>
    </div>
</form>


@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
        const html5QrCode = new Html5Qrcode("reader");
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            document.getElementById('scanned-text').textContent = decodedText;
            document.getElementById('datos_escaneados').value = decodedText;
            document.getElementById('guardar-btn').style.display = 'inline-block';

            // Detener el escaneo después de detectar un código
            html5QrCode.stop();
        };

        const config = { fps: 10, qrbox: 250 };
        html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
    </script>

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    
@stop