@extends('layouts.app')

@section('content')

@php
    $eventosRevisadosJS = $eventosRevisados->map(function($e) {
        return [
            'id' => $e->id,
            'titulo' => $e->titulo,
            'fecha_inicio' => $e->fecha_inicio,
            'fecha_formateada' => \Illuminate\Support\Carbon::parse($e->fecha_inicio)->format('d/m/Y H:i'),
            'banner_url' => $e->banner ? asset('storage/img/' . $e->banner) : null,
        ];
    });
    $eventosPorRevisarJS = $eventosPorRevisar->map(function($e) {
        return [
            'id' => $e->id,
            'titulo' => $e->titulo,
            'fecha_inicio' => $e->fecha_inicio,
            'fecha_formateada' => \Illuminate\Support\Carbon::parse($e->fecha_inicio)->format('d/m/Y H:i'),
            'banner_url' => $e->banner ? asset('storage/img/' . $e->banner) : null,
        ];
    });
@endphp

<div x-data="eventosAdmin()" class="flex gap-6 p-8 min-h-screen
    bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500
    text-gray-100 justify-center">

  {{-- Eventos Revisados --}}
  <div
    class="max-w-xl max-h-[600px] w-full rounded-xl p-6 flex flex-col
    bg-white/30 backdrop-blur-md border border-white/40 shadow-lg
    transition duration-300 hover:bg-white/40 hover:shadow-xl
    overflow-auto"
  >
    <h2 class="text-2xl font-bold mb-6 border-b border-white/50 pb-2 drop-shadow">
      Eventos Revisados
    </h2>

    <template x-if="eventosRevisados.length === 0">
      <p class="text-white/70">No hay eventos revisados.</p>
    </template>

    <template x-for="evento in eventosRevisadosPaginaActual" :key="evento.id">
      <a
        :href="`/admin/eventos/${evento.id}`"
        class="mb-6 block rounded-lg cursor-pointer
               bg-white/20 backdrop-blur-sm border border-white/30
               hover:bg-white/40 hover:scale-[1.02] transition transform duration-200 overflow-visible"
      >
        <div class="h-40 w-full overflow-hidden rounded-t-lg">
          <img
            :src="evento.banner_url || 'https://via.placeholder.com/600x240?text=Sin+Banner'"
            alt="Banner del evento"
            class="object-cover w-full h-full transition-transform duration-300 hover:scale-105"
          />
        </div>
        <div class="p-6">
          <h3 class="font-semibold text-white text-lg drop-shadow-md" x-text="evento.titulo"></h3>
          <div class="text-sm text-white/70 mt-2 font-mono" x-text="evento.fecha_formateada"></div>
        </div>
      </a>
    </template>

    <div class="flex justify-between mt-auto pt-4 border-t border-white/30">
      <button
        @click="paginaRevisados > 1 && paginaRevisados--"
        :disabled="paginaRevisados === 1"
        class="px-4 py-2 bg-white/30 rounded disabled:opacity-50 text-white font-semibold hover:bg-white/50 transition"
      >Anterior</button>
      <button
        @click="paginaRevisados < paginasRevisados && paginaRevisados++"
        :disabled="paginaRevisados === paginasRevisados"
        class="px-4 py-2 bg-white/30 rounded disabled:opacity-50 text-white font-semibold hover:bg-white/50 transition"
      >Siguiente</button>
    </div>
  </div>

  {{-- Eventos Por Revisar --}}
  <div
    class="max-w-xl max-h-[600px] w-full rounded-xl p-6 flex flex-col
    bg-white/30 backdrop-blur-md border border-white/40 shadow-lg
    transition duration-300 hover:bg-white/40 hover:shadow-xl
    overflow-auto"
  >
    <h2 class="text-2xl font-bold mb-6 border-b border-white/50 pb-2 drop-shadow">
      Eventos Por Revisar
    </h2>

    <template x-if="eventosPorRevisar.length === 0">
      <p class="text-white/70">No hay eventos pendientes de revisión.</p>
    </template>

    <template x-for="evento in eventosPorRevisarPaginaActual" :key="evento.id">
      <a
        :href="`/admin/eventos/${evento.id}`"
        class="mb-6 block rounded-lg cursor-pointer
               bg-white/20 backdrop-blur-sm border border-white/30
               hover:bg-white/40 hover:scale-[1.02] transition transform duration-200 overflow-visible"
      >
        <div class="h-40 w-full overflow-hidden rounded-t-lg">
          <img
            :src="evento.banner_url || 'https://via.placeholder.com/600x240?text=Sin+Banner'"
            alt="Banner del evento"
            class="object-cover w-full h-full transition-transform duration-300 hover:scale-105"
          />
        </div>
        <div class="p-6">
          <h3 class="font-semibold text-white text-lg drop-shadow-md" x-text="evento.titulo"></h3>
          <div class="text-sm text-white/70 mt-2 font-mono" x-text="evento.fecha_formateada"></div>
        </div>
      </a>
    </template>

    <div class="flex justify-between mt-auto pt-4 border-t border-white/30">
      <button
        @click="paginaPorRevisar > 1 && paginaPorRevisar--"
        :disabled="paginaPorRevisar === 1"
        class="px-4 py-2 bg-white/30 rounded disabled:opacity-50 text-white font-semibold hover:bg-white/50 transition"
      >Anterior</button>
      <button
        @click="paginaPorRevisar < paginasPorRevisar && paginaPorRevisar++"
        :disabled="paginaPorRevisar === paginasPorRevisar"
        class="px-4 py-2 bg-white/30 rounded disabled:opacity-50 text-white font-semibold hover:bg-white/50 transition"
      >Siguiente</button>
    </div>
  </div>
</div>

<script>
function eventosAdmin() {
    return {
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
