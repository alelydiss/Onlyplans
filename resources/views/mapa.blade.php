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
    
    <!-- Botón para móviles -->
    <div class="lg:hidden fixed bottom-6 left-6 z-30">
        <button id="sidebar-toggle" class="p-3 bg-indigo-600 text-white rounded-full shadow-xl hover:bg-indigo-700 transition-all transform hover:scale-110">
            <svg id="toggle-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Sidebar modificado para móviles -->
    <aside id="sidebar" class="col-span-1 bg-white dark:bg-gray-900 rounded-3xl shadow-2xl overflow-hidden flex flex-col animate-fadeIn max-h-[720px] fixed lg:static inset-0 z-20 lg:z-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="p-6 sticky top-0 z-10 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h2 class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400 mb-4 tracking-tight flex items-center gap-2">
                <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg>
                Explora Eventos
            </h2>
            <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="px-4 pt-2 pb-6">
            <input
                type="text"
                id="map-search"
                placeholder="Buscar eventos por título o ubicación..."
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
            />
        </div>

        <div class="overflow-y-auto grow px-4 pb-6 space-y-6 custom-scroll">
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

    <!-- Mapa (ahora ocupa todo el ancho en móviles) -->
    <div class="col-span-1 lg:col-span-2">
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
    
    /* Estilos específicos para móviles */
    @media (max-width: 1023px) {
        #sidebar {
            width: 85%;
            max-width: 350px;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        #map {
            min-height: calc(100vh - 96px);
        }
    }
</style>
@endsection

@push('scripts')
<script>
    // Función para mostrar/ocultar el sidebar en móviles
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const closeBtn = document.getElementById('close-sidebar');
        const toggleIcon = document.getElementById('toggle-icon');
        
        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                
                // Cambiar el icono del botón
                if (sidebar.classList.contains('-translate-x-full')) {
                    toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
                } else {
                    toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
                }
            });
        }
        
        if (closeBtn && sidebar) {
            closeBtn.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            });
        }
        
        // Cerrar sidebar al hacer clic en un evento (opcional)
        document.querySelectorAll('#sidebar .bg-white').forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    sidebar.classList.add('-translate-x-full');
                    toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
                }
            });
        });
    });

    // ... (mantener el resto del código JavaScript original) ...
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
        
        // En móviles, cerrar el sidebar después de centrar
        if (window.innerWidth < 1024) {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggle-icon');
            if (sidebar) sidebar.classList.add('-translate-x-full');
            if (toggleIcon) toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
        }
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