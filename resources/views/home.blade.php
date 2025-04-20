@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Chartjs', true)

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


@section('content_header')
    <h1><strong>Sistema Integral de Información y Talento Humano</strong></h1>
@stop

@section('content')

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

<!-- ---------------------------------------------------------- -->


<div class="row mt-3">
  <div class="col-md-6">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><strong>Jurisdicción</strong></h3>
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-md-6">

              <div>
                <canvas id="profesionalesPorJurisdiccion" width="400" height="400"></canvas>
              </div>

            </div>
            <div class="col-md-6">

              <table class="table">
                <tr>
                  <td>Jurisdiccion 1- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion1 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 2- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion2 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 3- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion3 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 4- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion4 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 5- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion5 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 6- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion6 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 7- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion7 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 8- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion8 }}</td>
                </tr>
                <tr>
                  <td>Jurisdiccion 9- Piedras Negras</td>
                  <td>{{ $profesionalesJurisdiccion9 }}</td>
                </tr>
              </table>

            </div>
          </div>
        
            

            

        </div>
    </div>

</div>
</div>


<!-- ---------------------------------------------------------- -->

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
          type: 'doughnut',
          data: {
              labels: ['J1','J2','J3','J4','J5','J6','J7','J8','J9'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$profesionalesJurisdiccion1}}, {{$profesionalesJurisdiccion2}}, {{$profesionalesJurisdiccion3}}, {{$profesionalesJurisdiccion4}}, {{$profesionalesJurisdiccion5}}, {{$profesionalesJurisdiccion6}}, {{$profesionalesJurisdiccion7}}, {{$profesionalesJurisdiccion8}}, {{$profesionalesJurisdiccion9}}], 
                  backgroundColor: [
                    'rgba(133, 193, 233, 0.2)',  // Azul cielo
                    'rgba(195, 155, 211, 0.2)',  // Lila
                    'rgba(249, 231, 159, 0.2)',  // Amarillo pastel
                    'rgba(125, 206, 160, 0.2)',  // Verde suave
                    'rgba(245, 183, 177, 0.2)',  // Rosa tenue
                    'rgba(240, 178, 122, 0.2)',  // Naranja claro
                    'rgba(255, 205, 210, 0.2)',  // Rosa claro
                    'rgba(174, 214, 241, 0.2)',  // Azul claro
                    'rgba(253, 253, 150, 0.2)'   // Amarillo claro
                ],
                borderColor: [
                    'rgba(133, 193, 233, 1)',
                    'rgba(195, 155, 211, 1)',
                    'rgba(249, 231, 159, 1)',
                    'rgba(125, 206, 160, 1)',
                    'rgba(245, 183, 177, 1)',
                    'rgba(240, 178, 122, 1)',
                    'rgba(255, 205, 210, 1)',
                    'rgba(174, 214, 241, 1)',
                    'rgba(253, 253, 150, 1)'
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