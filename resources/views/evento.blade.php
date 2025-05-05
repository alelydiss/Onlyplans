@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- Imagen Principal -->
    <div class="flex justify-center pt-6 bg-gray-50 dark:bg-gray-900">
        <img src="{{ asset('img/evento6.png') }}" alt="Puro Latino 2025"
             class="w-full max-w-5xl h-80 object-cover rounded-b-lg shadow-md" />
    </div>

    <!-- Contenedor principal -->
    <div class="max-w-5xl mx-auto px-6 py-10 space-y-10">
         <!-- Resto del contenido... -->


        <!-- Cabecera: Título + Acciones -->
        <div class="flex flex-col md:flex-row justify-between md:items-start space-y-6 md:space-y-0 md:space-x-6">
            
            <!-- Columna Izquierda: Título + Fecha/Hora -->
            <div class="flex-1 space-y-4">
                <!-- Título -->
                <h1 class="text-3xl font-bold">Puro Latino 2025</h1>

                <!-- Fecha -->
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 4h10M5 11h14M5 19h14M5 15h14M5 7h14"/>
                        </svg>
                        <span>Sábado, 16 Agosto 2025</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3"/>
                        </svg>
                        <span>6:00 PM - 3:00 AM</span>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Estrella + Botón + Info -->
            <div class="w-full md:w-auto flex flex-col items-end space-y-3 text-sm" x-data="{ favorite: false }">
                <!-- Estrella -->
                <button @click="favorite = !favorite" :class="{ 'text-yellow-400': favorite }"
                        class="text-gray-400 hover:text-yellow-400 transition transform hover:scale-110">
                    <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </button>

                <!-- Botón Comprar -->
                <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition w-full text-center">
                    Comprar Ticket
                </a>

                <!-- Información -->
                <div class="text-gray-600 dark:text-gray-300 text-right">
                    Entrada: 75€ por entrada
                </div>
            </div>
        </div>

        <!-- Ubicación -->
        <div class="space-y-2">
            <h2 class="text-xl font-semibold">Ubicación</h2>
            <p class="text-gray-700 dark:text-gray-300 flex items-center space-x-1">
                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a2 2 0 002.828 0l4.243-4.243a2 2 0 000-2.828z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Recinto Ferial Las Banderas</span>
            </p>
            <iframe class="w-full h-64 rounded" src="https://maps.google.com/maps?q=Recinto%20Ferial%20La%20Rinconada&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen loading="lazy"></iframe>
        </div>

        <!-- Creador -->
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/purologo.png') }}" alt="Creador" class="w-12 h-12 rounded-full">
            <div>
                <p class="font-semibold">Puro Latino Festival</p>
            </div>
        </div>

        <!-- Descripción -->
        <div>
            <h2 class="text-xl font-semibold mb-2">Descripción del evento</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                Puro Latino es una experiencia vibrante que captura la esencia del espíritu latino. Aclamando música, danza, cultura y una atmósfera energética sin igual.
            </p>

            <h3 class="mt-4 font-semibold">3 Razones para asistir a Puro Latino:</h3>
            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mt-2 space-y-1">
                <li>Line-Up de artistas internacionales de renombre.</li>
                <li>Una experiencia cultural con gastronomía, arte y música.</li>
                <li>Ambiente veraniego, vibrante y seguro.</li>
            </ul>

            <p class="mt-4 text-gray-700 dark:text-gray-300">
                Este evento es ideal para quienes buscan disfrutar una noche llena de energía, ritmos caribeños y la calidez de la cultura latina.
            </p>
        </div>

        <!-- Chat -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Chat</h3>
            <form id="chat-form" class="space-y-4">
                <div class="flex items-center space-x-2">
                    <input id="chat-input" type="text" name="message" class="flex-1 p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Escribe tu mensaje...">
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">Enviar</button>
                </div>
            </form>
            <!-- Aquí se insertarán los mensajes recibidos -->
            <div id="chat-messages" class="mt-4 space-y-2"></div>
        </div>

        <!-- Otros Eventos -->
        <div class="mb-20">
            <h2 class="text-2xl font-semibold mb-6">Otros Eventos que Podrían Gustarte</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ([ /* datos omitidos */ ] as $evento)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 hover:shadow-lg transition duration-300">
                    <img src="{{ asset('img/evento-placeholder.jpg') }}" class="rounded mb-2" alt="{{ $evento['titulo'] }}">
                    <h3 class="font-semibold">{{ $evento['titulo'] }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $evento['fecha'] }} - {{ $evento['ubicacion'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('chat-form');
    const input = document.getElementById('chat-input');
    const messagesContainer = document.getElementById('chat-messages');

    if (!form || !input || !messagesContainer) {
        console.error("No se encontró el formulario, input o contenedor de mensajes.");
        return;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const message = input.value.trim();
        if (!message) return;

        try {
            await fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ message }),
            });

            input.value = '';
        } catch (error) {
            console.error('Error enviando mensaje:', error);
        }
    });

    if (typeof Echo !== 'undefined') {
        Echo.channel('chat')
            .listen('.message.sent', (e) => {
                const div = document.createElement('div');
                div.textContent = e.message;
                div.className = "p-2 bg-white dark:bg-gray-700 rounded text-sm shadow";
                messagesContainer.appendChild(div);
            });
    } else {
        console.warn('Echo no está disponible. Asegúrate de incluir app.js y configurarlo con Laravel Echo.');
    }
});
</script>
@endsection
