@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-purple-700 dark:text-purple-300">Crear un Nuevo Evento</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg dark:shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Detalles del Evento</h2>

            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Título del Evento</label>
                <input type="text" name="titulo" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Introduce el nombre del evento" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Categoría del Evento</label>
                <select name="categoria" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" required>
                    <option value="">Seleccione una</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>                
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Fecha de Cierre</label>
                    <input type="date" name="fecha_fin" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Hora de Inicio</label>
                    <input type="time" name="hora_inicio" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Hora de Cierre</label>
                    <input type="time" name="hora_fin" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Banner</label>
                <div class="flex items-center space-x-4">
                    <label for="banner" class="cursor-pointer bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                        Seleccionar archivo
                    </label>
                    <span id="nombre-archivo" class="text-sm text-gray-600 dark:text-gray-300">Ningún archivo seleccionado</span>
                </div>
                <input type="file" id="banner" name="banner" class="hidden">
                <img id="preview" src="" alt="Vista previa" class="mt-4 w-64 h-auto hidden rounded-xl shadow">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">¿Qué tipo de evento estás realizando?</label>
                <div class="grid sm:grid-cols-2 gap-4">
                    <label class="flex flex-col items-center justify-center p-6 border border-gray-300 dark:border-gray-600 rounded-2xl cursor-pointer bg-blue-50 dark:bg-gray-700 transition hover:shadow-lg">
                        <img src="/img/boleto.png" alt="Icono Boleto" class="w-16 h-16 mb-2">
                        <input type="radio" name="tipo_evento" value="ticket" class="mb-2 tipo-evento" required>
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-100">Evento con Ticket</span>
                    </label>
                    <label class="flex flex-col items-center justify-center p-6 border border-gray-300 dark:border-gray-600 rounded-2xl cursor-pointer bg-gray-50 dark:bg-gray-700 transition hover:shadow-lg">
                        <img src="/img/gratis.png" alt="Icono Gratis" class="w-16 h-16 mb-2">
                        <input type="radio" name="tipo_evento" value="gratis" class="mb-2 tipo-evento" required>
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-100">Evento Gratis</span>
                    </label>
                </div>
            </div>

            <div class="mb-4" id="precio-container" style="display: none;">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Precio del ticket</label>
                <input type="number" name="precio" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" placeholder="€ 0.00">
            </div>

            <div class="mb-6">
                <label for="map" class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Ubicación en el mapa</label>
                <div id="map" class="w-full h-96 rounded-xl shadow-lg"></div>
                <input type="hidden" name="latitud" id="latitud">
                <input type="hidden" name="longitud" id="longitud">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Dirección textual (opcional)</label>
                <input type="text" name="ubicacion" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" placeholder="Introduce la dirección">
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Descripción del evento</label>
                <textarea name="descripcion" rows="5" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg" placeholder="Describe los detalles del evento..."></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                    Guardar & Continuar
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- Script para vista previa de imagen -->
<script>
    document.getElementById('banner').addEventListener('change', function () {
        const archivo = this.files[0];
        const nombre = archivo ? archivo.name : 'Ningún archivo seleccionado';
        document.getElementById('nombre-archivo').textContent = nombre;

        if (archivo) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(archivo);
        }
    });
</script>

<!-- Mostrar precio solo si es con ticket -->
<script>
    document.querySelectorAll('.tipo-evento').forEach(radio => {
        radio.addEventListener('change', () => {
            const precioContainer = document.getElementById('precio-container');
            if (radio.value === 'ticket') {
                precioContainer.style.display = 'block';
            } else {
                precioContainer.style.display = 'none';
            }
        });
    });
</script>

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2ySlqx-Xhh8itm44_l7GnHZeqlKZoxJY&callback=initMap" async defer></script>
<script>
    function initMap() {
        const defaultLocation = { lat: 37.4, lng: -5.9 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: defaultLocation
        });

        const marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true
        });

        document.getElementById("latitud").value = defaultLocation.lat;
        document.getElementById("longitud").value = defaultLocation.lng;

        marker.addListener("dragend", function () {
            const position = marker.getPosition();
            document.getElementById("latitud").value = position.lat();
            document.getElementById("longitud").value = position.lng();
        });

        map.addListener("click", function (e) {
            marker.setPosition(e.latLng);
            document.getElementById("latitud").value = e.latLng.lat();
            document.getElementById("longitud").value = e.latLng.lng();
        });
    }
</script>
@endsection
