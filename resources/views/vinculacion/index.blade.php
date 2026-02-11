@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Vinculación y Gestión</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header"></div>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            

        </div>
        <div class="card-footer"></div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<style>
    #map {
        height: 600px;
        width: 100%;
        border-radius: 10px;
    }
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
