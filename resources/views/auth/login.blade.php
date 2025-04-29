<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Onlyplans - Iniciar Sesión</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>
<body class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-5xl flex flex-col md:flex-row shadow-lg rounded-xl overflow-hidden animate-fade-in">

    <!-- Panel izquierdo (arriba en móvil) -->
    <div class="bg-[#1f1a38] dark:bg-gray-800 text-white w-full md:w-1/2 p-8 flex flex-col justify-center items-start space-y-4">
      <img src="/img/logo.png" alt="Logo" class="w-28 mb-2" /> <!-- Cambia esto si tienes otro logo -->
      <h2 class="text-2xl font-bold">Descubre eventos a tu medida.</h2>
      <p class="text-sm">¡Regístrate hoy mismo para recibir recomendaciones personalizadas!</p>
    </div>

    <!-- Panel derecho (abajo en móvil) -->
    <div class="w-full md:w-1/2 bg-white dark:bg-gray-900 p-8 text-gray-800 dark:text-gray-100 relative">
      <!-- Botón cerrar -->
      <a href="{{ route('welcome') }}" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 dark:hover:text-white text-2xl">
        &times;
      </a>

      <h2 class="text-2xl font-bold mb-6">Iniciar Sesión</h2>

      <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center gap-2 border border-gray-300 dark:border-gray-600 rounded-lg py-2 mb-6 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
        <i class="bi bi-google"></i>
        Iniciar sesión con Google
      </a>

      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <input id="email" type="email" name="email" placeholder="Correo" required
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />

        <!-- Password -->
        <div class="relative">
          <input id="password" type="password" name="password" placeholder="Contraseña" required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-purple-500 dark:text-white placeholder-gray-500" />
          <button type="button" onclick="togglePassword()" class="absolute right-3 top-2/4 transform -translate-y-1/2 text-gray-500 dark:text-gray-400">
            <i id="eyeIcon" class="bi bi-eye-slash"></i>
          </button>
        </div>

        <!-- Recuérdame -->
        <label class="flex items-center text-sm gap-2">
          <input type="checkbox" name="remember" class="accent-purple-500" />
          Recuérdame
        </label>

        <!-- Submit -->
        <button type="submit"
          class="w-full bg-[#1f1a38] dark:bg-purple-700 text-white font-semibold py-2 rounded-lg hover:bg-[#2d255c] dark:hover:bg-purple-800 transition">
          Entrar
        </button>
      </form>

      <div class="mt-4 text-center text-sm">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="text-purple-600 dark:text-purple-400 hover:underline">¿Olvidaste tu contraseña?</a>
        @endif
      </div>

      <div class="mt-2 text-center text-sm">
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="text-gray-600 dark:text-gray-300 hover:underline">¿No tienes cuenta? Regístrate</a>
        @endif
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById("password");
      const icon = document.getElementById("eyeIcon");
      if (password.type === "password") {
        password.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
      } else {
        password.type = "password";
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
