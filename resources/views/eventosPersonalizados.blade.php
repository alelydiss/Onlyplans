@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-gray-950 min-h-screen transition-colors duration-300">

    <!-- Banner -->
    <div class="bg-gradient-to-r from-indigo-400 to-purple-600 dark:from-indigo-800 dark:to-purple-900 py-12 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow-lg">
            Explora un mundo de eventos. ¡Descubre lo que te apasiona!
        </h1>

        <!-- Buscador -->
        <div class="mt-8 flex justify-center">
            <form method="GET" action="{{ route('eventos') }}" class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-xl flex flex-col sm:flex-row gap-4 w-full max-w-5xl">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar evento, ciudad o categoría"
                    class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500" />
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition font-medium shadow">
                    Buscar
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-12 px-4 flex flex-col lg:flex-row gap-8">
        <!-- Filtros -->
        <aside class="w-full lg:w-1/5">
            <form method="GET" action="{{ route('eventos') }}">
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Filtros</h2>

                    <!-- Precio -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 dark:text-gray-300 mb-2">Precio</h3>
                        <ul class="text-sm text-gray-700 dark:text-gray-400 space-y-1">
                            <li>
                                <label>
                                    <input type="checkbox" name="precio[]" value="gratis" {{ in_array('gratis', request('precio', [])) ? 'checked' : '' }} class="mr-2" />
                                    Gratis
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="precio[]" value="pago" {{ in_array('pago', request('precio', [])) ? 'checked' : '' }} class="mr-2" />
                                    De pago
                                </label>
                            </li>
                        </ul>
                    </div>

                    <!-- Fecha -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 dark:text-gray-300 mb-2">Fecha</h3>
                        <ul class="text-sm text-gray-700 dark:text-gray-400 space-y-1">
                            <li>
                                <label>
                                    <input type="checkbox" name="fecha[]" value="hoy" {{ in_array('hoy', request('fecha', [])) ? 'checked' : '' }} class="mr-2" />
                                    Hoy
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="fecha[]" value="semana" {{ in_array('semana', request('fecha', [])) ? 'checked' : '' }} class="mr-2" />
                                    Esta semana
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="fecha[]" value="mes" {{ in_array('mes', request('fecha', [])) ? 'checked' : '' }} class="mr-2" />
                                    Este mes
                                </label>
                            </li>
                        </ul>
                    </div>

                    <!-- Categorías -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-800 dark:text-gray-300 mb-2">Categoría</h3>
                        <ul class="text-sm text-gray-700 dark:text-gray-400 space-y-1">
                            @foreach($categorias as $categoria)
                                <li>
                                    <label>
                                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}" {{ in_array($categoria->id, request('categorias', [])) ? 'checked' : '' }} class="mr-2" />
                                        {{ $categoria->nombre }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <button type="submit" class="mt-4 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg w-full">
                    Aplicar filtros
                </button>
            </form>
        </aside>

        <!-- Lista de eventos -->
        <main class="w-full lg:w-4/5 space-y-6">
            <!-- Ordenar por -->
            <div class="flex justify-end mb-6">
                <form method="GET" action="{{ route('eventos') }}" class="flex gap-2 items-center">
                    <input type="hidden" name="q" value="{{ request('q') }}" />
                    <label class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300 self-center">Ordenar por:</label>
                    <select name="orden" onchange="this.form.submit()"
                        class="px-3 py-2 border border-gray-300 dark:border-gray-700 text-sm text-gray-800 dark:text-white rounded-lg dark:bg-gray-800">
                        <option value="fecha" {{ request('orden') == 'fecha' ? 'selected' : '' }}>Fecha</option>
                        <option value="nombre" {{ request('orden') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                        <option value="precio_asc" {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>Precio ↑</option>
                        <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>Precio ↓</option>
                    </select>
                </form>
            </div>

            <!-- Tarjetas de eventos -->
            @forelse($eventos as $evento)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 flex flex-col sm:flex-row overflow-hidden border border-gray-200 dark:border-gray-800">
                    <!-- Imagen -->
                    <button 
                        id="favorito-btn-{{ $evento->id }}"
                        onclick="toggleFavorito({{ $evento->id }})"
                        data-evento-id="{{ $evento->id }}"
                        class="absolute top-3 right-3 p-2 bg-white dark:bg-gray-800 rounded-full shadow hover:scale-110 transition {{ Auth::user() && Auth::user()->favoritos->contains('evento_id', $evento->id) ? 'text-purple-600' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    </button>
                    <div class="relative w-full sm:w-56 h-56 flex-shrink-0">
                        <img src="{{ asset('storage/' . $evento->banner) }}" alt="{{ $evento->titulo }}"
                            class="w-full h-full object-cover">
                        @if($evento->category)
                            <span class="absolute bottom-2 left-2 bg-indigo-600 text-white px-3 py-1 text-xs font-semibold rounded-full shadow-md z-10 backdrop-blur-sm bg-opacity-90">
                                {{ $evento->category->nombre }}
                            </span>
                        @endif
                    </div>

                    <!-- Detalles -->
                    <div class="p-6 flex flex-col justify-between flex-grow">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $evento->titulo }}</h3>

                            <div class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }}
                                @if($evento->fecha_fin)
                                    - {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d M Y') }}
                                @endif
                            </div>

                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1 flex items-center gap-2">
                                <svg class="w-4 h-4 text-rose-500 dark:text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243"/>
                                </svg>
                                {{ $evento->ubicacion }}
                            </div>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $evento->precio == 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300' }}">
                                {{ $evento->precio == 0 ? 'Gratis' : '€' . number_format($evento->precio, 2) }}
                            </span>
                            <a href="{{ route('evento', $evento->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow">
                                Comprar ticket
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No se encontraron eventos.</p>
            @endforelse

            <!-- Paginación -->
            <div class="mt-10">
                {{ $eventos->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
