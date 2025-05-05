<section class="max-w-4xl mx-auto p-12 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <header class="mb-10 text-center">
        <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">Información de la Cuenta</h2>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-10">
        @csrf
        @method('PATCH')

        <!-- Foto de Perfil -->
        <div class="flex flex-col items-center gap-2">
            <label for="profile_photo" class="relative cursor-pointer group">
                <img src="{{ $user->profile_photo_url ?? asset('avatars/default_avatar.png') }}"
                     class="w-28 h-28 rounded-full border-2 border-gray-300 dark:border-gray-600 object-cover"
                     alt="Foto de perfil">
                <div class="absolute bottom-0 right-0 bg-white dark:bg-gray-700 rounded-full p-1 shadow-md">
                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h2a2 2 0 012 2h4a2 2 0 012 2v2h-2V6H6v8h2v2H6a2 2 0 01-2-2V4z"/>
                        <path d="M12 12a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <input id="profile_photo" name="profile_photo" type="file" class="hidden" accept="image/*">
            </label>
            <p class="text-sm text-gray-600 dark:text-gray-400">Foto de Perfil</p>
        </div>

        <!-- Información del perfil -->
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Información del perfil</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre:</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $user->name ?? '') }}"
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellido:</label>
                    <input type="text" name="last_name" id="last_name"
                           value="{{ old('last_name', $user->last_name ?? '') }}"
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                </div>
            </div>
        </div>

        <!-- Detalles de contacto -->
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Detalles de contacto</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5">Estos datos son privados y solo se utilizan para comunicarnos para la venta de entradas.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono:</label>
                    <input type="text" name="phone" id="phone"
                           value="{{ old('phone', $user->phone ?? '') }}"
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección:</label>
                    <input type="text" name="address" id="address"
                           value="{{ old('address', $user->address ?? '') }}"
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ciudad/Pueblo:</label>
                    <input type="text" name="city" id="city"
                           value="{{ old('city', $user->city ?? '') }}"
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                </div>
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">País:</label>
                    <input type="text" name="country" id="country"
                           value="{{ old('country', $user->country ?? '') }}"
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500">
                </div>
            </div>
        </div>

        <!-- Botón -->
        <div class="text-center">
            <button type="submit"
                    class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-medium py-3 px-8 rounded-md hover:opacity-90 transition">
                Guardar perfil
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="mt-2 text-sm text-green-600 dark:text-green-400">
                    Guardado.
                </p>
            @endif
        </div>
    </form>
</section>
