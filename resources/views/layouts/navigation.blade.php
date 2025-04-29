<nav class="bg-[#1f1a38] text-white shadow-md" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo y nombre -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                    <img src="/img/logo.png" alt="Logo Onlyplans" class="h-6 w-75">
                </a>
            </div>

            <!-- Menú de navegación (escritorio) -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-purple-400 {{ request()->routeIs('dashboard') ? 'text-purple-400' : '' }}">Inicio</a>
                <a href="#" class="text-sm font-medium hover:text-purple-400">Planes</a>
                <a href="{{ route('mapa') }}" class="text-sm font-medium hover:text-purple-400 {{ request()->routeIs('mapa') ? 'text-purple-400' : '' }}">Mapa</a>

                <a href="#" class="flex items-center space-x-1 hover:text-purple-400">
                    <i class="bi bi-ticket-fill"></i><span class="text-sm">Tickets</span>
                </a>
                <a href="#" class="flex items-center space-x-1 hover:text-purple-400">
                    <i class="bi bi-stars"></i><span class="text-sm">Favoritos</span>
                </a>

                <!-- Dropdown de usuario -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            @auth
                                <img src="{{ Auth::user()->avatar ?: '/img/default-avatar.png' }}" alt="Foto de perfil" class="w-8 h-8 rounded-full border-2 border-white mr-2">
                                <div>{{ Auth::user()->name }}</div>
                            @endauth
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Botón hamburguesa (móvil) -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg class="h-6 w-6 transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú desplegable para móvil con animación -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-[#2a234b] rounded-b-xl px-6 py-4 space-y-4"
    >
        <a href="{{ route('dashboard') }}" class="block text-sm font-medium hover:text-purple-400 {{ request()->routeIs('dashboard') ? 'text-purple-400' : '' }}">Inicio</a>
        <a href="#" class="block text-sm font-medium hover:text-purple-400">Planes</a>
        <a href="{{ route('mapa') }}" class="block text-sm font-medium hover:text-purple-400 {{ request()->routeIs('mapa') ? 'text-purple-400' : '' }}">Mapa</a>

        <a href="#" class="flex items-center space-x-1 hover:text-purple-400">
            <i class="bi bi-ticket-fill"></i><span class="text-sm">Tickets</span>
        </a>
        <a href="#" class="flex items-center space-x-1 hover:text-purple-400">
            <i class="bi bi-stars"></i><span class="text-sm">Favoritos</span>
        </a>

        @auth
            <div class="border-t border-purple-600 pt-4">
                <a href="{{ route('profile.edit') }}" class="block text-sm hover:text-purple-400">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block text-sm hover:text-purple-400 mt-2">Cerrar sesión</button>
                </form>
            </div>
        @endauth
    </div>
</nav>
