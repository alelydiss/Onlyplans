@extends('layouts.app')

@section('content')

<div x-data="ticketsApp()" class="p-6 max-w-5xl mx-auto">

  <input 
    type="text" 
    x-model="busqueda" 
    placeholder="Buscar ..." 
    class="mb-6 w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
  />

  <!-- Resumen por evento -->
  <div class="mb-6 space-y-4">
    <template x-for="(resumen, eventId) in resumenPorEvento()" :key="eventId">
      <div class="p-4 bg-indigo-50 border border-indigo-200 rounded-lg shadow-sm">
        <h3 class="font-semibold text-indigo-700 mb-1">Evento ID: <span x-text="eventId"></span></h3>
        <p class="text-gray-700 text-sm">Tickets vendidos: <span x-text="resumen.totalTickets"></span></p>
        <p class="text-gray-700 text-sm">Total recaudado: $<span x-text="resumen.totalRecaudado.toFixed(2)"></span></p>
      </div>
    </template>
  </div>

  <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-indigo-600">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Correo</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Cantidad</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Asientos</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <template x-for="ticket in ticketsFiltrados()" :key="ticket.id">
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="ticket.id"></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="ticket.nombre"></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="ticket.correo"></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="ticket.cantidad"></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="ticket.asientos.join ? ticket.asientos.join(', ') : ticket.asientos"></td>
          </tr>
        </template>
        <template x-if="ticketsFiltrados().length === 0">
          <tr>
            <td class="px-6 py-4 text-center text-sm text-gray-500 italic" colspan="5">No hay tickets.</td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>

</div>

<script>
  function ticketsApp() {
    return {
      busqueda: '',
      tickets: {!! $tickets->map(function($ticket) {
          $ticket->asientos = json_decode($ticket->asientos) ?: [];
          return $ticket;
      })->toJson() !!},

      ticketsFiltrados() {
        if (!this.busqueda.trim()) return this.tickets;
        return this.tickets.filter(ticket => ticket.correo.toLowerCase().includes(this.busqueda.toLowerCase()));
      },

      resumenPorEvento() {
        // Calculamos resumen solo sobre tickets filtrados para que cambie al buscar
        const resumen = {};
        this.ticketsFiltrados().forEach(ticket => {
          if (!resumen[ticket.event_id]) {
            resumen[ticket.event_id] = { totalTickets: 0, totalRecaudado: 0 };
          }
          resumen[ticket.event_id].totalTickets += Number(ticket.cantidad);
          resumen[ticket.event_id].totalRecaudado += Number(ticket.total);
        });
        return resumen;
      }
    }
  }
</script>

@endsection
