@extends('layouts.app')

@section('content')

<div x-data="ticketsApp()" class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">

        <!-- Animated Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="relative">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-white relative z-10">Gestión de Tickets</h1>
                <div class="absolute -bottom-1 left-0 w-24 h-2 bg-indigo-200 dark:bg-indigo-800 rounded-full z-0 animate-pulse"></div>
            </div>
            <div class="text-sm px-3 py-1.5 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 flex items-center">
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                <span x-text="tickets.length + ' tickets'"></span>
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

        <!-- Resumen por evento -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <template x-for="(resumen, eventId) in resumenPorEvento()" :key="eventId">
                <div class="p-5 bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-xl shadow-md border border-white/30 dark:border-gray-700/50 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-start">
                        <div class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white mb-1">Evento ID: <span x-text="eventId"></span></h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Tickets vendidos: <span class="font-medium" x-text="resumen.totalTickets"></span></p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Total recaudado: <span class="font-medium">$<span x-text="resumen.totalRecaudado.toFixed(2)"></span></span></p>
                        </div>
                    </div>
                </div>
            </template>
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

        <!-- Floating Tickets List -->
        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-xl border border-white/30 dark:border-gray-700/50 overflow-hidden hover:shadow-2xl transition-shadow duration-500">
            <div class="p-6 sm:p-8">
                <!-- Search and Header -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Todos los Tickets</h2>
                    </div>
                    <div class="relative">
                        <input 
                            type="text" 
                            x-model="busqueda" 
                            placeholder="Buscar ticket..." 
                            class="pl-10 pr-4 py-2 text-sm bg-white/50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 text-gray-900 dark:text-white"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div id="tableView" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Correo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Cantidad</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Asientos</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/30 dark:bg-gray-800/30 divide-y divide-gray-200 dark:divide-gray-700">
                            <template x-for="ticket in ticketsFiltrados()" :key="ticket.id">
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="ticket.id"></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-300" x-text="ticket.nombre"></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-300" x-text="ticket.correo"></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-300" x-text="ticket.cantidad"></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-300" x-text="ticket.asientos.join ? ticket.asientos.join(', ') : ticket.asientos"></div>
                                    </td>
                                </tr>
                            </template>
                            <template x-if="ticketsFiltrados().length === 0">
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400 italic">No se encontraron tickets</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div id="cardsView" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <template x-for="ticket in ticketsFiltrados()" :key="ticket.id">
                        <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 mb-4">
                            <div class="flex items-center mb-2">
                                <span class="text-indigo-600 dark:text-indigo-400 font-bold text-lg mr-2" x-text="ticket.id"></span>
                                <span class="text-gray-700 dark:text-white font-semibold" x-text="ticket.nombre"></span>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-300 mb-1">
                                <span class="font-medium">Correo:</span> <span x-text="ticket.correo"></span>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-300 mb-1">
                                <span class="font-medium">Cantidad:</span> <span x-text="ticket.cantidad"></span>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-300">
                                <span class="font-medium">Asientos:</span>
                                <span x-text="ticket.asientos.join ? ticket.asientos.join(', ') : ticket.asientos"></span>
                            </div>
                        </div>
                    </template>
                    <template x-if="ticketsFiltrados().length === 0">
                        <div class="col-span-full text-center text-sm text-gray-500 dark:text-gray-400 italic py-8">
                            No se encontraron tickets
                        </div>
                    </template>
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
function ticketsApp() {
    return {
        busqueda: '',
        tickets: {!! $tickets->map(function($ticket) {
            $ticket->asientos = json_decode($ticket->asientos) ?: [];
            return $ticket;
        })->toJson() !!},

        ticketsFiltrados() {
            if (!this.busqueda.trim()) return this.tickets;
            const term = this.busqueda.toLowerCase();
            return this.tickets.filter(ticket => 
                ticket.correo.toLowerCase().includes(term) ||
                ticket.nombre.toLowerCase().includes(term) ||
                ticket.id.toString().includes(term) ||
                (ticket.asientos.join && ticket.asientos.join(' ').toLowerCase().includes(term))
            );
        },

        resumenPorEvento() {
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