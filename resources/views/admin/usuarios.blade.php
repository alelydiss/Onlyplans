@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">

        <!-- Animated Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="relative">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-white relative z-10">Gestión de Usuarios</h1>
                <div class="absolute -bottom-1 left-0 w-24 h-2 bg-indigo-200 dark:bg-indigo-800 rounded-full z-0 animate-pulse"></div>
            </div>
            <div class="text-sm px-3 py-1.5 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 flex items-center">
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                {{ $usuarios->count() }} {{ $usuarios->count() === 1 ? 'usuario' : 'usuarios' }}
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

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-gradient-to-r from-rose-50 to-pink-50 dark:from-rose-900/20 dark:to-pink-900/20 border border-rose-100 dark:border-rose-800/50 text-rose-700 dark:text-rose-300 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-rose-500 dark:text-rose-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button class="text-rose-500 hover:text-rose-600 dark:hover:text-rose-400" onclick="this.parentElement.parentElement.parentElement.remove()">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Botón Nuevo Usuario -->
<div class="flex justify-end mb-6">
    <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Nuevo Usuario
    </button>
</div>

<!-- Modal Crear Usuario -->
<div id="createModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4 transition-opacity duration-300 opacity-0 flex">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 scale-95 flex flex-col">
        <div class="p-6 sm:p-8 flex-1 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Nuevo Usuario</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información Básica -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-white border-b pb-2 border-gray-200 dark:border-gray-700">Información Básica</h3>

                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white">Nombre*</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                            @error('name')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-white">Apellido</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                   class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                            @error('last_name')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white">Email*</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                            @error('email')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Contraseña*</label>
                            <input type="password" name="password" id="password" required
                                   class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                            @error('password')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-white border-b pb-2 border-gray-200 dark:border-gray-700">Información Adicional</h3>

                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-white">Teléfono</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                   class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                            @error('phone')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-white">Dirección</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                   class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                            @error('address')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-white">Ciudad</label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}"
                                       class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                                @error('city')
                                    <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-white">País</label>
                                <input type="text" name="country" id="country" value="{{ old('country') }}"
                                       class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                                @error('country')
                                    <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-white">Rol*</label>
                            <select name="role" id="role" required
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 placeholder-gray-400 dark:placeholder-white text-gray-900 dark:text-white">
                                <option value="">Seleccione un rol</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuario</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-white">Avatar</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200" id="dropzone">
                                <div class="space-y-1 text-center" id="upload-container">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="avatar" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Subir archivo</span>
                                            <input id="avatar" name="avatar" type="file" class="sr-only" accept="image/*">
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
                            @error('avatar')
                                <p class="mt-1 text-sm text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


    

        <!-- Floating Users List -->
        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-xl border border-white/30 dark:border-gray-700/50 overflow-hidden hover:shadow-2xl transition-shadow duration-500">
            <div class="p-6 sm:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Lista de Usuarios</h2>
                    </div>
                    <div class="relative">
                        <input type="text" id="search-input" placeholder="Buscar usuario..." class="pl-10 pr-4 py-2 text-sm bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-white">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                @if($usuarios->isEmpty())
                    <div class="text-center py-12">
                        <div class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No hay usuarios registrados</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Comienza agregando tu primer usuario.</p>
                        <div class="mt-6">
                            <a href="#create-user" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Nuevo Usuario
                            </a>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Usuario</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Información</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Rol</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body" class="bg-white/30 dark:bg-gray-800/30 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($usuarios as $usuario)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition duration-150 user-row" data-name="{{ strtolower($usuario->name.' '.$usuario->last_name) }}" data-email="{{ strtolower($usuario->email) }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if($usuario->avatar)
                                                        <img class="h-10 w-10 rounded-full object-cover shadow-sm group-hover:shadow-md transition-shadow duration-200" src="{{ asset('storage/'.$usuario->avatar) }}" alt="{{ $usuario->name }}">
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                                            <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $usuario->name }} {{ $usuario->last_name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $usuario->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                @if($usuario->phone)
                                                    <div class="flex items-center">
                                                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                        </svg>
                                                        {{ $usuario->phone }}
                                                    </div>
                                                @endif
                                                @if($usuario->city || $usuario->country)
                                                    <div class="flex items-center mt-1">
                                                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                        {{ $usuario->city }}{{ $usuario->city && $usuario->country ? ', ' : '' }}{{ $usuario->country }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $usuario->role === 'admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' }}">
                                                {{ $usuario->role === 'admin' ? 'Administrador' : 'Usuario' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-3">
                                                <button 
                                                    onclick="openEditModal({{ $usuario->id }}, '{{ addslashes($usuario->name) }}', '{{ addslashes($usuario->last_name) }}', '{{ addslashes($usuario->email) }}', '{{ addslashes($usuario->phone) }}', '{{ addslashes($usuario->address) }}', '{{ addslashes($usuario->city) }}', '{{ addslashes($usuario->country) }}', '{{ $usuario->role }}', '{{ $usuario->avatar ? asset('storage/'.$usuario->avatar) : '' }}')"
                                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center"
                                                    @if($usuario->role === 'admin') disabled title="No puedes editar a un administrador" @endif
                                                >
                                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Editar
                                                </button>
                                                @if($usuario->role !== 'admin')
                                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 flex items-center">
                                                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                                @endif
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
        <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4 transition-opacity duration-300 opacity-0 flex">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 flex flex-col">
                <div class="p-6 sm:p-8 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">Editar Usuario</h3>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6 flex-1 flex flex-col justify-between">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="edit_id">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-white">Nombre*</label>
                                <input type="text" name="name" id="edit_name" required
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="edit_last_name" class="block text-sm font-medium text-gray-700 dark:text-white">Apellido</label>
                                <input type="text" name="last_name" id="edit_last_name"
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="edit_email" class="block text-sm font-medium text-gray-700 dark:text-white">Email*</label>
                                <input type="email" name="email" id="edit_email" required
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="edit_phone" class="block text-sm font-medium text-gray-700 dark:text-white">Teléfono</label>
                                <input type="text" name="phone" id="edit_phone"
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="edit_address" class="block text-sm font-medium text-gray-700 dark:text-white">Dirección</label>
                                <input type="text" name="address" id="edit_address"
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="edit_city" class="block text-sm font-medium text-gray-700 dark:text-white">Ciudad</label>
                                <input type="text" name="city" id="edit_city"
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="edit_country" class="block text-sm font-medium text-gray-700 dark:text-white">País</label>
                                <input type="text" name="country" id="edit_country"
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="edit_role" class="block text-sm font-medium text-gray-700 dark:text-white">Rol*</label>
                                <select name="role" id="edit_role" required
                                        class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white">
                                    <option value="user">Usuario</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            
                            <div class="space-y-2 md:col-span-2">
                                <label for="edit_password" class="block text-sm font-medium text-gray-700 dark:text-white">Contraseña</label>
                                <input type="password" name="password" id="edit_password" placeholder="Dejar en blanco para no cambiar"
                                    class="block w-full px-4 py-3 bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-300">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-white">Avatar</label>
                            <div id="currentPhoto" class="mb-3 flex flex-col items-center">
                                <img src="" alt="Foto actual" class="w-24 h-24 rounded-full object-cover shadow hidden" id="current-photo-img"/>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Imagen actual</p>
                            </div>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200" id="edit-dropzone">
                                <div class="space-y-1 text-center" id="edit-upload-container">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="edit_avatar" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Subir archivo</span>
                                            <input id="edit_avatar" name="avatar" type="file" class="sr-only" accept="image/*">
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

                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6">
                            <button type="button" onclick="closeEditModal()" class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                Cancelar
                            </button>
                            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
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
    // Modal functions for create user
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

    // Image preview for create form
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('image-preview').src = event.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-container').classList.add('hidden');
                document.getElementById('file-name').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('remove-image').addEventListener('click', function() {
        document.getElementById('avatar').value = '';
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('upload-container').classList.remove('hidden');
        document.getElementById('file-name').textContent = '';
    });

    // Image preview for edit form
    document.getElementById('edit_avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('edit-image-preview').src = event.target.result;
                document.getElementById('edit-preview-container').classList.remove('hidden');
                document.getElementById('edit-upload-container').classList.add('hidden');
                document.getElementById('edit-file-name').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('edit-remove-image').addEventListener('click', function() {
        document.getElementById('edit_avatar').value = '';
        document.getElementById('edit-preview-container').classList.add('hidden');
        document.getElementById('edit-upload-container').classList.remove('hidden');
        document.getElementById('edit-file-name').textContent = '';
    });

    // Search functionality
    document.getElementById('search-input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.user-row');
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
    });

    // Modal functions with animations
    function openEditModal(id, name, lastName, email, phone, address, city, country, role, avatarUrl) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const currentPhotoImg = document.getElementById('current-photo-img');
        const editPreviewContainer = document.getElementById('edit-preview-container');
        const editUploadContainer = document.getElementById('edit-upload-container');

        form.action = `/admin/usuarios/${id}`;
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name || '';
        document.getElementById('edit_last_name').value = lastName || '';
        document.getElementById('edit_email').value = email || '';
        document.getElementById('edit_phone').value = phone || '';
        document.getElementById('edit_address').value = address || '';
        document.getElementById('edit_city').value = city || '';
        document.getElementById('edit_country').value = country || '';
        document.getElementById('edit_role').value = role || 'user';
        document.getElementById('edit_password').value = '';

        if (avatarUrl) {
            currentPhotoImg.src = avatarUrl;
            currentPhotoImg.classList.remove('hidden');
        } else {
            currentPhotoImg.classList.add('hidden');
        }

        // Reset edit image preview
        document.getElementById('edit_avatar').value = '';
        editPreviewContainer.classList.add('hidden');
        editUploadContainer.classList.remove('hidden');

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        // Trigger animations
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        
        // Trigger animations
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        modal.querySelector('div').classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    // Drag and drop for file upload (create form)
    const dropArea = document.getElementById('dropzone');
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dropArea.classList.add('border-indigo-400', 'dark:border-indigo-500');
    }

    function unhighlight() {
        dropArea.classList.remove('border-indigo-400', 'dark:border-indigo-500');
    }

    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const input = document.getElementById('avatar');
        
        if (files.length > 0 && files[0].type.match('image.*')) {
            input.files = files;
            
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('image-preview').src = event.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-container').classList.add('hidden');
                document.getElementById('file-name').textContent = files[0].name;
            };
            reader.readAsDataURL(files[0]);
        }
    }

    // Drag and drop for file upload (edit form)
    const editDropArea = document.getElementById('edit-dropzone');
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        editDropArea.addEventListener(eventName, preventDefaults, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        editDropArea.addEventListener(eventName, highlightEdit, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        editDropArea.addEventListener(eventName, unhighlightEdit, false);
    });

    function highlightEdit() {
        editDropArea.classList.add('border-indigo-400', 'dark:border-indigo-500');
    }

    function unhighlightEdit() {
        editDropArea.classList.remove('border-indigo-400', 'dark:border-indigo-500');
    }

    editDropArea.addEventListener('drop', handleEditDrop, false);

    function handleEditDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const input = document.getElementById('edit_avatar');
        
        if (files.length > 0 && files[0].type.match('image.*')) {
            input.files = files;
            
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('edit-image-preview').src = event.target.result;
                document.getElementById('edit-preview-container').classList.remove('hidden');
                document.getElementById('edit-upload-container').classList.add('hidden');
                document.getElementById('edit-file-name').textContent = files[0].name;
            };
            reader.readAsDataURL(files[0]);
        }
    }
</script>
@endsection