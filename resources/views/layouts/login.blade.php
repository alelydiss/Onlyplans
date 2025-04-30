<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">
    <title>Onlyplans</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>
<body class="antialiased">
    <main>
        @yield('content')
    </main>
    <button id="toggle-dark" class="fixed bottom-4 right-4 w-14 h-14 bg-white dark:bg-gray-800 text-gray-800 dark:text-white border border-gray-300 dark:border-gray-700 rounded-full shadow-xl hover:scale-105 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center text-xl">
        <span id="theme-icon" class="transition-transform duration-300">🌙</span>
    </button>
      
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
