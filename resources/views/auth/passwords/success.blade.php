@extends('layouts.login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-900 px-4">
  <div class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow-xl p-8 max-w-md w-full text-center animate-fade-in animate-bounce">
    <svg class="mx-auto mb-4 w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
    </svg>
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">¡Contraseña restablecida!</h2>
    <p class="text-gray-600 dark:text-gray-300 mb-6">Ahora puedes iniciar sesión con tu nueva contraseña.</p>
    <a href="{{ route('login') }}"
       class="bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-700 hover:to-purple-900 text-black dark:text-white font-semibold py-3 px-8 rounded-full shadow-lg transform transition-transform hover:scale-105">
      Ir al Login
    </a>
  </div>

  <style>
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(5px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fade-in 0.8s ease-out;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }
    .animate-bounce {
      animation: bounce 3s infinite ease-in-out;
    }
  </style>
</div>
@endsection
