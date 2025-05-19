@extends('layouts.app')

@section('content')
  <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-sans antialiased">
    <!-- Banner -->
    <div class="text-center bg-cover bg-center py-32 animate__animated animate__fadeInDown" style="background-image: url('img/banner1.png');">
      <h2 class="text-5xl font-bold text-white animate__animated animate__fadeInUp">Descubre planes increíbles cerca de ti</h2>
      <p class="mt-6 text-xl text-white animate__animated animate__fadeInUp animate__delay-1s">Eventos, fiestas, ferias, talleres y mucho más en tu ciudad</p>

      <!-- Buscador -->
      <div class="mt-8 flex justify-center">
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-xl flex flex-col sm:flex-row gap-4 w-full max-w-5xl">
            <input type="text" placeholder="Buscar evento, ciudad o categoría"
                class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500" />
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition font-medium shadow">
                Buscar
            </button>
        </div>
    </div>
    </div>

    <!-- Categorías -->
    <section class="px-4 md:px-6 py-8 md:py-10 w-full animate__animated animate__fadeInUp">
      <h3 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 text-left">Explora todas las <span class="text-purple-600">Categorías</span></h3>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
        @foreach($categorias as $categoria)
          <div class="text-center hover:scale-105 transition animate__animated animate__zoomIn">
              <img src="{{ asset($categoria->foto) }}" alt="{{ $categoria->nombre }}" class="rounded-full w-16 h-16 md:w-20 md:h-20 object-cover mx-auto" />
              <p class="text-sm md:text-base">{{ $categoria->nombre }}</p>
          </div>
        @endforeach
      </div>
    </section>

    <!-- Eventos Populares -->
    <section class="px-6 pb-10 animate__animated animate__fadeInUp">
      <h3 class="text-2xl md:text-3xl font-bold mb-6 text-left">Eventos Más Populares</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($eventos as $evento)
          <div class="bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 group relative animate__animated animate__zoomIn">
            <a href="{{ route('evento', $evento->id) }}">
              <img class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                src="{{ $evento->banner ? asset('storage/' . $evento->banner) : asset('img/default-banner.jpg') }}"
                alt="{{ $evento->titulo }}" />
            </a>
            <button 
              id="favorito-btn-{{ $evento->id }}"
              onclick="toggleFavorito({{ $evento->id }})"
              data-evento-id="{{ $evento->id }}"
              class="absolute top-3 right-3 p-2 bg-white dark:bg-gray-800 rounded-full shadow hover:scale-110 transition {{ Auth::user() && Auth::user()->favoritos->contains('evento_id', $evento->id) ? 'text-purple-600' : 'text-gray-400' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
              </svg>
            </button>

            <div class="p-4 relative">
              <span class="absolute -top-4 left-4 bg-purple-600 text-white text-xs font-semibold px-2 py-1 rounded">
                {{ $evento->category->nombre ?? 'Sin categoría' }}
              </span>
              <div class="flex items-center gap-4 mb-2">
                <div class="text-center text-purple-700 dark:text-purple-300 font-bold text-sm">
                  {{ strtoupper(\Carbon\Carbon::parse($evento->fecha_inicio)->format('M')) }}<br>
                  <span class="text-2xl leading-3">
                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d') }}
                  </span>
                </div>
                <div>
                  <h3 class="text-gray-900 dark:text-white text-base font-semibold truncate">{{ $evento->titulo }}</h3>
                  <p class="text-gray-600 dark:text-gray-300 text-sm truncate">{{ Str::limit($evento->descripcion, 60) }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') }}
                  </p>
                </div>
              </div>
              <div class="flex justify-between text-sm text-gray-700 dark:text-gray-200 pt-2">
                <div class="flex items-center gap-1">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 
                            6.48 2 12s4.48 10 10 10 10-4.48 
                            10-10S17.52 2 12 2zm0 18c-4.41 
                            0-8-3.59-8-8s3.59-8 8-8 8 3.59 
                            8 8-3.59 8-8 8z"/>
                  </svg>
                  <span>
                    {{ $evento->precio > 0 ? number_format($evento->precio, 2) . '€' : 'Gratis' }}
                  </span>
                </div>
                <div class="flex items-center gap-1 text-purple-600 dark:text-purple-300">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 
                            15.36 2 12.28 2 8.5 2 
                            6 4 4 6.5 4c1.74 0 3.41 1.01 4.5 
                            2.09C12.09 5.01 13.76 4 15.5 
                            4 18 4 20 6 20 8.5c0 3.78-3.4 
                            6.86-8.55 11.54L12 21.35z"/>
                  </svg>
                  <span>{{ $evento->interesados ?? rand(10, 100) }} Interesados</span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8 text-center animate__animated animate__fadeInUp animate__delay-3s">
        <a href="{{ route('eventosPersonalizados') }}" class="px-6 py-2 border border-purple-600 text-purple-600 rounded-md hover:bg-purple-600 hover:text-white transition inline-block">Ver Más</a>
      </div>
    </section>

    <!-- Banner Especial -->
    <section class="bg-cover bg-center text-white px-6 py-12 text-center animate__animated animate__fadeInUp" style="background-image: url('img/banner2.png');">
      <h3 class="text-xl font-bold mb-4">¡Eventos especialmente seleccionados para ti!</h3>
      <p class="mb-6 text-sm">Filtrados según tus intereses y ubicación. ¡No te los pierdas!</p>
      <a href="{{ route('login') }}" class="bg-purple-600 px-6 py-2 rounded-md hover:bg-purple-700 transition">
        Empieza ahora →
      </a>
    </section>

    <!-- Eventos Online -->
    <section class="px-6 py-10 animate__animated animate__fadeInUp">
      <h3 class="text-2xl md:text-3xl font-bold mb-6 text-left">Eventos Más Populares Online</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 group relative animate__animated animate__zoomIn">
          <a href="#">
            <img class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
              src="img/eventoOnline1.png" alt="Evento destacado" />
          </a>
          <button onclick="this.classList.toggle('text-purple-600')" 
            class="absolute top-3 right-3 p-2 bg-white dark:bg-gray-800 rounded-full shadow hover:scale-110 transition text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
              <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
            </svg>
          </button>
          <div class="p-4 relative">
            <span class="absolute -top-4 left-4 bg-purple-600 text-white text-xs font-semibold px-2 py-1 rounded">Educativo</span>
            <div class="flex items-center gap-4 mb-2">
              <div class="text-center text-purple-700 dark:text-purple-300 font-bold text-sm">
                MAY<br><span class="text-2xl leading-3">16</span>
              </div>
              <div>
                <h3 class="text-gray-900 dark:text-white text-base font-semibold">Webinar sobre Marketing Digital</h3>
                <p class="text-gray-600 dark:text-gray-300 text-sm truncate">Estrategias clave para mejorar tu presencia...</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">19:00 PM - 21:00 PM</p>
              </div>
            </div>
            <div class="flex justify-between text-sm text-gray-700 dark:text-gray-200 pt-2">
              <div class="flex items-center gap-1">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                  <path d="M12 2C6.48 2 2 
                           6.48 2 12s4.48 10 10 10 10-4.48 
                           10-10S17.52 2 12 2zm0 18c-4.41 
                           0-8-3.59-8-8s3.59-8 8-8 8 3.59 
                           8 8-3.59 8-8 8z"/>
                </svg>
                <span>20€</span>
              </div>
              <div class="flex items-center gap-1 text-purple-600 dark:text-purple-300">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 
                           15.36 2 12.28 2 8.5 2 
                           6 4 4 6.5 4c1.74 0 3.41 1.01 4.5 
                           2.09C12.09 5.01 13.76 4 15.5 
                           4 18 4 20 6 20 8.5c0 3.78-3.4 
                           6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span>75 Interesados</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6 md:mt-8 text-center">
    <button class="px-4 md:px-6 py-2 border border-purple-600 text-purple-600 rounded-md hover:bg-purple-600 hover:text-white transition">Ver Más</button>
    </div>
  </section>

  <!-- Banner Especial -->
  <section class="bg-cover bg-center text-white px-6 py-12 text-center" style="background-image: url('img/banner3.png');">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between relative z-10">
      
      <!-- Icono + Texto -->
      <div class="flex items-center text-left mb-8 md:mb-0">
        <div>
          <h3 class="text-2xl font-bold mb-2">Crea un evento con OnlyPlans</h3>
          <p class="text-sm max-w-md">¿Tienes un espectáculo, evento, actividad o una gran experiencia? Colabora con nosotros y regístrate en Eventify.</p>
        </div>
      </div>
  
      <!-- Botón -->
      <a href="{{ route('crearEvento') }}" class="inline-flex items-center bg-white text-purple-700 font-semibold px-5 py-3 rounded-md shadow-md hover:bg-gray-100 transition">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zM18 9H2v7a2 2 0 002 2h12a2 2 0 002-2V9z"/>
        </svg>
        Crear Evento
      </a>
    </div>
  </section>
</div>
@endsection
