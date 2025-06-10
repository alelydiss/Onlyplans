@extends('layouts.app')

@section('content')
  <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-sans antialiased">
    <!-- Banner Principal -->
    <div class="text-center bg-cover bg-center py-32 animate__animated animate__fadeInDown" style="background-image: url('img/banner1.png');">
      <h2 class="text-5xl font-bold text-white animate__animated animate__fadeInUp">Descubre planes increíbles en tu ciudad</h2>
      <p class="mt-6 text-xl text-white animate__animated animate__fadeInUp animate__delay-1s">Eventos, fiestas, ferias, talleres y mucho más</p>
      
      <!-- CTA Registro -->
      <div class="mt-8 animate__animated animate__fadeInUp animate__delay-2s">
        <p class="text-white mb-4">¿Quieres personalizar tu experiencia?</p>
        <div class="flex justify-center gap-4">
          <a href="{{ route('register') }}" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition shadow">
            Regístrate
          </a>
          <a href="{{ route('login') }}" class="border-2 border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-purple-600 transition">
            Inicia sesión
          </a>
        </div>
      </div>
    </div>

    <!-- Categorías -->
    <section class="px-4 md:px-6 py-8 md:py-10 w-full animate__animated animate__fadeInUp">
      <h3 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 text-left">Explora todas las <span class="text-purple-600">Categorías</span></h3>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
        @foreach($categorias as $categoria)
          <div class="text-center group cursor-pointer">
            <a href="{{ route('eventos', ['categorias[]' => $categoria->id]) }}">
              <div class="rounded-full w-16 h-16 md:w-20 md:h-20 mx-auto overflow-hidden bg-white shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:shadow-2xl group-hover:ring-4 group-hover:ring-purple-300 group-hover:rotate-6">
                <img src="{{ asset($categoria->foto) }}" alt="{{ $categoria->nombre }}" class="object-cover w-full h-full transition-all duration-300 group-hover:scale-110 group-hover:blur-[1px]" />
              </div>
              <p class="text-sm md:text-base mt-2 transition-colors duration-300 group-hover:text-purple-600 font-semibold">{{ $categoria->nombre }}</p>
            </a>
          </div>
        @endforeach
      </div>
    </section>

    <!-- Eventos Destacados -->
    <section class="px-6 pb-10 animate__animated animate__fadeInUp mt-5">
      <h3 class="text-2xl md:text-3xl font-bold mb-6 text-left">Eventos Destacados</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($eventos as $evento)
          <div class="bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 group relative animate__animated animate__zoomIn">
            <a href="{{ route('evento', $evento->id) }}">
              <img class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                src="{{ $evento->banner ? asset('storage/' . $evento->banner) : asset('img/default-banner.jpg') }}"
                alt="{{ $evento->titulo }}" />
            </a>
            
            <!-- Info de favoritos para usuarios no logueados -->
            <div class="absolute top-3 right-3 p-2 bg-white dark:bg-gray-800 rounded-full shadow">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
              </svg>
            </div>

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
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                  </svg>
                  <span>
                    {{ $evento->precio > 0 ? number_format($evento->precio, 2) . '€' : 'Gratis' }}
                  </span>
                </div>
                <div class="flex items-center gap-1 text-purple-600 dark:text-purple-300">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4c1.74 0 3.41 1.01 4.5 2.09C12.09 5.01 13.76 4 15.5 4 18 4 20 6 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                  </svg>
                  <span>{{ $evento->interesados ?? rand(10, 100) }} Interesados</span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8 text-center animate__animated animate__fadeInUp animate__delay-3s">
        <a href="{{ route('login') }}" class="px-6 py-2 border border-purple-600 text-purple-600 rounded-md hover:bg-purple-600 hover:text-white transition inline-block">Ver Más Eventos</a>
      </div>
    </section>

    <!-- Banner Beneficios Registro -->
    <section class="bg-purple-600 text-white px-6 py-12">
      <div class="max-w-5xl mx-auto text-center">
        <h3 class="text-2xl md:text-3xl font-bold mb-6">¿Por qué registrarte en OnlyPlans?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            <div class="p-4">
                <div class="bg-white text-purple-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 class="font-bold text-lg mb-2">Eventos personalizados</h4>
                <p class="text-sm">Recibe recomendaciones basadas en tus intereses y ubicación.</p>
            </div>
            <div class="p-4">
                <div class="bg-white text-purple-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 class="font-bold text-lg mb-2">Guarda tus favoritos</h4>
                <p class="text-sm">Marca los eventos que te interesan y accede fácilmente después.</p>
            </div>
            <div class="p-4">
                <div class="bg-white text-purple-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 class="font-bold text-lg mb-2">Notificaciones</h4>
                <p class="text-sm">Recibe alertas sobre nuevos eventos y cambios importantes.</p>
            </div>
        </div>
      </div>
    </section>

    <!-- Cómo Funciona -->
    <section class="px-6 py-12 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-5xl mx-auto">
        <h3 class="text-2xl md:text-3xl font-bold mb-12 text-center">¿Cómo funciona OnlyPlans?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-purple-100 dark:bg-purple-900 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-purple-600 dark:text-purple-300 font-bold text-xl">1</div>
                <h4 class="font-bold text-lg mb-2">Explora eventos</h4>
                <p class="text-gray-600 dark:text-gray-300">Busca entre miles de eventos en tu ciudad o categorías que te interesen.</p>
            </div>
            <div class="text-center">
                <div class="bg-purple-100 dark:bg-purple-900 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-purple-600 dark:text-purple-300 font-bold text-xl">2</div>
                <h4 class="font-bold text-lg mb-2">Regístrate</h4>
                <p class="text-gray-600 dark:text-gray-300">Crea una cuenta gratuita para personalizar tu experiencia.</p>
            </div>
            <div class="text-center">
                <div class="bg-purple-100 dark:bg-purple-900 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-purple-600 dark:text-purple-300 font-bold text-xl">3</div>
                <h4 class="font-bold text-lg mb-2">Disfruta</h4>
                <p class="text-gray-600 dark:text-gray-300">Recibe recomendaciones personalizadas y no te pierdas ningún plan.</p>
            </div>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="px-6 py-16 text-center bg-white dark:bg-gray-900">
      <h3 class="text-2xl md:text-3xl font-bold mb-6">¿Listo para descubrir tu próximo plan?</h3>
      <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
        <a href="{{ route('register') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-purple-700 transition shadow-lg">
          Crear Cuenta Gratis
        </a>
      </div>
    </section>
  </div>
@endsection