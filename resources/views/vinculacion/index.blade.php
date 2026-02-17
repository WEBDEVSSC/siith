@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Chartjs', true)

@section('content_header')
    <h1><strong>Vinculación y Gestión</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header"><strong>Distribución de trabajadores por municipio</strong></div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-md-6">
                    <div id="map"></div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-striped table-sm">
    
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:40px;"></th>
                                    <th>Municipio</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E63946;border-radius:3px;"></div>
                                    </td>
                                    <td>Allende</td>
                                    <td>{{ $allende }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E63946;border-radius:3px;"></div>
                                    </td>
                                    <td>Guerrero</td>
                                    <td>{{ $guerrero }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E63946;border-radius:3px;"></div>
                                    </td>
                                    <td>Hidalgo</td>
                                    <td>{{ $hidalgo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E63946;border-radius:3px;"></div>
                                    </td>
                                    <td>Nava</td>
                                    <td>{{ $nava }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E63946;border-radius:3px;"></div>
                                    </td>
                                    <td>Piedras Negras</td>
                                    <td>{{ $piedrasNegras }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E63946;border-radius:3px;"></div>
                                    </td>
                                    <td>Villa Unión</td>
                                    <td>{{ $villaUnion }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#FFFFFF80;border-radius:3px;"></div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                {{-- -----------------------------------------------------------------------------------}}

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E67E22;border-radius:3px;"></div>
                                    </td>
                                    <td>Acuña</td>
                                    <td>{{ $acuna }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E67E22;border-radius:3px;"></div>
                                    </td>
                                    <td>Jiménez</td>
                                    <td>{{ $jimenez }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E67E22;border-radius:3px;"></div>
                                    </td>
                                    <td>Morelos</td>
                                    <td>{{ $morelos }}</td>
                                </tr>
                                
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#E67E22;border-radius:3px;"></div>
                                    </td>
                                    <td>Zaragoza</td>
                                    <td>{{ $zaragoza }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#FFFFFF80;border-radius:3px;"></div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                {{-- -----------------------------------------------------------------------------------}}

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#27AE60;border-radius:3px;"></div>
                                    </td>
                                    <td>Juárez</td>
                                    <td>{{ $juarez }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#27AE60;border-radius:3px;"></div>
                                    </td>
                                    <td>Múzquiz</td>
                                    <td>{{ $muzquiz }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#27AE60;border-radius:3px;"></div>
                                    </td>
                                    <td>Progreso</td>
                                    <td>{{ $progreso }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#27AE60;border-radius:3px;"></div>
                                    </td>
                                    <td>Sabinas</td>
                                    <td>{{ $sabinas }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#27AE60;border-radius:3px;"></div>
                                    </td>
                                    <td>San Juan de Sabinas</td>
                                    <td>{{ $sanJuanDeSabinas }}</td>
                                </tr>
                            </tbody>

                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-striped table-sm">    
                            <thead class="thead-light">
                                    <tr>
                                        <th style="width:40px;"></th>
                                        <th>Municipio</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>Abasolo</td>
                                    <td>{{ $abasolo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>Candela</td>
                                    <td>{{ $candela }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>Castaños</td>
                                    <td>{{ $castanos }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>Escobedo</td>
                                    <td>{{ $escobedo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>Frontera</td>
                                    <td>{{ $frontera }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>Monclova</td>
                                    <td>{{ $monclova }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>Nadadores</td>
                                    <td>{{ $nadadores }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#3A86FF;border-radius:3px;"></div>
                                    </td>
                                    <td>San Buenaventura</td>
                                    <td>{{ $sanbuena }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#FFFFFF80;border-radius:3px;"></div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                {{-- ----------------------------------------------- --}}
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8338EC;border-radius:3px;"></div>
                                    </td>
                                    <td>Cuatro Cienegas</td>
                                    <td>{{ $cuatrocienegas }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8338EC;border-radius:3px;"></div>
                                    </td>
                                    <td>Lamadrid</td>
                                    <td>{{ $lamadrid }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8338EC;border-radius:3px;"></div>
                                    </td>
                                    <td>Ocampo</td>
                                    <td>{{ $ocampo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8338EC;border-radius:3px;"></div>
                                    </td>
                                    <td>Sacramento</td>
                                    <td>{{ $sacramento }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8338EC;border-radius:3px;"></div>
                                    </td>
                                    <td>Sierra Mojada</td>
                                    <td>{{ $sierraMojada }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                         <div class="col-md-4">
                            <table class="table table-striped table-sm">    
                            <thead class="thead-light">
                                    <tr>
                                        <th style="width:40px;"></th>
                                        <th>Municipio</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#2B2D42;border-radius:3px;"></div>
                                    </td>
                                    <td>Torreón</td>
                                    <td>{{ $torreon }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#2B2D42;border-radius:3px;"></div>
                                    </td>
                                    <td>Matamoros</td>
                                    <td>{{ $matamoros }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#2B2D42;border-radius:3px;"></div>
                                    </td>
                                    <td>Viesca</td>
                                    <td>{{ $viesca }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#FFFFFF80;border-radius:3px;"></div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                {{-- ------------------------------------------------------------}}

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#F1C40F;border-radius:3px;"></div>
                                    </td>
                                    <td>Fco. I. Madero</td>
                                    <td>{{ $fcoIMadero }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#F1C40F;border-radius:3px;"></div>
                                    </td>
                                    <td>San Pedro</td>
                                    <td>{{ $sanPedro }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#FFFFFF80;border-radius:3px;"></div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                {{-- ------------------------------------------------------------}}

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#F72585;border-radius:3px;"></div>
                                    </td>
                                    <td>Arteaga</td>
                                    <td>{{ $arteaga }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#F72585;border-radius:3px;"></div>
                                    </td>
                                    <td>General Cepeda</td>
                                    <td>{{ $generalCepeda }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#F72585;border-radius:3px;"></div>
                                    </td>
                                    <td>Parras</td>
                                    <td>{{ $parras }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#F72585;border-radius:3px;"></div>
                                    </td>
                                    <td>Ramos Arizpe</td>
                                    <td>{{ $ramosArizpe }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#F72585;border-radius:3px;"></div>
                                    </td>
                                    <td>Saltillo</td>
                                    <td>{{ $saltillo }}</td>
                                </tr>

                                </tbody>
                            </table>
                         </div>
                    </div>
                </div>
            </div>

            

        </div>
        <div class="card-footer">
            <div class="d-flex flex-wrap justify-content-center">

                <div class="legend-item">
                    <div class="color-box j1"></div>
                    <span>J1 - Piedras Negras</span>
                </div>

                <div class="legend-item">
                    <div class="color-box j2"></div>
                    <span>J2 - Acuña</span>
                </div>

                <div class="legend-item">
                    <div class="color-box j3"></div>
                    <span>J3 - Sabinas</span>
                </div>

                <div class="legend-item">
                    <div class="color-box j4"></div>
                    <span>J4 - Monclova</span>
                </div>

                <div class="legend-item">
                    <div class="color-box j5"></div>
                    <span>J5 - Cuatro Ciénegas</span>
                </div>

                <div class="legend-item">
                    <div class="color-box j6"></div>
                    <span>J6 - Torreón</span>
                </div>

                <div class="legend-item">
                    <div class="color-box j7"></div>
                    <span>J7 - Fco. I. Madero</span>
                </div>

                <div class="legend-item">
                    <div class="color-box j8"></div>
                    <span>J8 - Saltillo</span>
                </div>

            </div>
        </div>
    </div>

    {{-- ------------------------------------------------------------------------------------------ --}}

    <div class="row mt-3">
        <div class="col-6"> 
            <div class="card">
                <div class="card-header"><strong>Trabajadores por Jurisdiccion</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="profesionalesPorJurisdiccion" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-sm">
    
                            <thead class="thead-light">
                                <tr>
                                    <th>Jurisdicción</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j1"></div>
                                            <span>J1 - Piedras Negras</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion1 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j2"></div>
                                            <span>J2 - Acuña</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion2 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j3"></div>
                                            <span>J3 - Sabinas</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion3 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j4"></div>
                                            <span>J4 - Monclova</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion4 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j5"></div>
                                            <span>J5 - Cuatro Ciénegas</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion5 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j6"></div>
                                            <span>J6 - Torreón</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion6 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j7"></div>
                                            <span>J7 - Fco. I. Madero</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion7 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="legend-item">
                                            <div class="color-box j8"></div>
                                            <span>J8 - Saltillo</span>
                                        </div>
                                    </td>
                                    <td>{{ $profesionalesJurisdiccion8  + $profesionalesJurisdiccion9}}</td>
                                </tr>
                            </table>
                        </tbody>
                        </div>
                    </div>
                </div>
                <div class="card-footer">Footer</div>
            </div>
        </div>
        <div class="col-6"> 
            <div class="card">
                <div class="card-header"><strong>Trabajadores por Distritos</strong></div>
                <div class="card-body">Body</div>
                <div class="card-footer">Footer</div>
            </div>
        </div>
    </div>

    {{-- ------------------------------------------------------------------------------------------ --}}

@stop

@include('partials.footer')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<style>
    #map {
        height: 600px;
        width: 100%;
        border-radius: 10px;
    }

    .legend-item{
    display:flex;
    align-items:center;
    margin:6px 15px;
    }

    .color-box{
        width:18px;
        height:18px;
        border-radius:3px;
        margin-right:8px;
    }

    .j1{ background:#E63946; }
    .j2{ background:#E67E22; }
    .j3{ background:#27AE60; }
    .j4{ background:#3A86FF; }
    .j5{ background:#8338EC; }
    .j6{ background:#2B2D42; }
    .j7{ background:#FFD60A; }
    .j8{ background:#F72585; }
</style>
@stop

@section('js')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

    var municipios = @json($municipios);

    var map = L.map('map');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    fetch('/mapas/coahuila.geojson')
        .then(response => response.json())
        .then(data => {

            var geoLayer = L.geoJson(data, {

                style: function(feature) {

                    var nombre = feature.properties.NOMGEO;

                    if (municipios[nombre]) {
                        return {
                            fillColor: municipios[nombre].color,
                            weight: 1,
                            color: '#ffffff',
                            fillOpacity: 0.8
                        };
                    }

                    return {
                        fillColor: '#cccccc',
                        weight: 1,
                        color: '#ffffff',
                        fillOpacity: 0.4
                    };
                },

                onEachFeature: function(feature, layer) {

                    var nombre = feature.properties.NOMGEO;

                    if (municipios[nombre]) {
                        layer.bindPopup(
                            "<strong>" + nombre + "</strong><br>" +
                            "Total: " + municipios[nombre].total
                        );
                    } else {
                        layer.bindPopup("<strong>" + nombre + "</strong>");
                    }

                }

            }).addTo(map);

            map.fitBounds(geoLayer.getBounds());

        });

</script>

<script>
      // Espera a que el contenido del DOM esté cargado
      document.addEventListener('DOMContentLoaded', function() {
      // Obtén el contexto del canvas
      var ctx = document.getElementById('profesionalesPorJurisdiccion').getContext('2d');
      
      // Crea la gráfica de dona
      var myDoughnutChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['J1','J2','J3','J4','J5','J6','J7','J8'],
              datasets: [{
                  label: 'Número de votos',
                  data: [{{$profesionalesJurisdiccion1}}, {{$profesionalesJurisdiccion2}}, {{$profesionalesJurisdiccion3}}, {{$profesionalesJurisdiccion4}}, {{$profesionalesJurisdiccion5}}, {{$profesionalesJurisdiccion6}}, {{$profesionalesJurisdiccion7}}, {{$profesionalesJurisdiccion8}}], 
                  backgroundColor: [
                    'rgba(230, 57, 70, 0.6)',   // Rojo fresa
                    'rgba(255, 159, 28, 0.6)',   // Naranja vibrante
                    'rgba(46, 196, 182, 0.6)',   // Amarillo fuerte
                    'rgba(58, 134, 255, 0.6)',   // Verde-azulado
                    'rgba(131, 56, 236, 0.6)',   // Azul vivo
                    'rgba(43, 45, 66,, 0.6)',  // Morado claro
                    'rgba(255, 214, 10, 0.6)',    // Verde menta
                    'rgba(247, 37, 133, 0.6)',  // Fucsia claro  // Celeste brillante
                  ],
                  borderColor: [
                    'rgba(230, 57, 70, 1)',
                    'rgba(255, 159, 28, 1)',
                    'rgba(46, 196, 182, 1)',
                    'rgba(58, 134, 255, 1)',
                    'rgba(131, 56, 236, 1)',
                    'rgba(43, 45, 66, 1)',
                    'rgba(255, 214, 10, 1)',
                    'rgba(247, 37, 133, 1)',
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'none',
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
