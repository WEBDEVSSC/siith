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
                <div class="col-md-6"></div>
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
