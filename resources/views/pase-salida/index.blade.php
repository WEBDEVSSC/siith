<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bootstrap Card</title>
  <!-- CSS de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <div class="container">
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header"><strong>S.I.I.T.H. | Pase de Salida</strong></div>

          <form action="{{ route('paseDeSalidaCreate') }}" method="GET">
            <div class="card-body">
              <p>Ingrese su CURP</p>
              <input type="text" name="curp" id="curp" class="form-control" value="{{ old('curp') }}" />

              <br />

              @error('curp')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-success btn-sm">BUSCAR TRABAJADOR</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JS de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
  @if (session('success'))
    Swal.fire({
      icon: 'success',
      title: '¡Éxito!',
      text: '{{ session('success') }}',
    });
  @endif

  @if (session('error'))
    Swal.fire({
      icon: 'error',
      title: '¡Error!',
      text: '{{ session('error') }}',
    });
  @endif
</script>

</body>
</html>
