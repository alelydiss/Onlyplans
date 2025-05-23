@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">
    @if(session('success'))
    <div id="success-popup" class="fixed inset-0 z-50 flex items-start justify-center p-4 pointer-events-none">
        <div class="bg-white dark:bg-gray-800 border border-green-300 dark:border-green-600 rounded-xl shadow-2xl overflow-hidden backdrop-blur-sm bg-opacity-90 max-w-lg w-full transition-all duration-500 ease-in-out transform translate-y-0 opacity-100">
            <div class="flex items-start">
                <div class="flex-shrink-0 p-4">
                    <svg class="h-8 w-8 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="flex-1 p-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Operación exitosa</h3>
                    <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                        {{ session('success') }}
                    </div>
                </div>
                <div class="flex-shrink-0 p-2">
                    <button onclick="hidePopup()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="h-1 bg-green-500 dark:bg-green-400 w-full">
                <div id="progress-bar" class="h-full bg-green-400 dark:bg-green-300 transition-all duration-3000 ease-linear"></div>
            </div>
        </div>
    </div>
    @endif
    <!-- Sidebar: Lista de eventos -->
    <aside class="col-span-1 bg-white dark:bg-gray-900 rounded-3xl shadow-2xl overflow-hidden flex flex-col animate-fadeIn max-h-[720px]">
        <div class="p-6 sticky top-0 z-10 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400 mb-4 tracking-tight flex items-center gap-2">
                <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg>
                Explora Eventos
            </h2>
            <input
                type="text"
                id="map-search"
                placeholder="Buscar eventos por título o ubicación..."
                class="mt-2 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
            />
        </div>

        <div class="overflow-y-auto grow px-4 py-4 space-y-6 custom-scroll">
            @foreach ($eventosmapa as $evento)
                <div id="evento-{{ $evento->id }}"
                    data-titulo="{{ strtolower($evento->titulo) }}"
                    data-ubicacion="{{ strtolower($evento->ubicacion) }}"
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg p-5 transition-all duration-300 hover:scale-[1.01] hover:shadow-2xl">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $evento->titulo }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">{{ $evento->ubicacion }}</p>
                    <div class="flex flex-col gap-2">
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-full transition duration-200"
                            onclick="centrarEnMapa({{ $evento->lat }}, {{ $evento->lng }})">
                            📍 Ver en el mapa
                        </button>
                        <a href="{{ route('evento', $evento->id) }}"
                            class="bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 hover:from-pink-600 hover:to-indigo-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg transition-transform duration-300 transform hover:scale-105 text-center">
                            🎟️ Comprar ticket
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Mapa -->
    <div class="col-span-2">
        <div id="map" class="rounded-3xl shadow-2xl min-h-[720px] h-full border border-gray-200 dark:border-gray-700 animate-fadeIn"></div>
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
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.8s ease-out;
    }
</style>
@endsection
@push('scripts')

<script>
            // Iniciar la barra de progreso
        setTimeout(() => {
            document.getElementById('progress-bar').style.width = '0%';
        }, 50);

        // Función para ocultar con animación
        function hidePopup() {
            const popup = document.getElementById('success-popup');
            if (popup) {
                popup.querySelector('div').classList.add('opacity-0', 'translate-y-[-20px]');
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 500);
            }
        }

        // Ocultar automáticamente después de 5 segundos
        setTimeout(() => {
            hidePopup();
        }, 5000);

    const eventos = @json($eventosmapa);
    let map, userMarker;

    function initMap() {
        const centroInicial = { lat: 37.3891, lng: -5.9845 };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: centroInicial,
            styles: [
                {
                    featureType: "poi.business",
                    stylers: [{ visibility: "off" }]
                },
                {
                    featureType: "transit",
                    elementType: "labels.icon",
                    stylers: [{ visibility: "off" }]
                }
            ]
        });

        eventos.forEach(evento => {
            const marker = new google.maps.Marker({
                position: { lat: parseFloat(evento.lat), lng: parseFloat(evento.lng) },
                map: map,
                title: evento.titulo,
                animation: google.maps.Animation.DROP,
                icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
            });

            const info = new google.maps.InfoWindow({
                content: `<div class='text-sm font-medium'>${evento.titulo}</div><div class='text-xs text-gray-500'>${evento.ubicacion}</div>`
            });

            marker.addListener("click", () => info.open(map, marker));
        });

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

    document.addEventListener("DOMContentLoaded", () => {
        const input = document.getElementById("map-search");
        input.addEventListener("input", function () {
            const search = this.value.toLowerCase().trim();
            let primerCoincidencia = null;

            eventos.forEach(evento => {
                const visible = evento.titulo.toLowerCase().includes(search) || evento.ubicacion.toLowerCase().includes(search);
                const divEvento = document.getElementById(`evento-${evento.id}`);
                if (divEvento) divEvento.classList.toggle("hidden", !visible);
                if (visible && !primerCoincidencia) primerCoincidencia = evento;
            });

            if (primerCoincidencia) centrarEnMapa(primerCoincidencia.lat, primerCoincidencia.lng);
        });
    });

    window.initMap = initMap;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endpush
