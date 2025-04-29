<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Onlyplans - Registrarse</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>
<body class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-5xl flex flex-col md:flex-row shadow-lg rounded-xl overflow-hidden animate-fade-in">

    <!-- Panel izquierdo -->
    <div class="bg-[#1f1a38] dark:bg-gray-800 text-white w-full md:w-1/2 p-8 flex flex-col justify-center items-start space-y-4">
      <img src="/img/logo.png" alt="Logo" class="w-28 mb-2" />
      <h2 class="text-2xl font-bold">Descubre eventos a tu medida.</h2>
      <p class="text-sm">¡Regístrate hoy mismo para recibir recomendaciones personalizadas!</p>
    </div>

    <!-- Panel derecho -->
    <div class="w-full md:w-1/2 bg-white dark:bg-gray-900 p-8 text-gray-800 dark:text-gray-100 relative">
      <!-- Botón cerrar -->
      <a href="{{ route('welcome') }}" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-white text-2xl">
        &times;
      </a>

      <h2 class="text-2xl font-bold mb-6">Crear Cuenta</h2>

      <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center gap-2 border border-gray-300 dark:border-gray-600 rounded-lg py-2 mb-6 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
        <i class="bi bi-google"></i>
        Registrate con Google
      </a>

      <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nombre -->
        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Nombre completo" required
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- Email -->
        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Correo" required
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- Password -->
        <div class="relative">
          <input id="password" type="password" name="password" placeholder="Contraseña" required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
          <button type="button" onclick="togglePassword('password', 'eye1')" class="absolute right-3 top-2/4 transform -translate-y-1/2 text-gray-500 dark:text-gray-400">
            <i id="eye1" class="bi bi-eye-slash"></i>
          </button>
        </div>
        @error('password')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- Confirmar contraseña -->
        <div class="relative">
          <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
          <button type="button" onclick="togglePassword('password_confirmation', 'eye2')" class="absolute right-3 top-2/4 transform -translate-y-1/2 text-gray-500 dark:text-gray-400">
            <i id="eye2" class="bi bi-eye-slash"></i>
          </button>
        </div>

        <!-- Botón registrar -->
        <button type="submit"
          class="w-full bg-[#1f1a38] dark:bg-purple-700 text-white font-semibold py-2 rounded-lg hover:bg-[#2d255c] dark:hover:bg-purple-800 transition">
          Crear Cuenta
        </button>
      </form>

      <!-- Link a login -->
      <div class="mt-4 text-center text-sm">
        ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:underline">Inicia sesión</a>
      </div>
    </div>
  </div>

  <script>
    function togglePassword(id, eyeId) {
      const input = document.getElementById(id);
      const icon = document.getElementById(eyeId);
      if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
      } else {
        input.type = "password";
        icon.classList.replace("bi-eye", "bi-eye-slash");
      }
    }
  </script>

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
</body>
</html>
