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

<div x-data="eventosAdmin()" class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6 md:p-10">
  <div class="max-w-7xl mx-auto">
  <!-- Header -->
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Panel de Administración de Eventos</h1>
    <p class="text-gray-600 dark:text-gray-300 mt-2">Gestiona los eventos revisados y pendientes de revisión</p>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-4 border-blue-500">
    <div class="flex items-center justify-between">
      <div>
      <p class="text-gray-500 dark:text-gray-300 text-sm font-medium">Eventos Revisados</p>
      <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1" x-text="eventosRevisados.length"></p>
      </div>
      <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      </div>
    </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-4 border-orange-500">
    <div class="flex items-center justify-between">
      <div>
      <p class="text-gray-500 dark:text-gray-300 text-sm font-medium">Eventos por Revisar</p>
      <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1" x-text="eventosPorRevisar.length"></p>
      </div>
      <div class="bg-orange-100 dark:bg-orange-900 p-3 rounded-full">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      </div>
    </div>
    </div>
  </div>

  <!-- Tabs -->
  <div class="mb-6">
    <div class="border-b border-gray-200 dark:border-gray-700">
    <nav class="-mb-px flex space-x-8">
      <button 
      @click="tabActiva = 'revisados'"
      :class="tabActiva === 'revisados' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-500'"
      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
      >
      Eventos Revisados
      </button>
      <button 
      @click="tabActiva = 'porRevisar'"
      :class="tabActiva === 'porRevisar' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-500'"
      class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
      >
      Pendientes de Revisión
      </button>
    </nav>
    </div>
  </div>

  <!-- Eventos Revisados -->
  <div x-show="tabActiva === 'revisados'" x-transition class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Eventos Revisados</h2>
    <div class="flex items-center space-x-2">
      <span class="text-sm text-gray-500 dark:text-gray-300" x-text="`Mostrando ${eventosRevisadosPaginaActual.length} de ${eventosRevisados.length}`"></span>
    </div>
    </div>
    
    <template x-if="eventosRevisados.length === 0">
    <div class="p-8 text-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No hay eventos revisados</h3>
      <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Todos los eventos pendientes aparecerán aquí una vez revisados.</p>
    </div>
    </template>

    <template x-for="evento in eventosRevisadosPaginaActual" :key="evento.id">
    <a 
      :href="`/admin/eventos/${evento.id}`"
      class="block hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out border-b border-gray-200 dark:border-gray-700 last:border-b-0"
    >
      <div class="px-6 py-4 flex items-start">
      <div class="flex-shrink-0 h-20 w-20 rounded-md overflow-hidden">
        <img 
        :src="evento.banner_url || 'https://via.placeholder.com/300x200?text=Sin+Banner'" 
        alt="Banner del evento"
        class="h-full w-full object-cover"
        >
      </div>
      <div class="ml-4 flex-1">
        <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="evento.titulo"></h3>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300">
          Revisado
        </span>
        </div>
        <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span x-text="evento.fecha_formateada"></span>
        </div>
      </div>
      </div>
    </a>
    </template>

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
        Mostrando página <span class="font-medium" x-text="paginaRevisados"></span> de 
        <span class="font-medium" x-text="paginasRevisados"></span>
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
          :class="i === paginaRevisados ? 'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 text-blue-600 dark:text-blue-300' : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'"
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
  <div x-show="tabActiva === 'porRevisar'" x-transition class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mt-8">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Eventos Pendientes de Revisión</h2>
    <div class="flex items-center space-x-2">
      <span class="text-sm text-gray-500 dark:text-gray-300" x-text="`Mostrando ${eventosPorRevisarPaginaActual.length} de ${eventosPorRevisar.length}`"></span>
    </div>
    </div>
    
    <template x-if="eventosPorRevisar.length === 0">
    <div class="p-8 text-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No hay eventos pendientes</h3>
      <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Todos los eventos están revisados. ¡Buen trabajo!</p>
    </div>
    </template>

    <template x-for="evento in eventosPorRevisarPaginaActual" :key="evento.id">
    <a 
      :href="`/admin/eventos/${evento.id}`"
      class="block hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out border-b border-gray-200 dark:border-gray-700 last:border-b-0"
    >
      <div class="px-6 py-4 flex items-start">
      <div class="flex-shrink-0 h-20 w-20 rounded-md overflow-hidden">
        <img 
        :src="evento.banner_url || 'https://via.placeholder.com/300x200?text=Sin+Banner'" 
        alt="Banner del evento"
        class="h-full w-full object-cover"
        >
      </div>
      <div class="ml-4 flex-1">
        <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="evento.titulo"></h3>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300">
          Pendiente
        </span>
        </div>
        <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span x-text="evento.fecha_formateada"></span>
        </div>
      </div>
      </div>
    </a>
    </template>

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
        Mostrando página <span class="font-medium" x-text="paginaPorRevisar"></span> de 
        <span class="font-medium" x-text="paginasPorRevisar"></span>
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
          :class="i === paginaPorRevisar ? 'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 text-blue-600 dark:text-blue-300' : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'"
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

<script>
function eventosAdmin() {
  return {
    tabActiva: 'revisados',
    eventosRevisados: @json($eventosRevisadosJS),
    eventosPorRevisar: @json($eventosPorRevisarJS),

    paginaRevisados: 1,
    paginaPorRevisar: 1,
    itemsPorPagina: 5,

    get paginasRevisados() {
      return Math.ceil(this.eventosRevisados.length / this.itemsPorPagina) || 1;
    },
    get paginasPorRevisar() {
      return Math.ceil(this.eventosPorRevisar.length / this.itemsPorPagina) || 1;
    },

    get eventosRevisadosPaginaActual() {
      const start = (this.paginaRevisados - 1) * this.itemsPorPagina;
      return this.eventosRevisados.slice(start, start + this.itemsPorPagina);
    },

    get eventosPorRevisarPaginaActual() {
      const start = (this.paginaPorRevisar - 1) * this.itemsPorPagina;
      return this.eventosPorRevisar.slice(start, start + this.itemsPorPagina);
    }
  }
}
</script>

@endsection