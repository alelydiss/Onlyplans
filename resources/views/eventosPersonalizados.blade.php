@extends('layouts.app')

@section('content')
<div class="bg-gray-100 dark:bg-gray-950 min-h-screen transition-colors duration-300">
    <!-- Banner -->
    <div class="bg-indigo-300 dark:bg-indigo-900 py-10 px-4 text-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            Explora un mundo de eventos. ¡Descubre lo que te apasiona!
        </h1>

        <!-- Buscador -->
        <div class="mt-10 flex flex-wrap justify-center">
            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded shadow flex flex-wrap w-full max-w-4xl space-y-4 sm:space-y-0 sm:space-x-4">
                <input type="text" placeholder="Buscar evento, ciudad o categoría"
                    class="flex-1 text-black dark:text-white px-6 py-4 border border-gray-300 dark:border-gray-700 rounded dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500 w-full sm:w-auto" />
                <select
                    class="px-3 py-2 border border-gray-300 dark:border-gray-700 text-black dark:text-white rounded dark:bg-gray-800 w-full sm:w-auto">
                    <option>Ubicación</option>
                    <option>Madrid</option>
                    <option>Barcelona</option>
                </select>
                <button class="bg-purple-600 text-white px-8 py-4 rounded hover:bg-purple-700 transition w-full sm:w-auto">
                    Buscar
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap max-w-7xl mx-auto py-8 px-4">
        <!-- Filtros -->
        <aside class="w-full lg:w-1/5 pr-0 lg:pr-6 mb-6 lg:mb-0">
            <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Filtros</h2>

            <div class="mb-6">
                <h3 class="font-medium text-sm text-gray-800 dark:text-gray-300">Precio</h3>
                <ul class="text-sm space-y-1 mt-2 text-gray-700 dark:text-gray-400">
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> Gratis</li>
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> De pago</li>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="font-medium text-sm text-gray-800 dark:text-gray-300">Fecha</h3>
                <ul class="text-sm space-y-1 mt-2 text-gray-700 dark:text-gray-400">
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> Hoy</li>
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> Esta semana</li>
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> Este mes</li>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="font-medium text-sm text-gray-800 dark:text-gray-300">Categoría</h3>
                <ul class="text-sm space-y-1 mt-2 text-gray-700 dark:text-gray-400">
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> Conciertos</li>
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> Gastronomía</li>
                    <li><input type="checkbox" class="mr-2 dark:bg-gray-800" /> Cultura</li>
                </ul>
            </div>
        </aside>

        <!-- Lista de Eventos -->
        <main class="w-full lg:w-4/5 space-y-6">
            <!-- Ordenar por -->
            <div class="flex flex-wrap justify-end mb-4">
                <label class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">Ordenar por:</label>
                <select
                    class="px-3 py-2 border border-gray-300 dark:border-gray-700 text-sm text-black dark:text-white rounded dark:bg-gray-800 w-full sm:w-auto">
                    <option value="fecha">Fecha</option>
                    <option value="nombre">Nombre</option>
                    <option value="precio_asc">Precio (menor a mayor)</option>
                    <option value="precio_desc">Precio (mayor a menor)</option>
                </select>
            </div>

            <!-- Eventos -->
            @foreach(range(1, 10) as $i)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow flex flex-wrap lg:flex-nowrap overflow-hidden">
                    <img src="{{ asset('img/eventoBusqueda' . $i . '.png') }}" alt="Evento" class="w-full lg:w-40 h-40 lg:h-full object-cover" />
                    <div class="p-4 flex flex-col justify-between w-full">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ $i == 1 ? 'Festival Mundial del Queso Artesanal' : 'Convivencia de Biología Marina' }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $i == 1 ? '4-7 abril | Málaga, España' : '12-14 mayo | Ensenada, México' }}
                            </p>
                        </div>
                        <span
                            class="text-xs px-2 py-1 rounded w-max mt-2
                            {{ $i == 1 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300' }}">
                            {{ $i == 1 ? 'Gratis' : 'Pago' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </main>
    </div>
</div>
@endsection
