<div class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-3xl shadow-lg rounded-xl overflow-hidden animate-fade-in bg-white dark:bg-gray-900 p-8 text-gray-800 dark:text-gray-100 relative">

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

      <!-- Token oculto -->
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
        <input id="password" type="password" name="password" required autocomplete="new-password"
          class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
        @error('password')
          <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <!-- Confirmar contraseña -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium">Confirmar Contraseña</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
          class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
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
