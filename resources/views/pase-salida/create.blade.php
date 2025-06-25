<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap Card</title>
  <!-- CSS de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container">
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong>S.I.I.T.H. | Pase de Salida</strong>
          </div>
          
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">

                <p><strong>Nombre completo:</strong> {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p>
                <p><strong>CURP:</strong> {{ $profesional->curp }}</p>
                <p><strong>RFC:</strong> {{ $profesional->rfc ?? 'N/D' }}{{ $profesional->homoclave}}</p>
                <p><strong>Nomina:</strong> {{ $profesional->puesto->nomina_pago ?? 'N/D' }}</p>
                

                <table class="table table-bordered table-hover table-striped align-middle text-center">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">ÁREA</th>
                      <th scope="col">SUBÁREA</th>
                      <th scope="col">PROGRAMA</th>
                      <th scope="col">COMPONENTE</th>
                      <th scope="col">OCUPACIÓN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $ocupacion->id_catalogo_uno }}</td>
                      <td>{{ $ocupacion->area_uno }}</td>
                      <td>{{ $ocupacion->subarea_uno }}</td>
                      <td>{{ $ocupacion->programa_uno }}</td>
                      <td>{{ $ocupacion->componente_uno }}</td>
                      <td>{{ $ocupacion->ocupacion_uno }}</td>
                    </tr>
                    <tr>
                      <td>{{ $ocupacion->id_catalogo_dos }}</td>
                      <td>{{ $ocupacion->area_dos }}</td>
                      <td>{{ $ocupacion->subarea_dos }}</td>
                      <td>{{ $ocupacion->programa_dos }}</td>
                      <td>{{ $ocupacion->componente_dos }}</td>
                      <td>{{ $ocupacion->ocupacion_dos }}</td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>

            <form action="{{route('paseDeSalidaStore')}}" method="POST">

            @csrf

            <input type="hidden" name="id_profesional" value="{{$profesional->id}}">
            <input type="hidden" name="fecha" value={{ $fecha }}>
            <input type="hidden" name="nomina" value={{ $profesional->puesto->nomina_pago ?? 'N/D' }}>

            <div class="row mt-3">
              <div class="col-md-4">
                <p><strong>Autoriza</strong></p>
                  <select name="jefe" id="jefe" class="form-control">
                    <option value="">-- Selecciona --</option>
                      @foreach ($consultaJefes as $jefe)
                        <option value="{{ $jefe->id_profesional }}">{{ $jefe->profesional->nombre ?? 'Sin nombre' }} {{ $jefe->profesional->apellido_paterno ?? 'Sin nombre' }} {{ $jefe->profesional->apellido_materno ?? 'Sin nombre' }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-md-4">
                <p><strong>Tipo</strong></p>
                <select name="tipo" id="tipo" class="form-control">
                  <option value="">-- Seleccione una opcion --</option>
                  <option value="SINDICAL" {{ old('tipo') == 'SINDICAL' ? 'selected' : '' }}>SINDICAL</option>
                  <option value="OFICIAL" {{ old('tipo') == 'OFICIAL' ? 'selected' : '' }}>OFICIAL</option>
                  <option value="PARTICULAR" {{ old('tipo') == 'PARTICULAR' ? 'selected' : '' }}>PARTICULAR</option>
                </select>
              </div>
              <div class="col-md-4">
                <p><strong>Fecha</strong></p>
                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($fecha)->format('d-m-Y') }}" disabled>
              </div>
            </div>

            
          <div class="row mt-3">
            <div class="col-md-4">
              <p><strong>Hora inicio</strong></p>
              <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio') }}">
            </div>
             <div class="col-md-4">
              <p><strong>Hora final</strong></p>
              <input type="time" name="hora_final" id="hora_final" class="form-control" value="{{ old('hora_final') }}">
            </div>
          </div>

          </div>

          <div class="card-footer text-end">
            <button type="submit" class="btn btn-success btn-sm">SOLICITAR PASE DE SALIDA</button>
            </form>
          </div>
        </div>

        <!-- -->

        <div class="row mt-3">
          <div class="col-md-12">
            @if ($errors->has('hora_final'))
                <div class="alert alert-danger">
                    {{ $errors->first('hora_final') }}
                </div>
            @endif
          </div>
        </div>

        <!-- -->

        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header"><strong>Mis pases de salida</strong></div>
              <div class="card-body">

                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Tiempo autorizado</th>
                        <th>Hora inicio</th>
                        <th>Hora final</th>
                        <th>Folio</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profesional->pasesDeSalida as $pase)
                        <tr>
                            <td>{{ $pase->id }}</td>
                            <td>{{ $pase->fecha->format('d-m-Y') }}</td>
                            <td>{{ $pase->tipo }}</td>
                            <td>{{ $pase->tiempo_autorizado }}</td>
                            <td>{{ $pase->hora_inicio->format('H:i') }}</td>
                            <td>{{ $pase->hora_final->format('H:i') }}</td>
                            <td>{{ $pase->folio }}</td>
                            <td>{{ $pase->status == 0 ? 'PENDIENTE' : 'AUTORIZADO' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>

        <!-- -->
      </div>
    </div>
  </div>

  <!-- JS de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
