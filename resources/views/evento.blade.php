@extends('layouts.app')

@section('content')
<div 
    class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100"
    x-data="{
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
    }"
>
    {{-- Imagen principal --}}
    <div class="flex justify-center pt-6">
        <img src="{{ $evento->banner ? asset('storage/' . $evento->banner) : asset('img/evento6.png') }}" alt="{{ $evento->titulo }}" class="w-full max-w-5xl h-80 object-cover rounded-b-lg shadow-md" />
    </div>

    {{-- Contenido --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 space-y-10">

        {{-- Título + info básica --}}
        <div class="flex flex-col md:flex-row justify-between md:items-start space-y-6 md:space-y-0 md:space-x-6">
            <div class="flex-1 space-y-4">
                <h1 class="text-3xl font-bold">{{ $evento->titulo }}</h1>
                <div class="space-y-1 text-sm text-gray-600 dark:text-gray-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M8 7V3m8 4V3m-9 4h10M5 11h14M5 19h14M5 15h14M5 7h14" />
                        </svg>
                        {{ \Carbon\Carbon::parse($evento->fecha)->format('l, d F Y') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8v4l3 3" />
                        </svg>
                        {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') }}
                    </div>
                </div>
            </div>

            {{-- Botón Comprar y favorito --}}
            <div class="w-full md:w-auto flex flex-col items-end space-y-3">
                <button 
                    id="favorito-btn-{{ $evento->id }}"
                    onclick="toggleFavorito({{ $evento->id }})"
                    data-evento-id="{{ $evento->id }}"
                    class=" top-3 right-3 p-2 bg-white dark:bg-gray-800 rounded-full shadow hover:scale-110 transition {{ Auth::user() && Auth::user()->favoritos->contains('evento_id', $evento->id) ? 'text-purple-600' : 'text-gray-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </button>
                <button
                    @click="mostrarModal = true; paso = 1"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition w-full text-center"
                >
                    Comprar Ticket
                </button>
                @if($evento->tipo_evento === 'gratis')
                    <div class="text-gray-600 dark:text-gray-300 text-right">
                        Entrada: Gratis para todos
                    </div>
                @else
                    <div class="text-gray-600 dark:text-gray-300 text-right">
                        Entrada: {{ $evento->precio }} $ por entrada
                    </div>
                @endif
            </div>
        </div>

            <!-- Ubicación -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold">Ubicación</h2>
            <p class="text-gray-500">{{ $evento->ubicacion }}</p>
            <div id="map" class="w-full h-64 mt-2 rounded-xl"></div>
        </div>

        <!-- Creador -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold">Creado por:</h2>
            <div class="flex items-center gap-4 mt-2">
                <img src="{{ $evento->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($evento->user->name) }}" class="w-12 h-12 rounded-full">
                <span class="text-gray-700 font-medium">{{ $evento->user->name }}</span>
            </div>
        </div>

        <!-- Descripción -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold">Descripción del evento</h2>
            <div class="prose max-w-none mt-2">{!! nl2br(e($evento->descripcion)) !!}</div>
        </div>

        {{-- Chat en tiempo real --}}
        <div class="border rounded-lg p-4 space-y-4 bg-white dark:bg-gray-800">
            <h2 class="text-lg font-semibold">Chat en tiempo real</h2>
            <div id="chat-messages" class="space-y-2 max-h-48 overflow-y-auto"></div>
            <form id="chat-form" class="flex gap-2">
                <input type="text" id="chat-input" placeholder="Escribe un mensaje"
                    class="flex-1 p-2 border rounded-lg dark:bg-gray-700 dark:text-white">
                <button type="submit"
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Enviar</button>
            </form>
        </div>

        {{-- Eventos relacionados --}}
        {{-- <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Otros eventos que podrían gustarte</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($relacionados as $rel)
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
                    <img src="{{ asset('img/evento1.png') }}" alt="{{ $rel->titulo }}" class="w-full h-32 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $rel->titulo }}</h3>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($rel->fecha)->format('d M Y') }}</p>
                        <a href="{{ route('eventos.show', $rel->id) }}" class="text-purple-600 text-sm mt-2 inline-block">Ver más</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div> --}}

        {{-- Modal de compra --}}
        <div
            x-show="mostrarModal"
            class="fixed inset-0 top-0 left-0 w-screen h-screen z-10 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm mt-10"
            x-transition
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-xl w-full max-w-lg shadow-2xl relative overflow-hidden"
                @click.outside="mostrarModal = false"
            >
                <button
                    @click="mostrarModal = false"
                    class="absolute top-4 right-4 text-gray-500 hover:text-white text-xl"
                >×</button>

                <div class="p-6 space-y-6">
                    {{-- Paso 1 --}}
                    <div x-show="paso === 1" x-transition>
                        <h2 class="text-xl font-semibold">Seleccionar Ticket</h2>
                        <div class="flex justify-between items-center border rounded-lg p-4">
                            <div>
                                <p class="font-medium">Ticket</p>
                                <p class="text-sm text-gray-500">{{ $evento->precio }} €</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button @click="if (cantidad > 1) cantidad--" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-xl">−</button>
                                <span class="w-8 text-center" x-text="cantidad"></span>
                                <button @click="cantidad++" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-xl">+</button>
                            </div>
                        </div>
                        <div class="flex justify-between mt-4 text-sm">
                            <span>Cant: <strong x-text="cantidad"></strong></span>
                            <span>
                                Total: 
                                <strong 
                                    x-text="(cantidad * {{ $evento->precio }}) + ' €'">
                                </strong>
                            </span>
                        </div>
                        <button @click="paso = 2" class="mt-6 w-full py-3 rounded-lg bg-purple-600 text-white font-semibold hover:opacity-90">Siguiente →</button>
                    </div>

{{-- Paso 2 --}}
<div x-show="paso === 2" x-transition x-data="{
    errores: {
        nombre: '',
        correo: '',
        telefono: ''
    },
    validarCampo(campo) {
        this.errores[campo] = '';

        if (campo === 'nombre') {
            if (!/^[a-zA-ZÀ-ÿ\s]{3,50}$/.test(nombre)) {
                this.errores.nombre = 'El nombre debe tener solo letras y al menos 3 caracteres.';
            }
        }

        if (campo === 'correo') {
            const regexCorreo = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
            if (!regexCorreo.test(correo)) {
                this.errores.correo = 'Ingresa un correo electrónico válido.';
            }
        }

        if (campo === 'telefono') {
            if (!/^\d{7,15}$/.test(telefono)) {
                this.errores.telefono = 'El teléfono debe tener entre 7 y 15 números.';
            }
        }
    },
    validarTodo() {
        this.validarCampo('nombre');
        this.validarCampo('correo');
        this.validarCampo('telefono');
        return !this.errores.nombre && !this.errores.correo && !this.errores.telefono;
    }
}">
    <h2 class="text-xl font-semibold mb-4">Detalles del Comprador</h2>

    <!-- Nombre -->
    <input 
        type="text" 
        x-model="nombre" 
        @blur="validarCampo('nombre')" 
        placeholder="Nombre completo" 
        class="w-full p-3 mb-1 border rounded-lg" 
        required
    />
    <template x-if="errores.nombre">
        <p class="text-red-600 text-sm mb-2" x-text="errores.nombre"></p>
    </template>

    <!-- Correo -->
    <input 
        type="email" 
        x-model="correo" 
        @blur="validarCampo('correo')" 
        placeholder="Correo electrónico" 
        class="w-full p-3 mb-1 border rounded-lg" 
        required
    />
    <template x-if="errores.correo">
        <p class="text-red-600 text-sm mb-2" x-text="errores.correo"></p>
    </template>

    <!-- Teléfono -->
    <input 
        type="tel" 
        x-model="telefono" 
        @blur="validarCampo('telefono')"
        placeholder="Teléfono"loca
        class="w-full p-3 mb-1 border rounded-lg"
        required
    />
    <template x-if="errores.telefono">
        <p class="text-red-600 text-sm mb-2" x-text="errores.telefono"></p>
    </template>

    <div class="flex justify-between mt-6">
        <button @click="paso = 1" class="text-purple-600 hover:underline">← Atrás</button>

        <button 
            @click="
                if (validarTodo()) {
                    paso = 3;
                }
            " 
            class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:opacity-90"
        >
            Siguiente →
        </button>
    </div>
</div>


                    {{-- Paso 3 --}}
                    <div x-show="paso === 3" x-transition>
                        <h2 class="text-xl font-semibold">Seleccionar Asiento</h2>
                        <div class="grid grid-cols-2 gap-3">
                            <template x-for="zona in zonas" :key="zona.nombre">
                                <button
                                    :class="[
                                        'p-4 rounded-lg border text-center',
                                        asientoSeleccionado === zona.nombre ? 'border-purple-600 bg-purple-50 dark:bg-purple-800 text-purple-700 font-semibold' : 'bg-white dark:bg-gray-700 text-gray-700',
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
                            <button @click="paso = 4" class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:opacity-90">Siguiente →</button>
                        </div>
                    </div>

                    {{-- Paso 4 --}}
                    <div x-show="paso === 4" x-transition>
                        <h2 class="text-xl font-semibold">Resumen del pedido</h2>
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm space-y-2">
                            <p><strong>Nombre:</strong> <span x-text="nombre"></span></p>
                            <p><strong>Correo:</strong> <span x-text="correo"></span></p>
                            <p><strong>Teléfono:</strong> <span x-text="telefono"></span></p>
                            <p><strong>Cantidad:</strong> <span x-text="cantidad"></span></p>
                            <p><strong>Asiento:</strong> <span x-text="asientoSeleccionado"></span></p>
                            <p><strong>Total:</strong> <span x-text="cantidad * 600 + ' €'"></span></p>
                        </div>
                        <div class="flex justify-between mt-6">
                            <button @click="paso = 3" class="text-purple-600 hover:underline">← Atrás</button>
                            <button 
                                @click="
                                    fetch('{{ route('eventos.checkout', $evento->id) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            nombre,
                                            correo,
                                            telefono,
                                            cantidad,
                                            zona: asientoSeleccionado
                                        })
                                    })
                                    .then(r => r.json())
                                    .then(data => {
                                        const stripe = Stripe('{{ config('services.stripe.key') }}');
                                        stripe.redirectToCheckout({ sessionId: data.id });
                                    })
                                    .catch(() => alert('Error al procesar el pago'))
                                "
                                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition"
                            >
                                Procesar compra
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin Modal --}}
    </div>
</div>
{{-- Scripts de mapa y chat --}}
<script src="https://js.stripe.com/v3/"></script>

<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: { lat: {{ $evento->lat }}, lng: {{ $evento->lng }} },
        });

        new google.maps.Marker({
            position: { lat: {{ $evento->lat }}, lng: {{ $evento->lng }} },
            map,
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>

{{-- Script del chat --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    Echo.channel('evento.{{ $evento->id }}')
        .listen('MensajeEnviado', (e) => {
            const chat = document.getElementById("chat-messages");
            const div = document.createElement("div");
            div.textContent = ${e.user.name}: ${e.mensaje};
            chat.appendChild(div);
        });

    document.getElementById("chat-form").addEventListener("submit", function (e) {
        e.preventDefault();
        fetch("{{ route('eventos.chat', $evento->id) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                mensaje: document.getElementById("chat-input").value
            })
        });
        document.getElementById("chat-input").value = "";
    });
});
</script>
@endsection