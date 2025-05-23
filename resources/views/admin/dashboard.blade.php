@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header con breadcrumbs -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Panel de Control</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Resumen completo de tu plataforma de eventos</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center transition-all">
                    <i class="fas fa-plus mr-2"></i> Crear Evento
                </button>
                <button class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-700 dark:text-white px-4 py-2 rounded-lg flex items-center transition-all">
                    <i class="fas fa-sliders-h mr-2"></i> Configuración
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Usuarios -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-indigo-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Usuarios Totales</p>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($totalUsuarios) }}</h3>

                    </div>
                    <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300">
                        <i class="fas fa-users text-lg"></i>
                    </div>
                </div>
                <p class="text-xs text-green-500 mt-2 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 12.5% desde ayer
                </p>
            </div>

            <!-- Eventos -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Eventos Activos</p>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $eventosTotales }}</h3>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                        <i class="fas fa-calendar-alt text-lg"></i>
                    </div>
                </div>
                <p class="text-xs text-green-500 mt-2 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 3 nuevos hoy
                </p>
            </div>

            <!-- Tickets -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tickets Vendidos</p>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $ticketsVendidos }}</h3>
                    </div>
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                        <i class="fas fa-ticket-alt text-lg"></i>
                    </div>
                </div>
                <p class="text-xs text-green-500 mt-2 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 124 hoy
                </p>
            </div>

            <!-- Ingresos -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-purple-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ingresos Totales</p>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($ingresosTotales, 2) }}€</h3>
                    </div>
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300">
                        <i class="fas fa-dollar-sign text-lg"></i>
                    </div>
                </div>
                <p class="text-xs text-green-500 mt-2 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 8.2% este mes
                </p>
            </div>
        </div>

        <!-- Gráfico y Estadísticas -->
        <!-- Gráfico y Estadísticas -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Gráfico de ventas -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Ventas de Tickets (últimos 7 días)</h2>
                    <select class="bg-gray-100 dark:bg-gray-700 border-none text-sm rounded-lg px-3 py-1">
                        <option>Últimos 7 días</option>
                        <option>Últimos 30 días</option>
                        <option>Este año</option>
                    </select>
                </div>
                <!-- Gráfico con Chart.js -->
                <canvas id="salesChart" class="w-full h-72"></canvas>
            </div>


            <!-- Estadísticas de categorías -->
<div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Categorías Populares</h2>
        <button onclick="openCategoryModal()" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium flex items-center">
            <i class="fas fa-edit mr-1"></i> Gestionar
        </button>
    </div>
    <div class="space-y-4">
        @foreach ($categoriasPopulares as $categoria)
            @php
                $porcentaje = $totalEventos > 0 ? round(($categoria->total_eventos / $totalEventos) * 100) : 0;
                $color = match(true) {
                    $loop->index == 0 => 'bg-indigo-600',
                    $loop->index == 1 => 'bg-blue-500',
                    $loop->index == 2 => 'bg-green-500',
                    $loop->index == 3 => 'bg-purple-500',
                    default => 'bg-yellow-500',
                };
            @endphp
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $categoria->nombre }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $porcentaje }}%</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div class="{{ $color }} h-2 rounded-full" style="width: {{ $porcentaje }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="w-full mt-6 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium flex items-center justify-center">
        Ver todas las categorías <i class="fas fa-chevron-right ml-2"></i>
    </button>
</div>

        </div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Eventos próximos -->
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Eventos Próximos</h2>
            <a href="{{ route('admin.eventos') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium">
                Ver todos
            </a>
        </div>
        <div class="space-y-4">
            @forelse ($eventosProximos as $evento)
                @php
                    $fecha = \Carbon\Carbon::parse($evento->fecha_inicio);
                @endphp
                <div class="flex items-start p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                    <div class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 p-2 rounded-lg mr-4 min-w-[60px]">
                        <div class="text-center">
                            <div class="font-bold text-lg">{{ $fecha->format('d') }}</div>
                            <div class="text-xs uppercase">{{ $fecha->format('M') }}</div>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-medium text-gray-800 dark:text-white">{{ $evento->titulo }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ number_format($evento->ticketsVendidos) }} tickets vendidos</p>
                        <div class="flex items-center mt-2 text-xs">
                            <span class="bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 px-2 py-1 rounded mr-2">
                                {{ $evento->category->nombre ?? 'Sin categoría' }}
                            </span>
                            <span class="text-gray-500 dark:text-gray-400">
                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $evento->ubicacion }}
                            </span>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">No hay eventos próximos.</p>
            @endforelse
        </div>
    </div>



<!-- Eventos pendientes de revisión -->
<div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Eventos por Revisar</h2>
        <span class="bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
            {{ $eventosPorRevisar->count() }} nuevos
        </span>
    </div>
    <div class="space-y-4">
        @foreach ($eventosPorRevisar as $evento)
            <div class="border-l-4 border-yellow-500 pl-4 py-2">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-medium text-gray-800 dark:text-white">{{ $evento->titulo }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Creado por: {{ $evento->user->name ?? 'Desconocido' }}</p>
                    </div>
                    <span class="text-xs bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 px-2 py-1 rounded-full">Pendiente</span>
                </div>
                <div class="flex mt-3 space-x-2">
                    <form action="{{ route('admin.eventos.aprobar', $evento) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">Aprobar</button>
                    </form>

                    <form action="{{ route('admin.eventos.rechazar', $evento) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                    </form>
                    <a href="{{ route('admin.eventos.mostrar', $evento->id) }}" class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 px-3 py-1 rounded-full transition inline-flex items-center">
                        <i class="fas fa-eye mr-1"></i> Ver
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <a href="{{ route('admin.eventos.pendientes') }}" class="w-full mt-4 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium flex items-center justify-center">
        Ver todos los pendientes <i class="fas fa-chevron-right ml-2"></i>
    </a>
</div>
</div>

        </div>

        <!-- Actividad Reciente y Usuarios Nuevos -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Actividad Reciente -->
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Actividad Reciente</h2>
        <div class="space-y-4">
            @foreach($actividadesRecientes as $actividad)
                <div class="flex items-start p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                    <div class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 p-2 rounded-full mr-4">
                        <i class="{{ $actividad->icono }} text-sm"></i>
                    </div>
                    <div class="flex-grow">
                        <p class="text-gray-800 dark:text-white">{!! $actividad->descripcion !!}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $actividad->fecha->diffForHumans() }}</p>
                    </div>
                    <button class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>


            <!-- Usuarios Recientes -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Usuarios Recientes</h2>
                    <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium">
                        Ver todos
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                <th class="pb-2">Usuario</th>
                                <th class="pb-2">Registro</th>
                                <th class="pb-2">Estado</th>
                                <th class="pb-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-600 dark:text-indigo-300 font-medium mr-3">
                                            MG
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-800 dark:text-white">Maria García</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">maria@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400">Hoy</td>
                                <td class="py-3">
                                    <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded-full">Activo</span>
                                </td>
                                <td class="py-3">
                                    <button class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-medium mr-3">
                                            JP
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-800 dark:text-white">Juan Pérez</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">juan@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400">Ayer</td>
                                <td class="py-3">
                                    <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded-full">Activo</span>
                                </td>
                                <td class="py-3">
                                    <button class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 font-medium mr-3">
                                            LS
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-800 dark:text-white">Laura Sánchez</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">laura@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400">Hace 3 días</td>
                                <td class="py-3">
                                    <span class="text-xs px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 rounded-full">Pendiente</span>
                                </td>
                                <td class="py-3">
                                    <button class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Categorías (oculto por defecto) -->
<div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Gestión de Categorías</h3>
                <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-medium text-gray-700 dark:text-gray-300">Lista de Categorías</h4>
                    <button class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-1"></i> Nueva Categoría
                    </button>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-600 flex justify-between items-center">
                            <span class="font-medium">Conciertos</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-600 flex justify-between items-center">
                            <span class="font-medium">Conferencias</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-600 flex justify-between items-center">
                            <span class="font-medium">Talleres</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-600 flex justify-between items-center">
                            <span class="font-medium">Deportes</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-600 flex justify-between items-center">
                            <span class="font-medium">Gastronomía</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-600 flex justify-between items-center">
                            <span class="font-medium">Arte</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Notas</h4>
<p class="text-sm text-gray-500 dark:text-gray-400">
    Puedes agregar, editar o eliminar categorías según las necesidades de tu plataforma.
</p>
</div>
</div>
</div>
</div>

@push('scripts')
<script>
function openCategoryModal() {
document.getElementById('categoryModal').classList.remove('hidden');
}
function closeCategoryModal() {
document.getElementById('categoryModal').classList.add('hidden');
}

// Ejemplo de inicialización de Chart.js para el gráfico de ventas
document.addEventListener('DOMContentLoaded', function () {
if (window.Chart) {
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
type: 'line',
data: {
    labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
    datasets: [{
        label: 'Tickets Vendidos',
        data: [120, 190, 300, 250, 220, 310, 400],
        backgroundColor: 'rgba(99, 102, 241, 0.2)',
        borderColor: 'rgba(99, 102, 241, 1)',
        borderWidth: 2,
        tension: 0.4,
        fill: true,
        pointRadius: 4,
        pointBackgroundColor: 'rgba(99, 102, 241, 1)'
    }]
},
options: {
    responsive: true,
    plugins: {
        legend: { display: false }
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: { color: '#6B7280' }
        },
        x: {
            ticks: { color: '#6B7280' }
        }
    }
}
});
}
});
</script>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($fechas),
            datasets: [{
                label: 'Tickets vendidos',
                data: @json($tickets),
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                borderColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(99, 102, 241, 1)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush

@endsection
