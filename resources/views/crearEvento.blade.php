@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Encabezado con progreso -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-bold mb-2 bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent">Crea tu Evento</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">Comparte tu evento con el mundo en pocos pasos</p>
        
        <!-- Barra de progreso -->
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 mb-6 mx-auto max-w-2xl">
            <div id="progress-bar" class="bg-gradient-to-r from-purple-500 to-blue-500 h-3 rounded-full transition-all duration-300" style="width: 25%"></div>
        </div>
        
        <!-- Indicadores de pasos -->
        <div class="flex justify-between max-w-2xl mx-auto px-4">
            <div class="step-indicator active" data-step="1">
                <div class="w-10 h-10 mx-auto bg-purple-600 rounded-full flex items-center justify-center text-white font-bold mb-1">1</div>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Información</span>
            </div>
            <div class="step-indicator" data-step="2">
                <div class="w-10 h-10 mx-auto bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 font-bold mb-1">2</div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Ubicación</span>
            </div>
            <div class="step-indicator" data-step="3">
                <div class="w-10 h-10 mx-auto bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 font-bold mb-1">3</div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Detalles</span>
            </div>
            <div class="step-indicator" data-step="4">
                <div class="w-10 h-10 mx-auto bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 font-bold mb-1">4</div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Confirmación</span>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Hubo errores con tu envío</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    <form method="POST" enctype="multipart/form-data" class="space-y-6" id="event-form">
        @csrf

        <!-- Paso 1: Información básica -->
        <div class="step-content bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl dark:shadow-lg transition-all duration-300" data-step="1">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Información básica del evento</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Columna izquierda -->
                <div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Título del evento</label>
                        <input type="text" name="titulo" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="Ej: Festival de Música 2023" required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Categoría</label>
                        <select name="categoria" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition appearance-none" required>
                            <option value="">Selecciona una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Fechas del evento</label>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" required>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Fecha de fin</label>
                                <input type="date" name="fecha_fin" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Horario</label>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Hora de inicio</label>
                                <input type="time" name="hora_inicio" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" required>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Hora de fin</label>
                                <input type="time" name="hora_fin" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha - Subida de imagen -->
                <div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Imagen del evento</label>
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-6 text-center transition hover:border-purple-500" id="dropzone">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Arrastra y suelta tu imagen aquí</p>
                                <p class="text-sm text-gray-400">o</p>
                                <label for="banner" class="cursor-pointer bg-gradient-to-r from-purple-500 to-blue-500 text-white px-6 py-2 rounded-lg font-medium transition hover:shadow-lg hover:from-purple-600 hover:to-blue-600">
                                    Seleccionar archivo
                                </label>
                                <input type="file" id="banner" name="banner" class="hidden" accept="image/*">
                                <p class="text-xs text-gray-400">Formatos: JPG, PNG, GIF. Máx. 5MB</p>
                            </div>
                        </div>
                        <div id="image-preview-container" class="mt-4 hidden">
                            <div class="relative group">
                                <img id="image-preview" src="" alt="Vista previa" class="w-full h-64 object-cover rounded-xl shadow-lg">
                                <button type="button" id="remove-image" class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity shadow-lg hover:bg-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p id="file-name" class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center"></p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Tipo de evento</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="tipo-evento-option">
                                <input type="radio" name="tipo_evento" value="ticket" class="hidden tipo-evento" required>
                                <div class="border-2 border-gray-200 dark:border-gray-600 rounded-xl p-4 text-center transition hover:border-purple-500 hover:shadow-md">
                                    <div class="w-12 h-12 mx-auto mb-2 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">Con ticket</span>
                                </div>
                            </label>
                            <label class="tipo-evento-option">
                                <input type="radio" name="tipo_evento" value="gratis" class="hidden tipo-evento" required>
                                <div class="border-2 border-gray-200 dark:border-gray-600 rounded-xl p-4 text-center transition hover:border-purple-500 hover:shadow-md">
                                    <div class="w-12 h-12 mx-auto mb-2 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">Gratis</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6 hidden" id="precio-container">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Precio del ticket</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">€</span>
                            <input type="number" name="precio" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 pl-8 pr-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="0.00" min="0" step="0.01">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="button" class="next-step bg-gradient-to-r from-purple-500 to-blue-500 text-white font-medium px-8 py-3 rounded-xl transition hover:shadow-lg hover:from-purple-600 hover:to-blue-600">
                    Siguiente: Ubicación
                </button>
            </div>
        </div>

        <!-- Paso 2: Ubicación -->
        <div class="step-content bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl dark:shadow-lg hidden transition-all duration-300" data-step="2">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Ubicación del evento</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Mapa -->
                <div class="h-full">
                    <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Selecciona la ubicación en el mapa</label>
                    <div id="map" class="w-full h-96 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700"></div>
                    <input type="hidden" name="latitud" id="latitud">
                    <input type="hidden" name="longitud" id="longitud">
                </div>

                <!-- Detalles de ubicación -->
                <div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Dirección del evento</label>
                        <input type="text" name="ubicacion" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="Ej: Calle Principal 123, Ciudad">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">¿Requiere asientos?</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="necesita_asientos" value="1" class="requiere-asientos h-5 w-5 text-purple-600 focus:ring-purple-500">
                                <span class="text-gray-800 dark:text-gray-200">Sí</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="necesita_asientos" value="0" class="requiere-asientos h-5 w-5 text-purple-600 focus:ring-purple-500" checked>
                                <span class="text-gray-800 dark:text-gray-200">No</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6 hidden" id="asientos-container">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Cantidad de asientos</label>
                        <input type="number" name="cantidad_asientos" min="1" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="Ej: 100">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Descripción del evento</label>
                        <textarea name="descripcion" rows="5" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="Describe tu evento en detalle..."></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" class="prev-step bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium px-6 py-3 rounded-xl transition hover:bg-gray-300 dark:hover:bg-gray-600">
                    Anterior
                </button>
                <button type="button" class="next-step bg-gradient-to-r from-purple-500 to-blue-500 text-white font-medium px-8 py-3 rounded-xl transition hover:shadow-lg hover:from-purple-600 hover:to-blue-600">
                    Siguiente: Detalles
                </button>
            </div>
        </div>

        <!-- Paso 3: Confirmación -->
        <div class="step-content bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl dark:shadow-lg hidden transition-all duration-300" data-step="3">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Revisa los detalles</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Resumen -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Resumen del evento</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200" id="review-titulo">-</h4>
                            <p class="text-gray-600 dark:text-gray-400" id="review-categoria">-</p>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="text-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">Fecha y hora</p>
                                <p class="text-gray-600 dark:text-gray-400" id="review-fechas">-</p>
                                <p class="text-gray-600 dark:text-gray-400" id="review-horario">-</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="text-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">Ubicación</p>
                                <p class="text-gray-600 dark:text-gray-400" id="review-ubicacion">-</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="text-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">Tipo de evento</p>
                                <p class="text-gray-600 dark:text-gray-400" id="review-tipo">-</p>
                                <p class="text-gray-600 dark:text-gray-400 hidden" id="review-precio">-</p>
                                <p class="text-gray-600 dark:text-gray-400 hidden" id="review-asientos">-</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Vista previa de imagen -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Vista previa</h3>
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-lg">
                        <div id="review-image" class="h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="p-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200" id="review-titulo-preview">Título del evento</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1" id="review-fecha-preview">Fecha</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400" id="review-ubicacion-preview">Ubicación</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Descripción</h3>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-gray-700 dark:text-gray-300" id="review-descripcion">-</p>
                </div>
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" class="prev-step bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium px-6 py-3 rounded-xl transition hover:bg-gray-300 dark:hover:bg-gray-600">
                    Anterior
                </button>
                <button type="submit" class="bg-gradient-to-r from-purple-500 to-blue-500 text-white font-medium px-8 py-3 rounded-xl transition hover:shadow-lg hover:from-purple-600 hover:to-blue-600">
                    Publicar evento
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2ySlqx-Xhh8itm44_l7GnHZeqlKZoxJY&libraries=places"></script>
<script>
            // Inicialización del mapa
        window.initMap = function() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 40.416775, lng: -3.703790 },
                zoom: 12
            });

            let marker = null;

            map.addListener('click', function(e) {
                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    position: e.latLng,
                    map: map,
                    draggable: true
                });

                document.getElementById('latitud').value = e.latLng.lat();
                document.getElementById('longitud').value = e.latLng.lng();

                marker.addListener('dragend', function(e) {
                    document.getElementById('latitud').value = e.latLng.lat();
                    document.getElementById('longitud').value = e.latLng.lng();
                });
            });

            const ubicacionInput = document.querySelector('[name="ubicacion"]');
            const autocomplete = new google.maps.places.Autocomplete(ubicacionInput);
            
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: map,
                    draggable: true
                });

                document.getElementById('latitud').value = place.geometry.location.lat();
                document.getElementById('longitud').value = place.geometry.location.lng();

                map.setCenter(place.geometry.location);
                map.setZoom(15);

                marker.addListener('dragend', function(e) {
                    document.getElementById('latitud').value = e.latLng.lat();
                    document.getElementById('longitud').value = e.latLng.lng();
                });
            });
        };
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        // Navegación por pasos
        const form = document.getElementById('event-form');
        const steps = document.querySelectorAll('.step-content');
        const stepIndicators = document.querySelectorAll('.step-indicator');
        const progressBar = document.getElementById('progress-bar');
        let currentStep = 1;
        
        // Mostrar el primer paso
        showStep(currentStep);
        
        // Botones siguiente
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                    updateProgress();
                }
            });
        });
        
        // Botones anterior
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', function() {
                currentStep--;
                showStep(currentStep);
                updateProgress();
            });
        });
        
        function showStep(step) {
            steps.forEach(s => s.classList.add('hidden'));
            document.querySelector(`.step-content[data-step="${step}"]`).classList.remove('hidden');
            
            stepIndicators.forEach(indicator => {
                indicator.classList.remove('active');
                if (parseInt(indicator.dataset.step) <= step) {
                    indicator.classList.add('active');
                }
            });
            
            // Actualizar vista previa en el paso 3
            if (step === 3) {
                updateReview();
            }
        }
        
        function updateProgress() {
            const progress = (currentStep / steps.length) * 100;
            progressBar.style.width = `${progress}%`;
        }
        
        function validateStep(step) {
            let isValid = true;
            
            if (step === 1) {
                const requiredFields = form.querySelectorAll('[data-step="1"] [required]');
                requiredFields.forEach(field => {
                    if (!field.value) {
                        field.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                
                const tipoEvento = form.querySelector('[name="tipo_evento"]:checked');
                if (!tipoEvento) {
                    alert('Por favor selecciona el tipo de evento');
                    isValid = false;
                }
            }
            
            if (step === 2) {
                const latitud = form.querySelector('[name="latitud"]').value;
                const longitud = form.querySelector('[name="longitud"]').value;
                
                if (!latitud || !longitud) {
                    alert('Por favor selecciona una ubicación en el mapa');
                    isValid = false;
                }
            }
            
            return isValid;
        }
        
        function updateReview() {
            // Información básica
            document.getElementById('review-titulo').textContent = form.querySelector('[name="titulo"]').value;
            document.getElementById('review-titulo-preview').textContent = form.querySelector('[name="titulo"]').value;
            
            const categoriaSelect = form.querySelector('[name="categoria"]');
            const categoriaText = categoriaSelect.options[categoriaSelect.selectedIndex].text;
            document.getElementById('review-categoria').textContent = categoriaText;
            
            // Fechas y horario
            const fechaInicio = new Date(form.querySelector('[name="fecha_inicio"]').value);
            const fechaFin = new Date(form.querySelector('[name="fecha_fin"]').value);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            
            if (fechaInicio.toDateString() === fechaFin.toDateString()) {
                document.getElementById('review-fechas').textContent = fechaInicio.toLocaleDateString('es-ES', options);
            } else {
                document.getElementById('review-fechas').textContent = 
                    `${fechaInicio.toLocaleDateString('es-ES', options)} - ${fechaFin.toLocaleDateString('es-ES', options)}`;
            }
            
            document.getElementById('review-fecha-preview').textContent = fechaInicio.toLocaleDateString('es-ES', options);
            
            const horaInicio = form.querySelector('[name="hora_inicio"]').value;
            const horaFin = form.querySelector('[name="hora_fin"]').value;
            document.getElementById('review-horario').textContent = `${horaInicio} - ${horaFin}`;
            
            // Ubicación
            const ubicacion = form.querySelector('[name="ubicacion"]').value;
            document.getElementById('review-ubicacion').textContent = ubicacion || 'Ubicación no especificada';
            document.getElementById('review-ubicacion-preview').textContent = ubicacion || 'Ubicación no especificada';
            
            // Tipo de evento
            const tipoEvento = form.querySelector('[name="tipo_evento"]:checked').value;
            if (tipoEvento === 'ticket') {
                document.getElementById('review-tipo').textContent = 'Evento con ticket';
                document.getElementById('review-precio').classList.remove('hidden');
                document.getElementById('review-precio').textContent = `Precio: €${parseFloat(form.querySelector('[name="precio"]').value || '0').toFixed(2)}`;
            } else {
                document.getElementById('review-tipo').textContent = 'Evento gratuito';
                document.getElementById('review-precio').classList.add('hidden');
            }
            
            // Asientos
            const necesitaAsientos = form.querySelector('[name="necesita_asientos"]:checked').value === '1';
            if (necesitaAsientos) {
                document.getElementById('review-asientos').classList.remove('hidden');
                document.getElementById('review-asientos').textContent = `Asientos: ${form.querySelector('[name="cantidad_asientos"]').value || '0'}`;
            } else {
                document.getElementById('review-asientos').classList.add('hidden');
            }
            
            // Descripción
            document.getElementById('review-descripcion').textContent = form.querySelector('[name="descripcion"]').value || 'No se ha proporcionado descripción';
            
            // Vista previa de imagen
            const bannerInput = form.querySelector('[name="banner"]');
            if (bannerInput.files && bannerInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('review-image').innerHTML = `<img src="${e.target.result}" alt="Vista previa" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(bannerInput.files[0]);
            }
        }

        // Manejo de tipo de evento (mostrar/ocultar precio)
        document.querySelectorAll('.tipo-evento-option input').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.tipo-evento-option').forEach(option => {
                    option.querySelector('div').classList.remove('border-purple-500', 'bg-purple-50', 'dark:bg-purple-900/20');
                });
                
                if (this.checked) {
                    this.closest('.tipo-evento-option').querySelector('div').classList.add('border-purple-500', 'bg-purple-50', 'dark:bg-purple-900/20');
                    
                    const precioContainer = document.getElementById('precio-container');
                    if (this.value === 'ticket') {
                        precioContainer.classList.remove('hidden');
                    } else {
                        precioContainer.classList.add('hidden');
                    }
                }
            });
        });

        // Manejo de asientos (mostrar/ocultar campo de cantidad)
        document.querySelectorAll('.requiere-asientos').forEach(radio => {
            radio.addEventListener('change', function() {
                const asientosContainer = document.getElementById('asientos-container');
                if (this.value === '1') {
                    asientosContainer.classList.remove('hidden');
                } else {
                    asientosContainer.classList.add('hidden');
                }
            });
        });

        // Manejo de la subida de imágenes
        const dropzone = document.getElementById('dropzone');
        const bannerInput = document.getElementById('banner');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imagePreview = document.getElementById('image-preview');
        const fileName = document.getElementById('file-name');
        const removeImage = document.getElementById('remove-image');

        // Funcionalidad de arrastrar y soltar
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropzone.classList.add('border-purple-500', 'bg-purple-50', 'dark:bg-purple-900/20');
        }

        function unhighlight() {
            dropzone.classList.remove('border-purple-500', 'bg-purple-50', 'dark:bg-purple-900/20');
        }

        dropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            bannerInput.files = files;
            handleFiles(files);
        }

        bannerInput.addEventListener('change', function() {
            if (this.files.length) {
                handleFiles(this.files);
            }
        });

        function handleFiles(files) {
            const file = files[0];
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                    fileName.textContent = file.name;
                };
                reader.readAsDataURL(file);
            } else {
                alert('Por favor selecciona un archivo de imagen válido.');
            }
        }

        removeImage.addEventListener('click', function() {
            bannerInput.value = '';
            imagePreviewContainer.classList.add('hidden');
        });
            });
</script>
@endpush
       