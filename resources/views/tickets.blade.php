@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 min-h-screen">
    <h1 class="text-4xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-500">
        Mis Tickets
    </h1>

    <!-- Modal de Ayuda (hidden por defecto) -->
    <div id="helpModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Fondo del modal -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>
            
            <!-- Contenido del modal -->
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-r from-purple-100 to-pink-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                Centro de Ayuda
                            </h3>
                            <div class="mt-4">
                                <div class="space-y-4">
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="font-medium text-gray-800 dark:text-white mb-2">¿Problemas con tus tickets?</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            Si tienes algún problema con tus tickets, no dudes en contactar con nuestro equipo de soporte.
                                        </p>
                                    </div>
                                    
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="font-medium text-gray-800 dark:text-white mb-2">Contacto de Soporte</h4>
                                        <div class="flex items-center mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            <span class="text-gray-700 dark:text-gray-300">+34 123 456 789</span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="font-medium text-gray-800 dark:text-white mb-2">Horario de Atención</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            Lunes a Viernes: 9:00 - 20:00<br>
                                            Sábados: 10:00 - 14:00
                                        </p>
                                    </div>
                                    
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h4 class="font-medium text-gray-800 dark:text-white mb-2">Preguntas Frecuentes</h4>
                                        <div class="space-y-2 mt-2">
                                            <details class="group">
                                                <summary class="flex justify-between items-center cursor-pointer text-gray-700 dark:text-gray-300">
                                                    <span>¿Cómo descargo mis tickets?</span>
                                                    <svg class="h-5 w-5 text-pink-500 group-open:rotate-180 transform transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </summary>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    Haz clic en el botón "Descargar" en tu ticket. Se generará un PDF que podrás guardar o imprimir.
                                                </p>
                                            </details>
                                            
                                            <details class="group">
                                                <summary class="flex justify-between items-center cursor-pointer text-gray-700 dark:text-gray-300">
                                                    <span>¿Qué hago si no recibo mi ticket?</span>
                                                    <svg class="h-5 w-5 text-pink-500 group-open:rotate-180 transform transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </summary>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    Revisa tu bandeja de spam. Si no lo encuentras, contáctanos con los detalles de tu compra y te lo reenviaremos.
                                                </p>
                                            </details>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="closeHelpModal" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-500 text-base font-medium text-white hover:from-purple-700 hover:to-pink-600 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-all">
                        Entendido
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="text-center py-20">
            <div class="inline-flex items-center justify-center w-24 h-24 mb-6 rounded-full bg-gradient-to-br from-purple-100 to-pink-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">No tienes tickets aún</h3>
            <p class="text-gray-600 dark:text-gray-300 max-w-md mx-auto">Cuando compres entradas para eventos, aparecerán aquí para que puedas gestionarlas.</p>
            <a href="{{ route('eventos') }}" class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 transition-all duration-300 transform hover:-translate-y-1">
                Explorar Eventos
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-8">
            @foreach($orders as $order)
                @if($order->total == 0)
                    <!-- Diseño especial para entradas GRATIS -->
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-300"></div>
                        <div class="relative bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 border-2 border-emerald-400">
                            <div class="absolute top-4 right-4 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-gradient-to-r from-emerald-500 to-teal-600">
                                    Gratis
                                </span>
                            </div>
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3 relative overflow-hidden">
                                    <img src="{{ $order->event->banner ? asset('storage/' . $order->event->banner) : asset('img/evento6.png') }}" 
                                         class="w-full h-48 md:h-full object-cover transform transition duration-500 group-hover:scale-105" />
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold text-white bg-teal-500">
                                            {{ $order->zona }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="md:w-2/3 p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $order->event->titulo }}</h2>
                                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300 mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($order->event->fecha)->isoFormat('D MMMM YYYY') }}
                                                <span class="mx-2">•</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($order->event->hora_inicio)->format('H:i') }}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block px-4 py-2 rounded-full text-lg font-bold text-white bg-gradient-to-r from-emerald-400 to-teal-500">
                                                Gratis
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">DETALLES DEL TICKET</h3>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                </svg>
                                                <span class="font-medium dark:text-white">{{ $order->cantidad }} {{ $order->cantidad > 1 ? 'Entradas' : 'Entrada' }}</span>
                                            </div>
                                            <div class="flex items-center mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <span class="font-medium dark:text-white">{{ $order->cantidad }} {{ $order->cantidad > 1 ? 'Personas' : 'Persona' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">CÓDIGO DE ACCESO</h3>
                                            <div class="flex items-center justify-between">
                                                <div class="font-mono text-lg font-bold text-gray-800 dark:text-white tracking-wider">
                                                    #{{ strtoupper(substr(md5($order->id), 0, 8)) }}
                                                </div>
                                                <button class="text-teal-500 hover:text-teal-600 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex flex-wrap gap-3">
                                        <a href="{{ route('ticket.download', $order->id) }}"
                                            class="px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                Descargar
                                        </a>
                                        <button onclick="openHelpModal()" class="px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Ayuda
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Diseño normal para entradas PAGADAS (el mismo que antes) -->
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-500 rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-300"></div>
                        <div class="relative bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3 relative overflow-hidden">
                                    <img src="{{ $order->event->banner ? asset('storage/' . $order->event->banner) : asset('img/evento6.png') }}" 
                                         class="w-full h-48 md:h-full object-cover transform transition duration-500 group-hover:scale-105" />
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold text-white bg-pink-500">
                                            {{ $order->zona }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="md:w-2/3 p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $order->event->titulo }}</h2>
                                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300 mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($order->event->fecha)->isoFormat('D MMMM YYYY') }}
                                                <span class="mx-2">•</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($order->event->hora_inicio)->format('H:i') }}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block px-4 py-2 rounded-full text-lg font-bold text-white bg-gradient-to-r from-purple-500 to-pink-500">
                                                {{ number_format($order->total, 2) }} €
                                            </span>
                                        </div>
                                    </div>
        
                                
                                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">DETALLES DEL TICKET</h3>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                            <span class="font-medium dark:text-white">{{ $order->cantidad }} {{ $order->cantidad > 1 ? 'Entradas' : 'Entrada' }}</span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span class="font-medium dark:text-white">{{ $order->cantidad }} {{ $order->cantidad > 1 ? 'Personas' : 'Persona' }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">CÓDIGO DE ACCESO</h3>
                                        <div class="flex items-center justify-between">
                                            <div class="font-mono text-lg font-bold text-gray-800 dark:text-white tracking-wider">
                                                #{{ strtoupper(substr(md5($order->id), 0, 8)) }}
                                            </div>
                                            <button class="text-pink-500 hover:text-pink-600 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex flex-wrap gap-3">
                                    <a href="{{ route('ticket.download', $order->id) }}"
                                        class="px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Descargar
                                    </a>
                                    <button onclick="openHelpModal()" class="px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Ayuda
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endif
</div>

<script>
    // Funciones para manejar el modal de ayuda
    function openHelpModal() {
        document.getElementById('helpModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeHelpModal() {
        document.getElementById('helpModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Event listeners
    document.getElementById('closeHelpModal').addEventListener('click', closeHelpModal);
    
    // Cerrar modal al hacer clic fuera del contenido
    document.getElementById('helpModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeHelpModal();
        }
    });
    
    // Cerrar modal con tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('helpModal').classList.contains('hidden')) {
            closeHelpModal();
        }
    });
</script>
@endsection