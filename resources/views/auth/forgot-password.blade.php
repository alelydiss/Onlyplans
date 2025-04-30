@extends('layouts.login')

@section('content')
<div class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-5xl flex flex-col md:flex-row shadow-lg rounded-xl overflow-hidden animate-fade-in">

    <!-- Panel izquierdo -->
    <div class="bg-[#1f1a38] dark:bg-gray-800 text-white w-full md:w-1/2 p-8 flex flex-col justify-center items-start space-y-4">
      <img src="/img/logo.png" alt="Logo" class="w-28 mb-2" />
      <h2 class="text-2xl font-bold">¿Olvidaste tu contraseña?</h2>
      <p class="text-sm">No hay problema. Te ayudamos a recuperar el acceso a tu cuenta de forma rápida y segura.</p>
    </div>

    <!-- Panel derecho -->
    <div class="w-full md:w-1/2 bg-white dark:bg-gray-900 p-8 text-gray-800 dark:text-gray-100 relative">

      <!-- Botón cerrar -->
      <a href="{{ route('welcome') }}" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-white text-2xl">
        &times;
      </a>

      <h2 class="text-2xl font-bold mb-4">Recuperar acceso</h2>

      <p class="mb-6 text-sm text-gray-600 dark:text-gray-400">
        Indícanos tu correo electrónico y te enviaremos un enlace para que puedas restablecer tu contraseña.
      </p>

      @if (session('status'))
      <div class="mb-4 text-green-600 dark:text-green-400 text-sm">
        {{ session('status') }}
      </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium">Correo Electrónico</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
            class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
          @error('email')
            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
          <button type="submit"
            class="bg-[#1f1a38] dark:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#2d255c] dark:hover:bg-purple-800 transition">
            Enviar enlace de recuperación
          </button>
        </div>
      </form>
    </div>
  </div>

  <style>
    @tailwind base;
    @tailwind components;
    @tailwind utilities;

    @layer utilities {
      .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
      }

      @keyframes fade-in {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    }
  </style>
</div>
@endsection
