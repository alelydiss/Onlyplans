@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Mapa de eventos</h1>

    <div id="map" style="height: 500px;" class="rounded shadow"></div>
</div>
@endsection

@section('scripts')
{{-- Script que define initMap primero --}}
<script>
    function initMap() {
        const centroMapa = { lat: 37.3891, lng: -5.9845 };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: centroMapa,
        });

        const eventos = @json($eventos);  // Los eventos pasan desde Laravel a JS

        eventos.forEach(evento => {
            new google.maps.Marker({
                position: {
                    lat: parseFloat(evento.lat),
                    lng: parseFloat(evento.lng)
                },
                map: map,
                title: evento.titulo // Usamos el título del evento para el marcador
            });
        });
    }

    // Hacemos visible la función globalmente
    window.initMap = initMap;
</script>

{{-- Carga el script DESPUÉS de definir initMap --}}
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"
    async
    defer>
</script>
@endsection
