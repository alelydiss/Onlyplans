@extends('layouts.app')

@section('content')
<section class="px-6 pb-10">
    <h2 class="text-2xl font-bold mb-6">Mis eventos favoritos</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($eventos as $evento)
            <div id="evento-card-{{ $evento->id }}" class="bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 group relative">
                <a href="{{ route('evento', $evento->id) }}">
                    <img
                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                        src="{{ $evento->banner ? asset('storage/' . $evento->banner) : asset('img/default-banner.jpg') }}"
                        alt="{{ $evento->titulo }}"
                    />
                </a>
                <button
                    id="favorito-btn-{{ $evento->id }}"
                    onclick="toggleFavorito({{ $evento->id }})"
                    data-evento-id="{{ $evento->id }}"
                    class="absolute top-3 right-3 p-2 bg-white dark:bg-gray-800 rounded-full shadow hover:scale-110 transition
                        {{ Auth::user() && Auth::user()->favoritos->contains('evento_id', $evento->id) ? 'text-purple-600' : 'text-gray-400' }}">
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
</section>
@endsection