@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Chartjs', true)

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


@section('content_header')
    <h1><strong>Sistema Integral de Información y Talento Humano</strong></h1>
@stop

@section('content')

@auth
@if(auth()->user()->role === 'root' || auth()->user()->role === 'admin')

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$profesionalesActivos}}</h3>

              <p>Trabajadores Activos</p>
            </div>
            <div class="icon">
              <i class="ion-android-contacts"></i>
            </div>
          </div>
    </div>
    <div class="col-md-3">
      <!-- small box -->
      <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$profesionalesBajaTemporal}}</h3>

            <p>Baja Temporal</p>
          </div>
          <div class="icon">
            <i class="ion-ios-minus"></i>
          </div>
        </div>
  </div>
  <div class="col-md-3">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$profesionalesActivosMasculino}}</h3>

          <p>Hombres</p>
        </div>
        <div class="icon">
          <i class="ion-male"></i>
        </div>
      </div>
</div>
<div class="col-md-3">
  <!-- small box -->
  <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$profesionalesActivosFemenino}}</h3>

        <p>Mujeres</p>
      </div>
      <div class="icon">
        <i class="ion-female"></i>
      </div>
    </div>
</div>
</div>

<div class="row mt-2">

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Jurisdicción</strong></h3>
      </div>
      <div class="card-body">
        <canvas id="profesionalesPorJurisdiccion" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Nómina de Pago</strong></h3>
      </div>
      <div class="card-body">
        <canvas id="profesionalesNominaDePago" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Tipo de Contrato</strong></h3>
      </div>
      <div class="card-body">
        <canvas id="profesionalesContratos" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
      </div>
    </div>
  </div>

</div>


<!-- ---------------------------------------------------------- -->
<div class="row mt-2">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <strong>Nóminas por rangos de edad</strong>
      </div>

      <div class="card-body">
        
      </div> <!-- cierre de card-body -->

      <div class="card-footer">
        <!-- Footer opcional -->
      </div>
    </div> <!-- cierre de card -->
  </div> <!-- cierre de col-12 -->
</div> <!-- cierre de row -->


<!-- ---------------------------------------------------------- -->
@endif
@endauth

@include('partials.footer')

@stop



@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesPorJurisdiccion').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['J1','J2','J3','J4','J5','J6','J7','J8','J9'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$profesionalesJurisdiccion1}}, {{$profesionalesJurisdiccion2}}, {{$profesionalesJurisdiccion3}}, {{$profesionalesJurisdiccion4}}, {{$profesionalesJurisdiccion5}}, {{$profesionalesJurisdiccion6}}, {{$profesionalesJurisdiccion7}}, {{$profesionalesJurisdiccion8}}, {{$profesionalesJurisdiccion9}}], 
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',   // Rojo fresa
                    'rgba(255, 159, 64, 0.6)',   // Naranja vibrante
                    'rgba(255, 205, 86, 0.6)',   // Amarillo fuerte
                    'rgba(75, 192, 192, 0.6)',   // Verde-azulado
                    'rgba(54, 162, 235, 0.6)',   // Azul vivo
                    'rgba(153, 102, 255, 0.6)',  // Morado claro
                    'rgba(0, 204, 102, 0.6)',    // Verde menta
                    'rgba(255, 102, 255, 0.6)',  // Fucsia claro
                    'rgba(102, 204, 255, 0.6)'   // Celeste brillante
                  ],
                  borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(0, 204, 102, 1)',
                    'rgba(255, 102, 255, 1)',
                    'rgba(102, 204, 255, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'right',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>

  <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesNominaDePago').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['REG','FOR','FOR2','FOR3','610','6MR','FED','EVE','HOM','BUR','IB','UNE','DIF PS', 'DIF OC','RAMO 12','PASANTE SP', 'HON', 'ISSREEI', 'UMM'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$nominaRegularizado}}, {{$nominaFormalizadoUno}}, {{$nominaFormalizadoDos}}, {{$nominaFormalizadoTres}}, {{$nominaPasanteServicioSocial}}, {{$nominaMedicoResidente}}, {{$nominaFederal420}}, {{$nominaEventual}}, {{$nominaHomogado}}, {{$nominaBurocrata}}, {{$nominaImssBienestar}}, {{$nominaUnemes}}, {{$nominaDifOc}}, {{$nominaRamoDoce}}, {{$nominaPasanteSinPago}}, {{$nominaHonorarios}}, {{$nominaIssreei}}, {{$nominaUmmFam}}], 
              backgroundColor: [
                'rgba(255, 99, 132, 0.6)',   // Rojo fresa
                'rgba(255, 159, 64, 0.6)',   // Naranja vibrante
                'rgba(255, 205, 86, 0.6)',   // Amarillo fuerte
                'rgba(75, 192, 192, 0.6)',   // Verde-azulado
                'rgba(54, 162, 235, 0.6)',   // Azul vivo
                'rgba(153, 102, 255, 0.6)',  // Morado claro
                'rgba(255, 102, 255, 0.6)',  // Fucsia claro
                'rgba(0, 204, 102, 0.6)',    // Verde menta
                'rgba(255, 153, 204, 0.6)',  // Rosa pastel
                'rgba(255, 204, 102, 0.6)',  // Amarillo naranja
                'rgba(102, 204, 255, 0.6)',  // Celeste brillante
                'rgba(204, 153, 255, 0.6)',  // Lavanda fuerte
                'rgba(255, 153, 153, 0.6)',  // Coral claro
                'rgba(204, 255, 153, 0.6)',  // Verde lima pálido
                'rgba(153, 255, 204, 0.6)',  // Verde aguamarina
                'rgba(255, 102, 102, 0.6)',  // Rojo coral
                'rgba(102, 255, 255, 0.6)',  // Cian claro
                'rgba(255, 178, 102, 0.6)'   // Melón suave
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 102, 255, 1)',
                'rgba(0, 204, 102, 1)',
                'rgba(255, 153, 204, 1)',
                'rgba(255, 204, 102, 1)',
                'rgba(102, 204, 255, 1)',
                'rgba(204, 153, 255, 1)',
                'rgba(255, 153, 153, 1)',
                'rgba(204, 255, 153, 1)',
                'rgba(153, 255, 204, 1)',
                'rgba(255, 102, 102, 1)',
                'rgba(102, 255, 255, 1)',
                'rgba(255, 178, 102, 1)'
              ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'right',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>

  <script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesContratos').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['CONFIANZA','BASE','EVENTUAL','HONORARIOS','BECAS','OTROS'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$contratoConfianza}}, {{$contratoBase}}, {{$contratoEventual}}, {{$contratoHonorarios}}, {{$contratoBecas}}, {{$contratoOtros}}], 
              backgroundColor: [
                'rgba(255, 99, 132, 0.6)',   // Rojo fresa
                'rgba(255, 159, 64, 0.6)',   // Naranja vibrante
                'rgba(255, 205, 86, 0.6)',   // Amarillo fuerte
                'rgba(75, 192, 192, 0.6)',   // Verde-azulado
                'rgba(54, 162, 235, 0.6)',   // Azul vivo
                'rgba(153, 102, 255, 0.6)',  // Morado claro
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
              ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'right',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                      }
                  }
              }
          }
      });
  });
  
  </script>

@stop