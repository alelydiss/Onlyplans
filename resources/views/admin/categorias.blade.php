@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">

        <!-- Animated Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="relative">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-white relative z-10">Gestión de Categorías</h1>
                <div class="absolute -bottom-1 left-0 w-24 h-2 bg-indigo-200 dark:bg-indigo-800 rounded-full z-0 animate-pulse"></div>
            </div>
            <div class="text-sm px-3 py-1.5 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 flex items-center">
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                {{ $categorias->count() }} {{ $categorias->count() === 1 ? 'categoría' : 'categorías' }}
            </div>
        </div>

        <!-- Floating Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-100 dark:border-green-800/50 text-green-700 dark:text-green-300 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500 dark:text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button class="text-green-500 hover:text-green-600 dark:hover:text-green-400" onclick="this.parentElement.parentElement.parentElement.remove()">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Botón Nueva Categoría -->
<div class="flex justify-end mb-6">
    <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Nueva Categoría
    </button>
</div>

<!-- Modal Crear Categoría -->
<div id="createModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4 transition-opacity duration-300 opacity-0">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Nueva Categoría</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de la categoría</label>
                    <div class="relative">
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                               class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-gray-500">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                    @error('nombre')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagen de categoría</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200" id="dropzone">
                        <div class="space-y-1 text-center" id="upload-container">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="foto" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Subir archivo</span>
                                    <input id="foto" name="foto" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">o arrastrar y soltar</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF hasta 5MB</p>
                        </div>
                        <div id="preview-container" class="hidden w-full">
                            <div class="relative">
                                <img id="image-preview" class="max-h-48 mx-auto rounded-lg shadow-sm" src="" alt="Vista previa de la imagen">
                                <button type="button" id="remove-image" class="absolute top-2 right-2 bg-gray-800/50 text-white rounded-full p-1 hover:bg-gray-700/70 transition">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <p id="file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center"></p>
                        </div>
                    </div>
                    @error('foto')
                        <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


        <!-- Floating Categories List -->
        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-xl border border-white/30 dark:border-gray-700/50 overflow-hidden hover:shadow-2xl transition-shadow duration-500">
            <div class="p-6 sm:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Tus Categorías</h2>
                    </div>
                    <div class="relative">
                        <input type="text" id="search-input" placeholder="Buscar categoría..." class="pl-10 pr-4 py-2 text-sm bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                @if($categorias->isEmpty())
                    <div class="text-center py-12">
                        <div class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No hay categorías creadas</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Comienza agregando tu primera categoría.</p>
                        <div class="mt-6">
                            <a href="#create-category" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Nueva Categoría
                            </a>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Categoría</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nombre</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="categories-table-body" class="bg-white/30 dark:bg-gray-800/30 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($categorias as $categoria)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition duration-150 group category-row" data-name="{{ strtolower($categoria->nombre) }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($categoria->foto)
                                                    <img class="h-10 w-10 rounded-lg object-cover shadow-sm group-hover:shadow-md transition-shadow duration-200" src="{{ asset($categoria->foto) }}" alt="{{ $categoria->nombre }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                                        <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $categoria->nombre }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-3">
                                                <button 
                                                    onclick="openEditModal({{ $categoria->id }}, '{{ addslashes($categoria->nombre) }}', '{{ $categoria->foto ? asset($categoria->foto) : '' }}')"
                                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center"
                                                >
                                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Editar
                                                </button>
                                                <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 flex items-center">
                                                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Floating Edit Modal -->
        <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4 transition-opacity duration-300 opacity-0">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">Editar Categoría</h3>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-2">
                            <label for="edit_nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de la categoría</label>
                            <input type="text" name="nombre" id="edit_nombre" required
                                class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagen de categoría</label>
                            <div id="currentPhoto" class="mb-3 flex flex-col items-center">
                                <img src="" alt="Foto actual" class="w-32 h-32 object-cover rounded-lg shadow hidden" id="current-photo-img"/>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200" id="edit-dropzone">
                                <div class="space-y-1 text-center" id="edit-upload-container">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="edit_foto" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Subir archivo</span>
                                            <input id="edit_foto" name="foto" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">o arrastrar y soltar</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF hasta 5MB</p>
                                </div>
                                <div id="edit-preview-container" class="hidden w-full">
                                    <div class="relative">
                                        <img id="edit-image-preview" class="max-h-48 mx-auto rounded-lg shadow-sm" src="" alt="Vista previa de la nueva imagen">
                                        <button type="button" id="edit-remove-image" class="absolute top-2 right-2 bg-gray-800/50 text-white rounded-full p-1 hover:bg-gray-700/70 transition">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <p id="edit-file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center"></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                Cancelar
                            </button>
                            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Utilidad para previsualizar imagen
    function previewImage(inputId, previewId, containerId, uploadId, fileNameId) {
        const input = document.getElementById(inputId);
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById(previewId).src = event.target.result;
                    document.getElementById(containerId).classList.remove('hidden');
                    document.getElementById(uploadId).classList.add('hidden');
                    document.getElementById(fileNameId).textContent = file.name;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Utilidad para remover imagen previsualizada
    function removeImage(inputId, containerId, uploadId, fileNameId) {
        document.getElementById(inputId).value = '';
        document.getElementById(containerId).classList.add('hidden');
        document.getElementById(uploadId).classList.remove('hidden');
        document.getElementById(fileNameId).textContent = '';
    }

    // Inicializar previsualización y remover para crear
    previewImage('foto', 'image-preview', 'preview-container', 'upload-container', 'file-name');
    document.getElementById('remove-image').addEventListener('click', function() {
        removeImage('foto', 'preview-container', 'upload-container', 'file-name');
    });

    // Inicializar previsualización y remover para editar
    previewImage('edit_foto', 'edit-image-preview', 'edit-preview-container', 'edit-upload-container', 'edit-file-name');
    document.getElementById('edit-remove-image').addEventListener('click', function() {
        removeImage('edit_foto', 'edit-preview-container', 'edit-upload-container', 'edit-file-name');
    });

    // Drag & drop genérico
    function setupDropzone(dropId, inputId, previewId, containerId, uploadId, fileNameId) {
        const dropArea = document.getElementById(dropId);
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, e => { e.preventDefault(); e.stopPropagation(); }, false);
        });
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.add('border-indigo-400', 'dark:border-indigo-500');
            }, false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.remove('border-indigo-400', 'dark:border-indigo-500');
            }, false);
        });
        dropArea.addEventListener('drop', function(e) {
            const files = e.dataTransfer.files;
            const input = document.getElementById(inputId);
            if (files.length > 0 && files[0].type.match('image.*')) {
                input.files = files;
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById(previewId).src = event.target.result;
                    document.getElementById(containerId).classList.remove('hidden');
                    document.getElementById(uploadId).classList.add('hidden');
                    document.getElementById(fileNameId).textContent = files[0].name;
                };
                reader.readAsDataURL(files[0]);
            }
        }, false);
    }

    // Inicializar drag & drop para ambos formularios
    setupDropzone('dropzone', 'foto', 'image-preview', 'preview-container', 'upload-container', 'file-name');
    setupDropzone('edit-dropzone', 'edit_foto', 'edit-image-preview', 'edit-preview-container', 'edit-upload-container', 'edit-file-name');

    // Buscador
    document.getElementById('search-input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.category-row').forEach(row => {
            row.classList.toggle('hidden', !row.getAttribute('data-name').includes(searchTerm));
        });
    });

    // Modal Crear
    function openCreateModal() {
        const modal = document.getElementById('createModal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }
    function closeCreateModal() {
        const modal = document.getElementById('createModal');
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        modal.querySelector('div').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    // Modal Editar
    function openEditModal(id, nombre, fotoUrl) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const nombreInput = document.getElementById('edit_nombre');
        const currentPhotoImg = document.getElementById('current-photo-img');
        form.action = `/admin/categorias/${id}`;
        nombreInput.value = nombre;
        if (fotoUrl) {
            currentPhotoImg.src = fotoUrl;
            currentPhotoImg.classList.remove('hidden');
        } else {
            currentPhotoImg.classList.add('hidden');
        }
        removeImage('edit_foto', 'edit-preview-container', 'edit-upload-container', 'edit-file-name');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        modal.querySelector('div').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }
</script>
@endsection