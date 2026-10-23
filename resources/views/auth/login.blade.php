@extends('adminlte::auth.login')

@section('css')
    {{-- Google Fonts (Roboto & Material Icons) --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        /* Base & Fondo Gris Claro Neutro */
        body.login-page {
            background: #e9ecef !important;
            font-family: 'Roboto', sans-serif !important;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            position: relative;
        }

        /* Tarjeta Estilo Material */
        .login-box {
            width: 400px;
        }

        .login-box .card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08), 0 4px 10px rgba(0, 0, 0, 0.04) !important;
            background: #ffffff;
            overflow: hidden;
        }

        .login-logo {
            margin-bottom: 0;
            padding: 30px 20px 10px 20px;
        }

        .login-logo a {
            font-weight: 500;
            color: #6f42c1 !important; /* Morado institucional */
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 30px !important;
        }

        .login-box-msg {
            color: #5f6368;
            font-size: 0.95rem;
            margin-bottom: 25px;
            padding: 0;
        }

        /* Inputs Flotantes */
        .md-form-group {
            position: relative;
            margin-bottom: 24px;
        }

        .md-form-group .form-control {
            border: none;
            border-bottom: 2px solid #dadce0;
            border-radius: 0;
            padding: 10px 35px 8px 0;
            background: transparent;
            font-size: 1rem;
            box-shadow: none !important;
            transition: border-color 0.2s ease-in-out;
        }

        .md-form-group .form-control:focus {
            border-bottom-color: #6f42c1; /* Morado al enfocar */
            background: transparent;
        }

        /* Íconos estilo Material */
        .md-form-group .material-icons {
            position: absolute;
            right: 0;
            top: 8px;
            color: #70757a;
            font-size: 20px;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .md-form-group .form-control:focus ~ .material-icons {
            color: #6f42c1; /* Morado al enfocar */
        }

        /* Botón Estilo Material de Ancho Completo */
        .btn-material {
            background-color: #6f42c1; /* Color institucional principal */
            color: #ffffff !important;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-radius: 6px;
            padding: 12px 16px;
            border: none;
            width: 100%;
            box-shadow: 0 3px 6px rgba(111, 66, 193, 0.3);
            transition: all 0.2s ease-in-out;
        }

        .btn-material:hover {
            background-color: #5a32a3; /* Tono morado más oscuro */
            box-shadow: 0 5px 12px rgba(111, 66, 193, 0.4);
            transform: translateY(-1px);
        }

        .btn-material:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(111, 66, 193, 0.3);
        }

        /* Enlaces */
        .material-link {
            color: #6f42c1;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .material-link:hover {
            color: #5a32a3;
            text-decoration: underline;
        }

        /* Pie de página (Footer) fuera de la tarjeta */
        .custom-page-footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            color: #6c757d;
            font-size: 0.875rem;
            font-weight: 400;
            letter-spacing: 0.3px;
            z-index: 1000;
        }
    </style>
@endsection

@section('auth_header')
    <p class="login-box-msg">Ingresa tus credenciales para acceder</p>
@endsection

@section('auth_body')
    <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email Input --}}
        <div class="md-form-group">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>
            <span class="material-icons">email</span>

            @error('email')
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password Input --}}
        <div class="md-form-group">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Contraseña" required>
            <span class="material-icons">lock</span>

            @error('password')
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Botón de Envío (Ancho Completo) --}}
        <div class="mt-4 mb-3">
            <button type="submit" class="btn btn-material">
                Entrar
            </button>
        </div>
    </form>
@endsection

@section('auth_footer')
    @if (Route::has('password.request'))
        <p class="mb-1 text-center">
            <a class="material-link" href="{{ route('password.request') }}">
                ¿Olvidaste tu contraseña?
            </a>
        </p>
    @endif
    @if (Route::has('register'))
        <p class="mb-0 text-center mt-2">
            <a class="material-link" href="{{ route('register') }}">
                Crear una cuenta nueva
            </a>
        </p>
    @endif
@endsection

{{-- Inyectamos el footer directamente al final de la página --}}
@section('js')
    <script>
        document.body.insertAdjacentHTML('beforeend', `
            <div class="custom-page-footer">
                Departamento de Mejora Continua | Subdirección de Recursos Humanos
            </div>
        `);
    </script>
@endsection