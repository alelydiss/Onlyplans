@extends('layouts.app')

@section('content')
    <!-- Banner -->
    <div class="bg-indigo-200 py-10 px-4 text-center">
        <h1 class="text-2xl font-bold text-white">
            Explora un mundo de eventos. ¡Descubre lo que te apasiona!
        </h1>

        <!-- Buscador -->
        <div class="mt-10 flex justify-center">
            <div class="bg-white dark:bg-gray-700 p-6 rounded shadow flex w-full max-w-4xl space-x-4">
                <input type="text" placeholder="Buscar evento, ciudad o categoría"
                    class="flex-1 text-black px-6 py-4 border rounded dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 transition" />
                <select
                    class="px-3 py-2 border text-black rounded dark:bg-gray-700 dark:text-white focus:outline-none transition">
                    <option>Ubicación</option>
                    <option>Madrid</option>
                    <option>Barcelona</option>
                </select>
                <button class="bg-purple-600 text-white px-8 py-4 rounded hover:bg-purple-700 transition">
                    Buscar
                </button>
            </div>
        </div>
    </div>

    <div class="flex max-w-7xl mx-auto py-8 px-4">
        <!-- Filtros -->
        <aside class="w-1/5 pr-6">
            <h2 class="text-lg font-semibold mb-2">Filtros</h2>

            <div class="mb-4">
                <h3 class="font-medium text-sm">Precio</h3>
                <ul class="text-sm space-y-1 mt-1">
                    <li><input type="checkbox" /> Gratis</li>
                    <li><input type="checkbox" /> De pago</li>
                </ul>
            </div>

            <div class="mb-4">
                <h3 class="font-medium text-sm">Fecha</h3>
                <ul class="text-sm space-y-1 mt-1">
                    <li><input type="checkbox" /> Hoy</li>
                    <li><input type="checkbox" /> Esta semana</li>
                    <li><input type="checkbox" /> Este mes</li>
                </ul>
            </div>

            <div class="mb-4">
                <h3 class="font-medium text-sm">Categoría</h3>
                <ul class="text-sm space-y-1 mt-1">
                    <li><input type="checkbox" /> Conciertos</li>
                    <li><input type="checkbox" /> Gastronomía</li>
                    <li><input type="checkbox" /> Cultura</li>
                </ul>
            </div>
        </aside>

<!-- Lista de Eventos -->
<main class="w-4/5 space-y-6">
    <!-- Ordenar por -->
    <div class="flex justify-end mb-4">
        <label class="mr-2 text-sm font-medium text-gray-700">Ordenar por:</label>
        <select
            class="px-3 py-2 border text-sm text-black rounded dark:bg-gray-700 dark:text-white focus:outline-none transition">
            <option value="fecha">Fecha</option>
            <option value="nombre">Nombre</option>
            <option value="precio_asc">Precio (menor a mayor)</option>
            <option value="precio_desc">Precio (mayor a menor)</option>
        </select>
    </div>

    <!-- Eventos -->
    @foreach(range(1, 10) as $i)
        <div class="bg-white rounded-lg shadow flex overflow-hidden">
            <img src="{{ asset('img/eventoBusqueda' . $i . '.png') }}" alt="Evento" class="w-40 h-full object-cover" />
            <div class="p-4 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold">
                        {{ $i == 1 ? 'Festival Mundial del Queso Artesanal' : 'Convivencia de Biología Marina' }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        {{ $i == 1 ? '4-7 abril | Málaga, España' : '12-14 mayo | Ensenada, México' }}
                    </p>
                </div>
                <span
                    class="text-xs px-2 py-1 rounded w-max mt-2
                    {{ $i == 1 ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                    {{ $i == 1 ? 'Gratis' : 'Pago' }}
                </span>
            </div>
        </div>
    @endforeach
</main>
    </div>
@endsection
