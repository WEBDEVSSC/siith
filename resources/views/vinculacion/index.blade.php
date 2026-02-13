@extends('adminlte::page')

@section('title', 'Dashboard')

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
                                        <div style="width:18px;height:18px;background-color:#1F3A5F;border-radius:3px;"></div>
                                    </td>
                                    <td>Allende</td>
                                    <td>{{ $allende }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#1F3A5F;border-radius:3px;"></div>
                                    </td>
                                    <td>Guerrero</td>
                                    <td>{{ $guerrero }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#1F3A5F;border-radius:3px;"></div>
                                    </td>
                                    <td>Hidalgo</td>
                                    <td>{{ $hidalgo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#1F3A5F;border-radius:3px;"></div>
                                    </td>
                                    <td>Nava</td>
                                    <td>{{ $nava }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#1F3A5F;border-radius:3px;"></div>
                                    </td>
                                    <td>Piedras Negras</td>
                                    <td>{{ $piedrasNegras }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#1F3A5F;border-radius:3px;"></div>
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
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
                                    </td>
                                    <td>Abasolo</td>
                                    <td>{{ $abasolo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
                                    </td>
                                    <td>Candela</td>
                                    <td>{{ $candela }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
                                    </td>
                                    <td>Castaños</td>
                                    <td>{{ $castanos }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
                                    </td>
                                    <td>Escobedo</td>
                                    <td>{{ $escobedo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
                                    </td>
                                    <td>Frontera</td>
                                    <td>{{ $frontera }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
                                    </td>
                                    <td>Monclova</td>
                                    <td>{{ $monclova }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
                                    </td>
                                    <td>Nadadores</td>
                                    <td>{{ $nadadores }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#8E44AD;border-radius:3px;"></div>
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
                                        <div style="width:18px;height:18px;background-color:#C0392B;border-radius:3px;"></div>
                                    </td>
                                    <td>Cuatro Cienegas</td>
                                    <td>{{ $cuatrocienegas }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#C0392B;border-radius:3px;"></div>
                                    </td>
                                    <td>Lamadrid</td>
                                    <td>{{ $lamadrid }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#C0392B;border-radius:3px;"></div>
                                    </td>
                                    <td>Ocampo</td>
                                    <td>{{ $ocampo }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#C0392B;border-radius:3px;"></div>
                                    </td>
                                    <td>Sacramento</td>
                                    <td>{{ $sacramento }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#C0392B;border-radius:3px;"></div>
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
                                        <div style="width:18px;height:18px;background-color:#16A085;border-radius:3px;"></div>
                                    </td>
                                    <td>Torreón</td>
                                    <td>{{ $torreon }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#16A085;border-radius:3px;"></div>
                                    </td>
                                    <td>Matamoros</td>
                                    <td>{{ $matamoros }}</td>
                                </tr>
                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#16A085;border-radius:3px;"></div>
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
                                        <div style="width:18px;height:18px;background-color:#2C3E50;border-radius:3px;"></div>
                                    </td>
                                    <td>Arteaga</td>
                                    <td>{{ $arteaga }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#2C3E50;border-radius:3px;"></div>
                                    </td>
                                    <td>General Cepeda</td>
                                    <td>{{ $generalCepeda }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#2C3E50;border-radius:3px;"></div>
                                    </td>
                                    <td>Parras</td>
                                    <td>{{ $parras }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#2C3E50;border-radius:3px;"></div>
                                    </td>
                                    <td>Ramos Arizpe</td>
                                    <td>{{ $ramosArizpe }}</td>
                                </tr>

                                <tr>
                                    <td style="width:40px;">
                                        <div style="width:18px;height:18px;background-color:#2C3E50;border-radius:3px;"></div>
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
                <div class="card-body">Body</div>
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

    .j1{ background:#1F3A5F; }
    .j2{ background:#E67E22; }
    .j3{ background:#27AE60; }
    .j4{ background:#8E44AD; }
    .j5{ background:#C0392B; }
    .j6{ background:#16A085; }
    .j7{ background:#F1C40F; }
    .j8{ background:#2C3E50; }
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
@stop
