@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100" x-data="{
    mostrarModal: false,
    paso: 1,
    cantidad: 1,
    nombre: '',
    correo: '',
    telefono: '',
    asientoSeleccionado: null,
    zonas: [
      { nombre: 'VIP', disponible: true },
      { nombre: 'Pista', disponible: true },
      { nombre: 'Grada Central', disponible: false },
      { nombre: 'Palco', disponible: true }
    ]
  }" >

    <!-- Imagen Principal -->
    <div class="flex justify-center pt-6 bg-gray-50 dark:bg-gray-900">
        <img src="{{ asset('img/evento6.png') }}" alt="Puro Latino 2025"
             class="w-full max-w-5xl h-80 object-cover rounded-b-lg shadow-md" />
    </div>

    <!-- Contenedor principal -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 space-y-10">

        <!-- Cabecera: Título + Acciones -->
        <div class="flex flex-col md:flex-row justify-between md:items-start space-y-6 md:space-y-0 md:space-x-6">
            <!-- Columna Izquierda -->
            <div class="flex-1 space-y-4">
                <h1 class="text-3xl font-bold leading-tight">Puro Latino 2025</h1>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 11h14M5 19h14M5 15h14M5 7h14"/></svg>
                        <span>Sábado, 16 Agosto 2025</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>
                        <span>6:00 PM - 3:00 AM</span>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha -->
            <div class="w-full md:w-auto flex flex-col items-end space-y-3 text-sm">
                <!-- Icono de favorito -->
                <button onclick="this.classList.toggle('text-purple-600')" class=" top-3 right-3 p-2 hover:scale-110 transition text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </button>

                <!-- Botón para abrir el modal -->
                <button @click="mostrarModal = true; paso = 1"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition w-full text-center">
                    Comprar Ticket
                </button>

                <!-- Info de precio -->
                <div class="text-gray-600 dark:text-gray-300 text-right">
                    Entrada: 600€ por entrada
                </div>
            </div>
        </div>

        <!-- Modal de Compra -->
        <div x-show="mostrarModal" 
  class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
  x-transition
>
  <!-- Modal -->
  <div class="bg-white dark:bg-gray-800 rounded-xl w-full max-w-lg shadow-2xl relative overflow-hidden" @click.outside="mostrarModal = false">
    
    <!-- Botón de cierre -->
    <button @click="mostrarModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 dark:hover:text-white text-xl">×</button>
    
    <!-- Contenido -->
    <div class="p-6 space-y-6">

      <!-- Paso 1: Selección de ticket -->
      <div x-show="paso === 1" x-transition>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Seleccionar Ticket</h2>
        
        <div class="flex justify-between items-center border rounded-lg p-4">
          <div>
            <p class="font-medium text-gray-700 dark:text-gray-200">Ticket</p>
            <p class="text-sm text-gray-500">600,00 €</p>
          </div>
          <div class="flex items-center space-x-2">
            <button @click="if (cantidad > 1) cantidad--" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-xl">−</button>
            <span class="w-8 text-center" x-text="cantidad"></span>
            <button @click="cantidad++" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-xl">+</button>
          </div>
        </div>

        <div class="flex justify-between mt-4 text-sm text-gray-700 dark:text-gray-200">
          <span>Cant: <strong x-text="cantidad"></strong></span>
          <span>Total: <strong x-text="cantidad * 600 + ' €'"></strong></span>
        </div>

        <button @click="paso = 2" class="mt-6 w-full py-3 rounded-lg bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold hover:opacity-90 transition">Siguiente →</button>
      </div>

      <!-- Paso 2: Datos del comprador -->
      <div x-show="paso === 2" x-transition>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Detalles del Comprador</h2>
        
        <input type="text" x-model="nombre" placeholder="Nombre completo" class="w-full p-3 mb-3 border rounded-lg" />
        <input type="email" x-model="correo" placeholder="Correo electrónico" class="w-full p-3 mb-3 border rounded-lg" />
        <input type="tel" x-model="telefono" placeholder="Teléfono" class="w-full p-3 mb-3 border rounded-lg" />

        <p class="text-xs text-gray-500 mt-2">Al continuar, aceptas nuestros <a href="#" class="underline">Términos</a> y <a href="#" class="underline">Política de Privacidad</a>.</p>

        <div class="flex justify-between mt-6">
          <button @click="paso = 1" class="text-purple-600 hover:underline">← Atrás</button>
          <button @click="paso = 3" class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-5 py-2 rounded-lg hover:opacity-90 transition">Siguiente →</button>
        </div>
      </div>

      <!-- Paso 3: Selección de asiento -->
      <div x-show="paso === 3" x-transition>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Seleccionar Asiento</h2>
        
        <div class="grid grid-cols-2 gap-3">
          <template x-for="zona in zonas" :key="zona.nombre">
            <button 
              :class="[
                'p-4 rounded-lg border text-center transition',
                asientoSeleccionado === zona.nombre ? 'border-purple-600 bg-purple-50 dark:bg-purple-800 text-purple-700 dark:text-white font-semibold' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300',
                !zona.disponible && 'opacity-40 cursor-not-allowed'
              ]"
              :disabled="!zona.disponible"
              @click="asientoSeleccionado = zona.nombre"
              x-text="zona.nombre"
            ></button>
          </template>
        </div>

        <div class="flex justify-between mt-6">
          <button @click="paso = 2" class="text-purple-600 hover:underline">← Atrás</button>
          <button @click="paso = 4" class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-5 py-2 rounded-lg hover:opacity-90 transition">Siguiente →</button>
        </div>
      </div>

      <!-- Paso 4: Resumen -->
      <div x-show="paso === 4" x-transition>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Resumen del pedido</h2>

        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm space-y-2">
          <p><strong>Nombre:</strong> <span x-text="nombre"></span></p>
          <p><strong>Correo:</strong> <span x-text="correo"></span></p>
          <p><strong>Teléfono:</strong> <span x-text="telefono"></span></p>
          <p><strong>Asiento:</strong> <span x-text="asientoSeleccionado || 'No seleccionado'"></span></p>
          <p><strong>Cantidad:</strong> <span x-text="cantidad"></span></p>
          <p><strong>Total:</strong> <span x-text="cantidad * 600 + ' €'"></span></p>
        </div>

        <button class="mt-6 w-full py-3 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 transition">💳 Pagar Ahora</button>
      </div>
    </div>
  </div>
</div>


        <!-- Ubicación -->
        <div class="space-y-2">
            <h2 class="text-xl font-semibold">Ubicación</h2>
            <p class="text-gray-700 dark:text-gray-300 flex items-center space-x-1">
                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a2 2 0 002.828 0l4.243-4.243a2 2 0 000-2.828z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Recinto Ferial Las Banderas</span>
            </p>
            <iframe class="w-full h-64 rounded" src="https://maps.google.com/maps?q=Recinto%20Ferial%20La%20Rinconada&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen loading="lazy"></iframe>
        </div>

        <!-- Creador -->
        <div class="flex items-center space-x-4">
            <img src="{{ asset('img/purologo.png') }}" alt="Creador" class="w-12 h-12 rounded-full">
            <div><p class="font-semibold">Puro Latino Festival</p></div>
        </div>

        <!-- Descripción -->
        <div>
            <h2 class="text-xl font-semibold mb-2">Descripción del evento</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                Puro Latino es una experiencia vibrante que captura la esencia del espíritu latino...
            </p>
            <h3 class="mt-4 font-semibold">3 Razones para asistir a Puro Latino:</h3>
            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mt-2 space-y-1">
                <li>Line-Up de artistas internacionales de renombre.</li>
                <li>Una experiencia cultural con gastronomía, arte y música.</li>
                <li>Ambiente veraniego, vibrante y seguro.</li>
            </ul>
            <p class="mt-4 text-gray-700 dark:text-gray-300">Este evento es ideal para quienes buscan disfrutar una noche llena de energía...</p>
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
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

const chatForm = document.getElementById('chat-form');
const chatInput = document.getElementById('chat-input');
const chatMessages = document.getElementById('chat-messages');

chatForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = chatInput.value.trim();
    if (!message) return;

    // Mostrar inmediatamente en tu chat
    appendMessage('Tú', message);

    try {
        await fetch('/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ content: message }),

        });
        chatInput.value = '';
    } catch (err) {
        console.error('Error al enviar:', err);
    }
});

// Escuchar mensajes nuevos desde el canal
window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        appendMessage(e.user.name, e.message);
    });

function appendMessage(user, message) {
    const div = document.createElement('div');
    div.className = "p-2 bg-purple-100 dark:bg-purple-800 rounded text-sm shadow";
    div.textContent = `${user}: ${message}`;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

</script>
@endsection
