<!-- resources/views/evento.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puro Latino 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Imagen Principal -->
    <div class="w-full">
        <img src="{{ asset('images/tu_imagen.jpg') }}" alt="Puro Latino 2025" class="w-full h-80 object-cover">
    </div>

    <div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow mt-4">
        <!-- Título y Botón -->
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold">Puro Latino 2025</h1>
            <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                Comprar Ticket
            </a>
        </div>

        <!-- Fecha y Hora -->
        <div class="mt-4 flex items-center text-gray-600 space-x-6">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 11h14M5 19h14M5 15h14M5 7h14"></path>
                </svg>
                <span>Sábado, 1 Agosto 2025</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                </svg>
                <span>6:00 PM - 3:00 AM</span>
            </div>
        </div>

        <!-- Ubicación -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-2">Ubicación</h2>
            <iframe class="w-full h-64 rounded" src="https://maps.google.com/maps?q=Recinto%20Ferial%20La%20Rinconada&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen loading="lazy"></iframe>
        </div>

        <!-- Creador -->
        <div class="mt-8 flex items-center space-x-4">
            <img src="{{ asset('images/creador_placeholder.jpg') }}" alt="Creador" class="w-12 h-12 rounded-full">
            <div>
                <p class="font-semibold">Puro Latino Festival</p>
            </div>
        </div>

        <!-- Descripción -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-2">Descripción del evento</h2>
            <p class="text-gray-700 leading-relaxed">
                Puro Latino es un evento musical que se celebra en verano en el sur de España. Su nombre lo indica: danza y cultura en ambiente latino, reggaetón y urbano...
            </p>

            <ul class="list-disc list-inside text-gray-700 mt-4 space-y-2">
                <li>Un line-up de lujo con artistas internacionales.</li>
                <li>Una atmósfera vibrante llena de energía latina.</li>
                <li>Una producción espectacular con sonido e iluminación de alta calidad.</li>
            </ul>
        </div>

        <!-- Chat -->
        <div class="mt-10 bg-gray-100 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Chat</h3>
            <form class="space-y-4">
                <div class="flex items-center space-x-2">
                    <input type="text" name="message" class="flex-1 p-2 border border-gray-300 rounded" placeholder="Escribe tu mensaje...">
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Enviar</button>
                </div>
            </form>
        </div>

        <!-- Otros eventos -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-6">Otros Eventos que Podrían Gustarte</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ([
                    ['titulo' => 'Río de Janeiro en Playa', 'fecha' => '25 jul - Playa de Copacabana'],
                    ['titulo' => 'Rutas de Río al Surf', 'fecha' => '27 jul - Río de Janeiro'],
                    ['titulo' => 'Mercado de Artesanía Local', 'fecha' => '5 ago - Río de Janeiro']
                ] as $evento)
                <div class="bg-white rounded-lg shadow p-4">
                    <img src="https://via.placeholder.com/400x200" class="rounded mb-2" alt="{{ $evento['titulo'] }}">
                    <h3 class="font-semibold">{{ $evento['titulo'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $evento['fecha'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="mt-12 p-6 text-center text-gray-500 text-sm">
        © {{ date('Y') }} OnlyPlans. Todos los derechos reservados.
    </footer>

</body>
</html>
