<!DOCTYPE html>
<html lang="es" x-data="themeSwitcher()" x-init="initTheme()" :class="{ 'dark': darkMode }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil - Onlyplans</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen text-gray-800 dark:text-gray-100">

  <!-- Header -->
  <header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight">
        {{ __('Perfil') }}
      </h2>
      <!-- Botón de tema -->
      <button id="darkModeToggle" class="fixed bottom-4 right-4 p-3 rounded-full bg-purple-600 text-white shadow-lg z-50">
        <span id="icon">🌙</span>
      </button>
      
      
      
    </div>
  </header>

  <!-- Contenido -->
  <main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

      <!-- Actualizar información del perfil -->
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('profile.partials.update-profile-information-form')
        </div>
      </div>

      <!-- Cambiar contraseña -->
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('profile.partials.update-password-form')
        </div>
      </div>

      <!-- Eliminar cuenta -->
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('profile.partials.delete-user-form')
        </div>
      </div>

    </div>
  </main>
  <script>
    const html = document.documentElement;
    const toggleBtn = document.getElementById('darkModeToggle');
    const icon = document.getElementById('icon');
  
    // Cargar el tema guardado
    if (localStorage.getItem('theme') === 'dark') {
      html.classList.add('dark');
      icon.textContent = '☀️';
    }
  
    toggleBtn.addEventListener('click', () => {
      html.classList.toggle('dark');
      const isDark = html.classList.contains('dark');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      icon.textContent = isDark ? '☀️' : '🌙';
    });
  </script>

</body>
</html>
