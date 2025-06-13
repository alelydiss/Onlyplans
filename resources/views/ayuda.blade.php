@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
    <!-- Hero Section -->
    <div class="text-center mb-16 md:mb-24">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-400 dark:to-indigo-400">
                Guía de OnlyPlans
            </span>
        </h1>
        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
            Descubre cómo sacar el máximo partido a nuestra plataforma de eventos con esta sencilla guía paso a paso.
        </p>
    </div>

    <!-- Steps with Icons -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        <!-- Step 1 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">1. Registro y acceso</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Crea tu cuenta con email o mediante Google. Una vez registrado, inicia sesión para acceder a todos los eventos disponibles.
                </p>
            </div>
            <div class="px-6 pb-5">
                <a href="{{ url('/register') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 font-medium hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors">
                    Ir al registro
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">2. Explora eventos</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Navega por categorías o usa nuestro mapa interactivo para descubrir planes cerca de ti. Filtra por tipo, fecha o precio.
                </p>
            </div>
            <div class="px-6 pb-5">
                <a href="{{ url('/eventos') }}" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-800 dark:hover:text-green-300 transition-colors">
                    Ver eventos disponibles
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="w-14 h-14 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">3. Guarda favoritos</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Marca con ♥ los eventos que te interesen. Podrás acceder a ellos fácilmente desde tu sección de favoritos.
                </p>
            </div>
            <div class="px-6 pb-5">
                <a href="{{ url('/favoritos') }}" class="inline-flex items-center text-yellow-600 dark:text-yellow-400 font-medium hover:text-yellow-800 dark:hover:text-yellow-300 transition-colors">
                    Ver mis favoritos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">4. Compra tickets</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Selecciona tus entradas y completa el pago de forma segura. Recibirás tus tickets por email y podrás descargarlos en PDF.
                </p>
            </div>
            <div class="px-6 pb-5">
                <a href="{{ url('/mis-tickets') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 font-medium hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                    Mis tickets
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">5. Crea eventos</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    ¿Eres organizador? Publica tus propios eventos. Tras la validación, estarán disponibles para todos los usuarios.
                </p>
            </div>
            <div class="px-6 pb-5">
                <a href="{{ url('/crearEvento') }}" class="inline-flex items-center text-purple-600 dark:text-purple-400 font-medium hover:text-purple-800 dark:hover:text-purple-300 transition-colors">
                    Crear evento
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Step 6 -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="w-14 h-14 bg-pink-100 dark:bg-pink-900 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600 dark:text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">6. Gestiona tu perfil</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Actualiza tus datos, cambia tu contraseña o revisa tu historial de eventos desde la sección de perfil.
                </p>
            </div>
            <div class="px-6 pb-5">
                <a href="{{ url('/profile') }}" class="inline-flex items-center text-pink-600 dark:text-pink-400 font-medium hover:text-pink-800 dark:hover:text-pink-300 transition-colors">
                    Mi perfil
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Additional Help Section -->
    <div class="bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/40 dark:to-purple-900/40 rounded-xl p-8 md:p-10 text-center">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-4">¿Necesitas más ayuda?</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                Nuestro equipo de soporte está disponible para resolver cualquier duda que tengas sobre el uso de OnlyPlans.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=onlyplans@gmail.com" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-5 py-3 rounded-lg font-medium transition-colors">
                    Contactar por Gmail
                </a>
                <a href="tel:+34911223344" class="inline-flex items-center justify-center bg-purple-600 hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-600 text-white px-5 py-3 rounded-lg font-medium transition-colors">
                    Contactar por Teléfono: +34 911 223 344
                </a>
            </div>
        </div>
    </div>
</div>
@endsection