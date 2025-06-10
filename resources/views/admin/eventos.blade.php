@extends('layouts.app')

@section('content')

@php
  $eventosRevisadosJS = $eventosRevisados->map(function($e) {
    return [
      'id' => $e->id,
      'titulo' => $e->titulo,
      'fecha_inicio' => $e->fecha_inicio,
      'fecha_formateada' => \Illuminate\Support\Carbon::parse($e->fecha_inicio)->format('d/m/Y H:i'),
      'banner_url' => $e->banner ? asset('storage/' . $e->banner) : null,
      'estado' => 'revisado'
    ];
  });
  $eventosPorRevisarJS = $eventosPorRevisar->map(function($e) {
    return [
      'id' => $e->id,
      'titulo' => $e->titulo,
      'fecha_inicio' => $e->fecha_inicio,
      'fecha_formateada' => \Illuminate\Support\Carbon::parse($e->fecha_inicio)->format('d/m/Y H:i'),
      'banner_url' => $e->banner ? asset('storage/' . $e->banner) : null,
      'estado' => 'pendiente'
    ];
  });
@endphp

<div x-data="eventosAdmin()" class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">

        <!-- Animated Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="relative">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-white relative z-10">Gestión de Eventos</h1>
                <div class="absolute -bottom-1 left-0 w-24 h-2 bg-indigo-200 dark:bg-indigo-800 rounded-full z-0 animate-pulse"></div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm px-3 py-1.5 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 flex items-center">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                    <span x-text="eventosRevisados.length + ' revisados'"></span>
                </div>
                <div class="text-sm px-3 py-1.5 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-300 flex items-center">
                    <span class="w-2 h-2 rounded-full bg-orange-500 mr-2 animate-pulse"></span>
                    <span x-text="eventosPorRevisar.length + ' por revisar'"></span>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex space-x-8">
                    <button 
                        @click="tabActiva = 'revisados'"
                        :class="tabActiva === 'revisados' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-500'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                    >
                        Eventos Revisados
                    </button>
                    <button 
                        @click="tabActiva = 'porRevisar'"
                        :class="tabActiva === 'porRevisar' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-500'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                    >
                        Pendientes de Revisión
                    </button>
                </nav>
            </div>
        </div>

        <div class="flex justify-between mb-6">
            <div class="flex space-x-2">
                <!-- Botón para cambiar vista -->
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button id="tableViewBtn" onclick="toggleView('table')" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-l-lg bg-indigo-600 text-white hover:bg-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Tabla
                    </button>
                    <button id="cardsViewBtn" onclick="toggleView('cards')" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-r-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-indigo-500 border border-gray-200 dark:border-gray-600 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Cards
                    </button>
                </div>
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

        <!-- Floating Events List -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
            <div class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 p-3 rounded-xl mr-4">
                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white" x-text="tabActiva === 'revisados' ? 'Eventos Revisados' : 'Eventos por Revisar'"></h2>
            </div>
            <div class="relative">
            <input 
                type="text" 
                id="search-input" 
                placeholder="Buscar evento..." 
                class="pl-10 pr-4 py-2 text-sm bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-200"
                x-model="searchTerm"
                @input="filtrarEventos"
            >
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            </div>
        </div>

        <div id="tableView">
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-xl border border-white/30 dark:border-gray-700/50 overflow-hidden hover:shadow-2xl transition-shadow duration-500">
            <div class="p-6 sm:p-8">
                <!-- Eventos Revisados -->
                <div x-show="tabActiva === 'revisados'" x-transition>
                <template x-if="eventosRevisadosFiltrados.length === 0">
                    <div class="text-center py-12">
                    <div class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No hay eventos revisados</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Todos los eventos pendientes aparecerán aquí una vez revisados.</p>
                    </div>
                </template>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Evento</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Título</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Fecha</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Acciones</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/30 dark:bg-gray-800/30 divide-y divide-gray-200 dark:divide-gray-700">
                        <template x-for="evento in eventosRevisadosPaginaActual" :key="evento.id">
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition duration-150 event-row" :data-name="evento.titulo.toLowerCase()">
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img 
                                :src="evento.banner_url || 'https://via.placeholder.com/300x200?text=Sin+Banner'" 
                                alt="Banner del evento"
                                class="h-10 w-10 rounded-lg object-cover shadow-sm group-hover:shadow-md transition-shadow duration-200"
                                >
                            </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="evento.titulo"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-300" x-text="evento.fecha_formateada"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-3">
                                <a 
                                :href="'/admin/eventos/' + evento.id"
                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center"
                                >
                                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Ver
                                </a>
                            </div>
                            </td>
                        </tr>
                        </template>
                    </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                    <button 
                        @click="paginaRevisados > 1 && paginaRevisados--"
                        :disabled="paginaRevisados === 1"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Anterior
                    </button>
                    <button 
                        @click="paginaRevisados < paginasRevisados && paginaRevisados++"
                        :disabled="paginaRevisados === paginasRevisados"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Siguiente
                    </button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-200">
                        Mostrando <span class="font-medium" x-text="(paginaRevisados - 1) * itemsPorPagina + 1"></span> a 
                        <span class="font-medium" x-text="Math.min(paginaRevisados * itemsPorPagina, eventosRevisadosFiltrados.length)"></span> de 
                        <span class="font-medium" x-text="eventosRevisadosFiltrados.length"></span> resultados
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <button 
                            @click="paginaRevisados > 1 && paginaRevisados--"
                            :disabled="paginaRevisados === 1"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="sr-only">Anterior</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <template x-for="i in paginasRevisados">
                            <button
                            @click="paginaRevisados = i"
                            :class="i === paginaRevisados ? 'z-10 bg-indigo-50 dark:bg-indigo-900 border-indigo-500 text-indigo-600 dark:text-indigo-300' : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            x-text="i"
                            ></button>
                        </template>
                        <button 
                            @click="paginaRevisados < paginasRevisados && paginaRevisados++"
                            :disabled="paginaRevisados === paginasRevisados"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="sr-only">Siguiente</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        </nav>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Eventos por Revisar -->
                <div x-show="tabActiva === 'porRevisar'" x-transition>
                <template x-if="eventosPorRevisarFiltrados.length === 0">
                    <div class="text-center py-12">
                    <div class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No hay eventos pendientes</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Todos los eventos están revisados. ¡Buen trabajo!</p>
                    </div>
                </template>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Evento</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Título</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Fecha</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Acciones</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/30 dark:bg-gray-800/30 divide-y divide-gray-200 dark:divide-gray-700">
                        <template x-for="evento in eventosPorRevisarPaginaActual" :key="evento.id">
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition duration-150 event-row" :data-name="evento.titulo.toLowerCase()">
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img 
                                :src="evento.banner_url || 'https://via.placeholder.com/300x200?text=Sin+Banner'" 
                                alt="Banner del evento"
                                class="h-10 w-10 rounded-lg object-cover shadow-sm group-hover:shadow-md transition-shadow duration-200"
                                >
                            </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="evento.titulo"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-300" x-text="evento.fecha_formateada"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-3">
                                <a 
                                :href="'/admin/eventos/' + evento.id"
                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center"
                                >
                                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Revisar
                                </a>
                            </div>
                            </td>
                        </tr>
                        </template>
                    </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                    <button 
                        @click="paginaPorRevisar > 1 && paginaPorRevisar--"
                        :disabled="paginaPorRevisar === 1"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Anterior
                    </button>
                    <button 
                        @click="paginaPorRevisar < paginasPorRevisar && paginaPorRevisar++"
                        :disabled="paginaPorRevisar === paginasPorRevisar"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Siguiente
                    </button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-200">
                        Mostrando <span class="font-medium" x-text="(paginaPorRevisar - 1) * itemsPorPagina + 1"></span> a 
                        <span class="font-medium" x-text="Math.min(paginaPorRevisar * itemsPorPagina, eventosPorRevisarFiltrados.length)"></span> de 
                        <span class="font-medium" x-text="eventosPorRevisarFiltrados.length"></span> resultados
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <button 
                            @click="paginaPorRevisar > 1 && paginaPorRevisar--"
                            :disabled="paginaPorRevisar === 1"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="sr-only">Anterior</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <template x-for="i in paginasPorRevisar">
                            <button
                            @click="paginaPorRevisar = i"
                            :class="i === paginaPorRevisar ? 'z-10 bg-indigo-50 dark:bg-indigo-900 border-indigo-500 text-indigo-600 dark:text-indigo-300' : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            x-text="i"
                            ></button>
                        </template>
                        <button 
                            @click="paginaPorRevisar < paginasPorRevisar && paginaPorRevisar++"
                            :disabled="paginaPorRevisar === paginasPorRevisar"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="sr-only">Siguiente</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        </nav>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- VISTA CARDS -->
        <div id="cardsView" class="hidden">
            <div x-show="tabActiva === 'revisados'" x-transition>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <template x-for="evento in eventosRevisadosPaginaActual" :key="evento.id">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-col">
                    <img :src="evento.banner_url || 'https://via.placeholder.com/300x200?text=Sin+Banner'" class="rounded-lg h-40 object-cover mb-3" alt="">
                    <div class="font-bold text-lg text-gray-800 dark:text-white" x-text="evento.titulo"></div>
                    <div class="text-sm text-gray-500 dark:text-gray-300 mb-2" x-text="evento.fecha_formateada"></div>
                    <a :href="'/admin/eventos/' + evento.id" class="mt-auto inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:underline">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Ver
                    </a>
                </div>
                </template>
            </div>
            </div>
            <div x-show="tabActiva === 'porRevisar'" x-transition>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <template x-for="evento in eventosPorRevisarPaginaActual" :key="evento.id">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-col">
                    <img :src="evento.banner_url || 'https://via.placeholder.com/300x200?text=Sin+Banner'" class="rounded-lg h-40 object-cover mb-3" alt="">
                    <div class="font-bold text-lg text-gray-800 dark:text-white" x-text="evento.titulo"></div>
                    <div class="text-sm text-gray-500 dark:text-gray-300 mb-2" x-text="evento.fecha_formateada"></div>
                    <a :href="'/admin/eventos/' + evento.id" class="mt-auto inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:underline">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Revisar
                    </a>
                </div>
                </template>
            </div>
            </div>
        </div>
        </div>
</div>

<script>
    // Función para cambiar entre vistas
    function toggleView(viewType) {
        const tableView = document.getElementById('tableView');
        const cardsView = document.getElementById('cardsView');
        const tableViewBtn = document.getElementById('tableViewBtn');
        const cardsViewBtn = document.getElementById('cardsViewBtn');
        
        if (viewType === 'table') {
            tableView.classList.remove('hidden');
            cardsView.classList.add('hidden');
            tableViewBtn.classList.remove('bg-white', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            tableViewBtn.classList.add('bg-indigo-600', 'text-white');
            cardsViewBtn.classList.remove('bg-indigo-600', 'text-white');
            cardsViewBtn.classList.add('bg-white', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            
            // Guardar preferencia en localStorage
            localStorage.setItem('categoriasViewPreference', 'table');
        } else {
            tableView.classList.add('hidden');
            cardsView.classList.remove('hidden');
            tableViewBtn.classList.remove('bg-indigo-600', 'text-white');
            tableViewBtn.classList.add('bg-white', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            cardsViewBtn.classList.remove('bg-white', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            cardsViewBtn.classList.add('bg-indigo-600', 'text-white');
            
            // Guardar preferencia en localStorage
            localStorage.setItem('categoriasViewPreference', 'cards');
        }
    }

    // Cargar preferencia de vista al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('categoriasViewPreference');
        if (savedView === 'cards') {
            toggleView('cards');
        }
    });
function eventosAdmin() {
  return {
    tabActiva: 'revisados',
    searchTerm: '',
    eventosRevisados: @json($eventosRevisadosJS),
    eventosPorRevisar: @json($eventosPorRevisarJS),

    paginaRevisados: 1,
    paginaPorRevisar: 1,
    itemsPorPagina: 10,

    get eventosRevisadosFiltrados() {
        if (!this.searchTerm) return this.eventosRevisados;
        return this.eventosRevisados.filter(evento => 
            evento.titulo.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
    },

    get eventosPorRevisarFiltrados() {
        if (!this.searchTerm) return this.eventosPorRevisar;
        return this.eventosPorRevisar.filter(evento => 
            evento.titulo.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
    },

    get paginasRevisados() {
      return Math.ceil(this.eventosRevisadosFiltrados.length / this.itemsPorPagina) || 1;
    },

    get paginasPorRevisar() {
      return Math.ceil(this.eventosPorRevisarFiltrados.length / this.itemsPorPagina) || 1;
    },

    get eventosRevisadosPaginaActual() {
      const start = (this.paginaRevisados - 1) * this.itemsPorPagina;
      return this.eventosRevisadosFiltrados.slice(start, start + this.itemsPorPagina);
    },

    get eventosPorRevisarPaginaActual() {
      const start = (this.paginaPorRevisar - 1) * this.itemsPorPagina;
      return this.eventosPorRevisarFiltrados.slice(start, start + this.itemsPorPagina);
    },

    filtrarEventos() {
        // Resetear a la primera página cuando se filtra
        this.paginaRevisados = 1;
        this.paginaPorRevisar = 1;
    }
  }
}
</script>

@endsection