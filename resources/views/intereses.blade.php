@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 dark:bg-gray-900">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">Personaliza tu experiencia</h1>
        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            Selecciona tus intereses para recibir recomendaciones perfectamente adaptadas a tus gustos
        </p>
    </div>

    <!-- Price Section -->
    <div class="mb-10 bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-5 flex items-center">
            <svg class="w-6 h-6 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Preferencia de Precio
        </h2>
        <div class="flex flex-wrap gap-3">
            <button class="interest-btn transform hover:scale-105 transition-transform" data-category="price" data-value="paid">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Eventos de Pago
            </button>
            <button class="interest-btn transform hover:scale-105 transition-transform" data-category="price" data-value="free">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Eventos Gratuitos
            </button>
        </div>
    </div>

    <!-- Date Section -->
    <div class="mb-10 bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-5 flex items-center">
            <svg class="w-6 h-6 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Preferencia de Fecha
        </h2>
        <div class="flex flex-wrap gap-3">
            <button class="interest-btn transform hover:scale-105 transition-transform" data-category="date" data-value="today">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
                Hoy
            </button>
            <button class="interest-btn transform hover:scale-105 transition-transform" data-category="date" data-value="tomorrow">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Mañana
            </button>
            <button class="interest-btn transform hover:scale-105 transition-transform" data-category="date" data-value="week">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Esta Semana
            </button>
            <button class="interest-btn transform hover:scale-105 transition-transform" data-category="date" data-value="weekend">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Fin de Semana
            </button>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="mb-12 bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-5 flex items-center">
            <svg class="w-6 h-6 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
            </svg>
            Categorías de Intrés
        </h2>
        <div class="flex flex-wrap gap-3">
            @foreach($categorias as $category)
                <button class="interest-btn transform hover:scale-105 transition-transform" data-category="category" data-value="{{ $category->slug }}">
                   <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                    {{ $category->nombre }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Save Button -->
    <div class="text-center">
        <button id="save-interests" class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 dark:from-indigo-700 dark:to-purple-700 dark:hover:from-indigo-800 dark:hover:to-purple-800">
            <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Guardar Preferencias
        </button>
    </div>
</div>
@endsection