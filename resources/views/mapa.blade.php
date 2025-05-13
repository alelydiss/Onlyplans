@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 lg:flex lg:gap-8">
    <!-- Lista de eventos -->
    <aside class="lg:w-1/3 w-full bg-white dark:bg-gray-900 rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="p-4 sticky top-0 z-10 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-extrabold text-indigo-600">🎉 Eventos disponibles</h2>
        </div>
        <div class="overflow-y-auto custom-scroll h-[600px] px-4 py-2 space-y-6">
            @foreach ($eventos as $evento)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 hover:shadow-xl transition-shadow duration-300">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $evento->titulo }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $evento->ubicacion }}</p>
                    <div class="mt-3 flex flex-col gap-2">
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-3 rounded"
                            onclick="centrarEnMapa({{ $evento->lat }}, {{ $evento->lng }})">
                            📍 Ver en el mapa
                        </button>
                        <a
                            href="{{ route('evento', ['evento' => $evento->id]) }}"
                            class="text-indigo-600 hover:underline text-sm font-semibold">
                            🎫 Comprar ticket
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Mapa -->
    <div class="lg:w-2/3 w-full mt-8 lg:mt-0">
        <div id="map" class="rounded-lg shadow h-[600px]"></div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: #6366f1;
        border-radius: 3px;
    }
    .custom-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
</style>
@endsection

@section('scripts')
<script>
    const eventos = @json($eventos);
    let map, userMarker;

    function initMap() {
        const centroInicial = { lat: 37.3891, lng: -5.9845 }; // Fallback Sevilla
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: centroInicial,
        });

        // Marcadores de eventos
        eventos.forEach(evento => {
            const marker = new google.maps.Marker({
                position: { lat: parseFloat(evento.lat), lng: parseFloat(evento.lng) },
                map: map,
                title: evento.titulo,
                animation: google.maps.Animation.DROP,
                icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
            });

            const info = new google.maps.InfoWindow({
                content: `<strong>${evento.titulo}</strong><br>${evento.ubicacion}`
            });

            marker.addListener("click", () => info.open(map, marker));
        });

        // Posición del usuario con ícono de Goku
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    userMarker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: "Tu ubicación",
                        animation: google.maps.Animation.DROP,
                        icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                    });

                    map.setCenter(pos);
                },
                (error) => {
                    console.warn("No se pudo obtener la ubicación del usuario", error);
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        }
    }

    function centrarEnMapa(lat, lng) {
        const position = new google.maps.LatLng(lat, lng);
        map.setZoom(14);
        map.panTo(position);
    }

    window.initMap = initMap;
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"
    async defer></script>
@endsection
