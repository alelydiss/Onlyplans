<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">
    <title>Onlyplans</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>
<body class="antialiased dark:bg-gray-900">
    @include('layouts.navigation')

    <main>
        @yield('content')
        
      </main>
      <button id="toggle-dark"
        class="fixed bottom-4 right-4 w-14 h-14 bg-white dark:bg-gray-900 text-gray-700 dark:text-yellow-300 border border-gray-300 dark:border-gray-700 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 ease-in-out flex items-center justify-center text-2xl focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-700"
        aria-label="Cambiar tema">
        <span id="theme-icon" class="transition-transform duration-300 ease-in-out">🌙</span>
      </button>
      
      <!-- Footer -->
      @if (!request()->routeIs('profile.edit'))
      <footer class="bg-gray-100 dark:bg-gray-800 text-sm text-gray-600 dark:text-gray-400 px-4 md:px-6 py-10">
        <div class="max-w-5xl mx-auto text-center space-y-10">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- OnlyPlans -->
            <div>
              <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">OnlyPlans</h4>
              <p class="text-gray-600 dark:text-gray-400">Descubre eventos y actividades cerca de ti.</p>
            </div>
            
            <!-- Enlaces -->
            <div>
              <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Enlaces</h4>
              <ul class="space-y-1">
                <li><a href="{{ route('terms') }}" class="hover:text-indigo-600 hover:underline transition">Términos</a></li>
                <li><a href="{{ route('policy') }}" class="hover:text-indigo-600 hover:underline transition">Política de Privacidad</a></li>
              </ul>
            </div>
            
            <!-- Redes Sociales -->
            <div>
              <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Síguenos</h4>
              <div class="flex justify-center space-x-4">
                <a href="#" class="text-gray-500 hover:text-indigo-600 transition" aria-label="Twitter">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 19c7.5 0 11.6-6.2 11.6-11.6v-.5A8.3 8.3 0 0022 5.6a8.1 8.1 0 01-2.3.6 4.1 4.1 0 001.8-2.3 8.2 8.2 0 01-2.6 1A4.1 4.1 0 0016 4a4.1 4.1 0 00-4.1 4.1c0 .3 0 .6.1.9A11.6 11.6 0 014 5.1a4.1 4.1 0 001.3 5.5 4 4 0 01-1.8-.5v.1c0 2 1.4 3.6 3.2 4a4.3 4.3 0 01-1.8.1 4.1 4.1 0 003.8 2.8A8.3 8.3 0 014 18a11.6 11.6 0 006 1.8" /></svg>
                </a>
                <a href="#" class="text-gray-500 hover:text-pink-500 transition" aria-label="Instagram">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm0 2h10c1.6 0 3 1.4 3 3v10c0 1.6-1.4 3-3 3H7c-1.6 0-3-1.4-3-3V7c0-1.6 1.4-3 3-3zm5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm5.5-.5a1.5 1.5 0 11-3.001-.001A1.5 1.5 0 0117.5 6.5z" /></svg>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-600 transition" aria-label="Facebook">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.6 9.9v-7H8v-3h2.4V9c0-2.4 1.4-3.8 3.6-3.8 1 0 2 .2 2 .2v2.2h-1.1c-1.1 0-1.5.7-1.5 1.4v1.6H17l-.4 3h-2v7A10 10 0 0022 12z" /></svg>
                </a>
              </div>
            </div>
          </div>
          
          <hr class="border-gray-300 dark:border-gray-700">
          
          <div class="text-gray-500 text-xs">
            © {{ date('Y') }} <span class="font-medium">OnlyPlans</span>. Todos los derechos reservados.
          </div>
        </div>
      </footer>
      @endif
      
      @stack('scripts')

    </body>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('toggle-dark');
        const icon = document.getElementById('theme-icon');
        
        // Cambiar el tema
        button.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            // Guardar preferencia en localStorage
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                icon.textContent = '☀️'; // Día
            } else {
                localStorage.setItem('theme', 'light');
                icon.textContent = '🌙'; // Noche
            }

            // Animación simple al pulsar
            icon.classList.add('rotate-180');
            setTimeout(() => icon.classList.remove('rotate-180'), 300);
        });

        // Cargar preferencia previa
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
            icon.textContent = '☀️';
        }
    });
</script>

</html>
