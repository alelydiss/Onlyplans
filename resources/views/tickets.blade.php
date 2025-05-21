@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 min-h-screen">
    <h1 class="text-4xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-500">
        Mis Tickets
    </h1>

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
                                    <button class="px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        Reembolsar
                                    </button>
                                    <button class="px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center">
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
            @endforeach
        </div>
    @endif
</div>
@endsection