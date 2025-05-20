@extends('layouts.app')

@section('content')
<div 
  x-data="{ open: false }" 
  x-cloak 
  class="flex flex-col md:flex-row min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 overflow-hidden"

>
  <!-- Mobile Sidebar Toggle -->
  <button 
    @click="open = true" 
    class="md:hidden flex items-center gap-2 p-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 transition hover:bg-gray-300 dark:hover:bg-gray-600"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
    {{ __('Menú') }}
  </button>

  <!-- Sidebar -->
  <aside 
    x-show="open || window.innerWidth >= 768"
    x-cloak
    @click.away="if (window.innerWidth < 768) open = false"
    x-transition:enter="transition transform ease-out duration-300"
    x-transition:enter-start="-translate-x-full opacity-0 scale-95"
    x-transition:enter-end="translate-x-0 opacity-100 scale-100"
    x-transition:leave="transition transform ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100 scale-100"
    x-transition:leave-end="-translate-x-full opacity-0 scale-95"
    class="fixed md:relative top-0 left-0 z-10 w-3/4 md:w-1/4 h-full md:h-auto bg-white dark:bg-gray-800 border-b md:border-r flex flex-col justify-between md:block shadow-2xl md:shadow-none"
  >
    <!-- Botón X móvil -->
    <div class="md:hidden flex justify-end p-4">
      <button @click="open = false" class="text-gray-600 dark:text-gray-300 hover:text-red-500 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Contenido del sidebar -->
    <div class="flex flex-col flex-grow overflow-hidden">
      <div class="flex-grow">
        <div class="p-6 font-bold text-lg">Ajustes de la Cuenta</div>
        <nav class="flex flex-col space-y-2 px-6">
          <a 
            href="{{ route('profile.edit', ['section' => 'info']) }}" 
            class="transition-all duration-200 ease-in-out hover:text-indigo-600 hover:underline {{ request('section') === 'info' ? 'font-semibold text-indigo-600 underline' : '' }}"
          >
            Info de la Cuenta
          </a>
          <a 
            href="{{ route('profile.edit', ['section' => 'password']) }}" 
            class="transition-all duration-200 ease-in-out hover:text-indigo-600 hover:underline {{ request('section') === 'password' ? 'font-semibold text-indigo-600 underline' : '' }}"
          >
            Cambiar Contraseña
          </a>
        </nav>
      </div>

      <!-- Eliminar -->
      <div class="px-6 py-4">
        <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <div class="max-w-sm">
            @include('profile.partials.delete-user-form')
          </div>
        </div>
      </div>
    </div>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-4 md:p-8 overflow-y-auto">
    <div 
      x-data="{ show: false }" 
      x-init="setTimeout(() => show = true, 50)" 
      x-show="show"
      x-transition:enter="transition duration-500 ease-out"
      x-transition:enter-start="opacity-0 translate-y-4"
      x-transition:enter-end="opacity-100 translate-y-0"
    >
      @if(request('section') === 'password')
        <h2 class="text-xl font-semibold mb-6">Cambiar Contraseña</h2>
        @include('profile.partials.update-password-form')
      @else
        <h2 class="text-xl font-semibold mb-6">Información de la Cuenta</h2>
        @include('profile.partials.update-profile-information-form')
      @endif
    </div>
  </main>
</div>
@endsection
