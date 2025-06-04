@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <!-- Header con animación -->
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-800 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-700 opacity-20 animate-pulse"></div>
            <div class="relative z-10">
                <h1 class="text-2xl font-bold text-white transform transition hover:scale-105 inline-block">Editar Evento: {{ $evento->titulo }}</h1>
                <p class="text-blue-100 mt-1">Actualiza los detalles del evento</p>
            </div>
        </div>

        <!-- Success Message with animation -->
        @if(session('success'))
        <div class="mx-6 mt-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded animate-fade-in-up">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <form action="{{ route('admin.eventos.update', $evento) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            @method('PUT')

            <div class="px-6 py-6 space-y-6">
                <!-- Título y Categoría -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Título con efecto de foco mejorado -->
                    <div class="relative">
                        <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título del Evento</label>
                        <div class="relative">
                            <input
                                type="text"
                                name="titulo"
                                id="titulo"
                                value="{{ old('titulo', $evento->titulo) }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition duration-200"
                                required
                                placeholder="Nombre del evento"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('titulo')
                        <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoría con select personalizado -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                        <div class="relative">
                            <select 
                                name="category_id" 
                                id="category_id" 
                                class="appearance-none w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition duration-200"
                                required
                            >
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ old('category_id', $evento->category_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('category_id')
                        <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Fechas con datepicker mejorado -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Fecha Inicio -->
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha y hora de inicio</label>
                        <div class="relative">
                            <input
                                type="datetime-local"
                                name="fecha_inicio"
                                id="fecha_inicio"
                                value="{{ old('fecha_inicio', \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d\TH:i')) }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition duration-200"
                                required
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('fecha_inicio')
                        <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha Fin -->
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha y hora de finalización</label>
                        <div class="relative">
                            <input
                                type="datetime-local"
                                name="fecha_fin"
                                id="fecha_fin"
                                value="{{ old('fecha_fin', \Carbon\Carbon::parse($evento->fecha_fin)->format('Y-m-d\TH:i')) }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition duration-200"
                                required
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('fecha_fin')
                        <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Precio y Ubicación -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Precio con animación -->
                    <div>
                        <label for="precio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio (USD)</label>
                        <div class="relative rounded-lg shadow-sm transition duration-200 hover:shadow-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input
                                type="number"
                                name="precio"
                                id="precio"
                                value="{{ old('precio', $evento->precio) }}"
                                step="0.01"
                                min="0"
                                class="block w-full pl-7 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition duration-200"
                                placeholder="0.00"
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">USD</span>
                            </div>
                        </div>
                        @error('precio')
                        <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ubicación con autocompletado -->
                    <div>
                        <label for="ubicacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ubicación</label>
                        <div class="relative">
                            <input
                                type="text"
                                name="ubicacion"
                                id="ubicacion"
                                value="{{ old('ubicacion', $evento->ubicacion) }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition duration-200"
                                placeholder="Dirección o lugar del evento"
                                autocomplete="off"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('ubicacion')
                        <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Descripción con contador de caracteres -->
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción del Evento</label>
                    <div class="relative">
                        <textarea
                            name="descripcion"
                            id="descripcion"
                            rows="5"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition duration-200"
                            placeholder="Detalles importantes sobre el evento..."
                            oninput="updateCharCount(this)"
                        >{{ old('descripcion', $evento->descripcion) }}</textarea>
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 px-2 rounded">
                            <span id="charCount">{{ strlen(old('descripcion', $evento->descripcion)) }}</span>/1000
                        </div>
                    </div>
                    @error('descripcion')
                    <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload de imagen con vista previa drag & drop -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Imagen del Evento</label>
                    
                    <div x-data="{ isUploading: false, progress: 0, fileName: '', imagePreview: '{{ $evento->banner ? asset('storage/' . $evento->banner) : '' }}' }" 
                         x-on:live-upload-start="isUploading = true" 
                         x-on:live-upload-finish="isUploading = false" 
                         x-on:live-upload-error="isUploading = false" 
                         x-on:live-upload-progress="progress = $event.detail.progress">
                        
                        <!-- Dropzone -->
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl transition duration-200 hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-gray-700"
                             @dragover.prevent="$event.stopPropagation(); $refs.dropzone.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-gray-700')"
                             @dragleave.prevent="$event.stopPropagation(); $refs.dropzone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-gray-700')"
                             @drop.prevent="
                                 $event.stopPropagation();
                                 $refs.dropzone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-gray-700');
                                 const file = $event.dataTransfer.files[0];
                                 if (file && file.type.match('image.*')) {
                                     $refs.fileInput.files = $event.dataTransfer.files;
                                     fileName = file.name;
                                     const reader = new FileReader();
                                     reader.onload = (e) => { imagePreview = e.target.result };
                                     reader.readAsDataURL(file);
                                 }
                             "
                             x-ref="dropzone">
                            <div class="space-y-1 text-center">
                                <!-- Vista previa de la imagen -->
                                <template x-if="imagePreview">
                                    <div class="relative group">
                                        <img :src="imagePreview" alt="Vista previa" class="mx-auto h-40 w-full object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                                            <span class="text-white font-medium">Cambiar imagen</span>
                                        </div>
                                    </div>
                                </template>
                                
                                <template x-if="!imagePreview">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </template>
                                
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="banner" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 transition duration-200">
                                        <span x-text="imagePreview ? 'Cambiar archivo' : 'Subir una imagen'"></span>
                                        <input id="banner" name="banner" type="file" class="sr-only" 
                                               @change="
                                                   fileName = $event.target.files[0].name;
                                                   const reader = new FileReader();
                                                   reader.onload = (e) => { imagePreview = e.target.result };
                                                   reader.readAsDataURL($event.target.files[0]);
                                               "
                                               x-ref="fileInput"
                                               accept="image/*">
                                    </label>
                                    <p class="pl-1" x-text="!imagePreview ? 'o arrastra y suelta' : ''"></p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400" x-show="fileName" x-text="fileName"></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400" x-show="!fileName">
                                    PNG, JPG, GIF hasta 5MB
                                </p>
                                
                                <!-- Barra de progreso -->
                                <div x-show="isUploading" class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2.5 mt-2">
                                    <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${progress}%`"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Imagen actual (si existe) -->
                        @if($evento->banner)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Imagen actual:</p>
                            <div class="relative group inline-block">
                                <img 
                                    src="{{ asset('storage/' . $evento->banner) }}" 
                                    alt="Banner actual del evento" 
                                    class="max-w-xs rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition duration-200 group-hover:opacity-75"
                                >
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                                    <span class="text-white bg-black bg-opacity-50 px-2 py-1 rounded text-sm">Imagen actual</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @error('banner')
                    <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado de Revisión con toggle -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado de Revisión</label>
                    <div x-data="{ revisado: {{ old('revisado', $evento->revisado) ? 'true' : 'false' }} }" class="mt-1">
                        <input type="hidden" name="revisado" x-model="revisado ? '1' : '0'">
                        <button 
                            type="button"
                            @click="revisado = !revisado"
                            :class="revisado ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'"
                            class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            role="switch"
                        >
                            <span 
                                :class="revisado ? 'translate-x-5' : 'translate-x-0'"
                                class="pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
                            >
                                <span 
                                    :class="revisado ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
                                    class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity"
                                >
                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                        <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span 
                                    :class="revisado ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
                                    class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity"
                                >
                                    <svg class="h-3 w-3 text-blue-600" fill="currentColor" viewBox="0 0 12 12">
                                        <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                    </svg>
                                </span>
                            </span>
                        </button>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300" x-text="revisado ? 'Revisado y aprobado' : 'Pendiente de revisión'"></span>
                    </div>
                    @error('revisado')
                    <p class="mt-1 text-sm text-red-600 animate-fade-in">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Footer del Formulario con animaciones -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex justify-between border-t border-gray-200 dark:border-gray-600">
                <a 
                    href="{{ route('admin.eventos') }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:-translate-x-1"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-105"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 animate-spin hidden" id="submitSpinner" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" id="submitIcon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateCharCount(textarea) {
        const charCount = document.getElementById('charCount');
        charCount.textContent = textarea.value.length;
        
        if (textarea.value.length > 1000) {
            charCount.classList.add('text-red-600');
            charCount.classList.remove('text-gray-500');
        } else {
            charCount.classList.remove('text-red-600');
            charCount.classList.add('text-gray-500');
        }
    }
    
    // Mostrar spinner al enviar el formulario
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('submitSpinner').classList.remove('hidden');
        document.getElementById('submitIcon').classList.add('hidden');
    });
</script>
@endsection
