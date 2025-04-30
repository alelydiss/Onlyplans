@extends('layouts.login')

@section('content')
<div class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-5xl flex flex-col md:flex-row shadow-lg rounded-xl overflow-hidden animate-fade-in">

    <!-- Panel izquierdo -->
    <div class="bg-[#1f1a38] dark:bg-gray-800 text-white w-full md:w-1/2 p-8 flex flex-col justify-center items-start space-y-4">
      <img src="/img/logo.png" alt="Logo" class="w-28 mb-2" />
      <h2 class="text-2xl font-bold">¿Olvidaste tu contraseña?</h2>
      <p class="text-sm">No te preocupes, todos olvidamos cosas a veces. Restablécela en un instante.</p>
    </div>

    <!-- Panel derecho -->
    <div class="w-full md:w-1/2 bg-white dark:bg-gray-900 p-8 text-gray-800 dark:text-gray-100 relative">
      
      <!-- Botón cerrar -->
      <a href="{{ route('welcome') }}" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-white text-2xl">
        &times;
      </a>

      <h2 class="text-2xl font-bold mb-4">Restablecer Contraseña</h2>
      <p class="mb-6 text-sm text-gray-600 dark:text-gray-400">
        Introduce tu nueva contraseña y confírmala a continuación.
      </p>

      <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium">Correo Electrónico</label>
          <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
            class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
          @error('email')
            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Contraseña -->
        <div>
          <label for="password" class="block text-sm font-medium">Nueva Contraseña</label>
          <div class="relative">
            <input id="password" type="password" name="password" required autocomplete="new-password"
              class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
            <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3 top-2/4 transform -translate-y-1/2 text-gray-500 dark:text-gray-400">
              <i id="eyeIcon1" class="bi bi-eye-slash"></i>
            </button>
          </div>
          @error('password')
            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium">Confirmar Contraseña</label>
          <div class="relative">
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
              class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
            <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute right-3 top-2/4 transform -translate-y-1/2 text-gray-500 dark:text-gray-400">
              <i id="eyeIcon2" class="bi bi-eye-slash"></i>
            </button>
          </div>
          @error('password_confirmation')
            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
          <button type="submit"
            class="bg-[#1f1a38] dark:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#2d255c] dark:hover:bg-purple-800 transition">
            Restablecer Contraseña
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Mostrar/Ocultar contraseña -->
  <script>
    function togglePassword(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
      } else {
        input.type = "password";
        icon.classList.replace("bi-eye", "bi-eye-slash");
      }
    }
  </script>

  <!-- Estilos -->
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
