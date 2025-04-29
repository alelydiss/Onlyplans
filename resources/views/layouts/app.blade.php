<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Onlyplans</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="antialiased">
    @include('layouts.navigation')

    <main>
        @yield('content')
    </main>
    <button id="toggle-dark" class="fixed bottom-4 right-4 w-14 h-14 bg-white dark:bg-gray-800 text-gray-800 dark:text-white border border-gray-300 dark:border-gray-700 rounded-full shadow-xl hover:scale-105 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center text-xl">
        <span id="theme-icon" class="transition-transform duration-300">🌙</span>
    </button>
    
     <!-- Footer -->
  <footer class="bg-gray-100 dark:bg-gray-800 text-sm text-gray-600 dark:text-gray-400 px-4 md:px-6 py-8 md:py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
    <div>
      <h4 class="font-bold mb-2">OnlyPlans</h4>
      <p>Descubre eventos y actividades cerca de ti.</p>
    </div>
    <div>
      <h4 class="font-bold mb-2">Enlaces</h4>
      <ul>
      <li><a href="#" class="hover:underline">Términos</a></li>
      <li><a href="#" class="hover:underline">Política de Privacidad</a></li>
      </ul>
    </div>
    <div>
      <h4 class="font-bold mb-2">Síguenos</h4>
      <p>Twitter, Instagram, Facebook</p>
    </div>
    </div>
  </footer>
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
