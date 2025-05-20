<nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg shadow-sm sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800" x-data="{ open: false, userMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo con efecto de neón suave -->
            <a href="{{ route('welcome') }}" class="flex items-center group relative">
                <div class="relative flex items-center">
                    <img src="/img/logo.png" alt="Logo" class="h-9 w-auto object-contain transition-all duration-500 group-hover:rotate-[10deg] group-hover:scale-105">
                    <div class="absolute inset-0 rounded-full bg-gradient-to-r from-purple-400/10 to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10 blur-[6px]"></div>
                </div>
            </a>

            @guest
                <!-- Botones para invitados con efecto de cristal mejorado -->
                <div class="flex space-x-3">
                    <a href="{{ route('login') }}"
                        class="px-4 py-1.5 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-sm font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.03] hover:from-purple-600 hover:to-indigo-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-1.5 rounded-full border border-purple-400/50 text-purple-600 dark:text-purple-300 text-sm font-medium hover:bg-purple-500/10 transition-all duration-300 hover:border-purple-500/80 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Registrarse
                    </a>
                </div>
            @else
                <!-- Menú desktop mejorado -->
                <div class="hidden md:flex items-center space-x-1">
                    @if (Auth::user()->role === 'admin')
                        <!-- Menú admin con indicador de luz neón mejorado -->
                        <a href="{{ route('admin.dashboard') }}"
                            class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group
                                {{ request()->routeIs('admin.dashboard') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Inicio
                            </span>
                            <span class="{{ request()->routeIs('admin.dashboard') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                        </a>
                        
                        <a href="{{ route('admin.categorias') }}"
                            class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group
                                {{ request()->routeIs('admin.categorias') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Categorías
                            </span>
                            <span class="{{ request()->routeIs('admin.categorias') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                        </a>
                        
                        <a href="{{ route('admin.usuarios') }}"
                            class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group
                                {{ request()->routeIs('admin.usuarios') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Usuarios
                            </span>
                            <span class="{{ request()->routeIs('admin.usuarios') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                        </a>
                        
                        <a href="{{ route('admin.eventos') }}"
                            class="relative px-4 py-2 text-sm font-medium transition-all duration-300 group
                                {{ request()->routeIs('admin.eventos') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Eventos
                            </span>
                            <span class="{{ request()->routeIs('admin.eventos') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                        </a>
                    @else
                        <!-- Menú usuario con efectos mejorados -->
                        <a href="{{ route('dashboard') }}"
                            class="relative px-4 py-2 group"
                            x-data="{ particles: [] }"
                            @mouseenter="
                                for(let i=0; i<8; i++) {
                                    particles.push({
                                        id: Date.now() + i,
                                        x: Math.random() * 100,
                                        y: Math.random() * 100,
                                        size: Math.random() * 2 + 1,
                                        duration: Math.random() * 1000 + 500,
                                        delay: Math.random() * 300,
                                        color: ['purple-400', 'indigo-400', 'pink-400'][Math.floor(Math.random() * 3)]
                                    });
                                }
                                setTimeout(() => { particles = [] }, 1500);
                            ">
                            <span class="relative z-10 flex items-center text-sm font-medium transition-all duration-300
                                {{ request()->routeIs('dashboard') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Inicio
                            </span>
                            <span class="{{ request()->routeIs('dashboard') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                            
                            <template x-for="particle in particles" :key="particle.id">
                                <span class="absolute rounded-full pointer-events-none"
                                    :class="`bg-${particle.color}`"
                                    :style="`
                                        left: ${particle.x}%;
                                        top: ${particle.y}%;
                                        width: ${particle.size}px;
                                        height: ${particle.size}px;
                                        animation: particle-animate ${particle.duration}ms ease-out ${particle.delay}ms forwards;
                                    `">
                                </span>
                            </template>
                        </a>
                        
                        <a href="{{ route('eventosPersonalizados') }}"
                            class="relative px-4 py-2 group"
                            x-data="{ particles: [] }"
                            @mouseenter="
                                for(let i=0; i<8; i++) {
                                    particles.push({
                                        id: Date.now() + i,
                                        x: Math.random() * 100,
                                        y: Math.random() * 100,
                                        size: Math.random() * 2 + 1,
                                        duration: Math.random() * 1000 + 500,
                                        delay: Math.random() * 300,
                                        color: ['purple-400', 'indigo-400', 'pink-400'][Math.floor(Math.random() * 3)]
                                    });
                                }
                                setTimeout(() => { particles = [] }, 1500);
                            ">
                            <span class="relative z-10 flex items-center text-sm font-medium transition-all duration-300
                                {{ request()->routeIs('eventosPersonalizados') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                Planes
                            </span>
                            <span class="{{ request()->routeIs('eventosPersonalizados') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                            
                            <template x-for="particle in particles" :key="particle.id">
                                <span class="absolute rounded-full pointer-events-none"
                                    :class="`bg-${particle.color}`"
                                    :style="`
                                        left: ${particle.x}%;
                                        top: ${particle.y}%;
                                        width: ${particle.size}px;
                                        height: ${particle.size}px;
                                        animation: particle-animate ${particle.duration}ms ease-out ${particle.delay}ms forwards;
                                    `">
                                </span>
                            </template>
                        </a>
                        
                        <a href="{{ route('mapa') }}"
                            class="relative px-4 py-2 group"
                            x-data="{ particles: [] }"
                            @mouseenter="
                                for(let i=0; i<8; i++) {
                                    particles.push({
                                        id: Date.now() + i,
                                        x: Math.random() * 100,
                                        y: Math.random() * 100,
                                        size: Math.random() * 2 + 1,
                                        duration: Math.random() * 1000 + 500,
                                        delay: Math.random() * 300,
                                        color: ['purple-400', 'indigo-400', 'pink-400'][Math.floor(Math.random() * 3)]
                                    });
                                }
                                setTimeout(() => { particles = [] }, 1500);
                            ">
                            <span class="relative z-10 flex items-center text-sm font-medium transition-all duration-300
                                {{ request()->routeIs('mapa') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                Mapa
                            </span>
                            <span class="{{ request()->routeIs('mapa') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                            
                            <template x-for="particle in particles" :key="particle.id">
                                <span class="absolute rounded-full pointer-events-none"
                                    :class="`bg-${particle.color}`"
                                    :style="`
                                        left: ${particle.x}%;
                                        top: ${particle.y}%;
                                        width: ${particle.size}px;
                                        height: ${particle.size}px;
                                        animation: particle-animate ${particle.duration}ms ease-out ${particle.delay}ms forwards;
                                    `">
                                </span>
                            </template>
                        </a>
                        
                        <!-- Nueva pestaña de Favoritos -->
                        <a href="{{ route('favoritos') }}"
                            class="relative px-4 py-2 group"
                            x-data="{ particles: [] }"
                            @mouseenter="
                                for(let i=0; i<8; i++) {
                                    particles.push({
                                        id: Date.now() + i,
                                        x: Math.random() * 100,
                                        y: Math.random() * 100,
                                        size: Math.random() * 2 + 1,
                                        duration: Math.random() * 1000 + 500,
                                        delay: Math.random() * 300,
                                        color: ['purple-400', 'indigo-400', 'pink-400'][Math.floor(Math.random() * 3)]
                                    });
                                }
                                setTimeout(() => { particles = [] }, 1500);
                            ">
                            <span class="relative z-10 flex items-center text-sm font-medium transition-all duration-300
                                {{ request()->routeIs('favoritos') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Favoritos
                            </span>
                            <span class="{{ request()->routeIs('favoritos') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                            
                            <template x-for="particle in particles" :key="particle.id">
                                <span class="absolute rounded-full pointer-events-none"
                                    :class="`bg-${particle.color}`"
                                    :style="`
                                        left: ${particle.x}%;
                                        top: ${particle.y}%;
                                        width: ${particle.size}px;
                                        height: ${particle.size}px;
                                        animation: particle-animate ${particle.duration}ms ease-out ${particle.delay}ms forwards;
                                    `">
                                </span>
                            </template>
                        </a>
                        
                        <!-- Nueva pestaña de Tickets -->
                        <a href="{{ route('tickets.index') }}"
                            class="relative px-4 py-2 group"
                            x-data="{ particles: [] }"
                            @mouseenter="
                                for(let i=0; i<8; i++) {
                                    particles.push({
                                        id: Date.now() + i,
                                        x: Math.random() * 100,
                                        y: Math.random() * 100,
                                        size: Math.random() * 2 + 1,
                                        duration: Math.random() * 1000 + 500,
                                        delay: Math.random() * 300,
                                        color: ['purple-400', 'indigo-400', 'pink-400'][Math.floor(Math.random() * 3)]
                                    });
                                }
                                setTimeout(() => { particles = [] }, 1500);
                            ">
                            <span class="relative z-10 flex items-center text-sm font-medium transition-all duration-300
                                {{ request()->routeIs('tickets.index') ? 'text-purple-500 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                Tickets
                            </span>
                            <span class="{{ request()->routeIs('tickets.index') ? 'opacity-100' : 'opacity-0 group-hover:opacity-50' }} absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-purple-500/0 via-purple-500 to-purple-500/0 transition-opacity duration-300"></span>
                            
                            <template x-for="particle in particles" :key="particle.id">
                                <span class="absolute rounded-full pointer-events-none"
                                    :class="`bg-${particle.color}`"
                                    :style="`
                                        left: ${particle.x}%;
                                        top: ${particle.y}%;
                                        width: ${particle.size}px;
                                        height: ${particle.size}px;
                                        animation: particle-animate ${particle.duration}ms ease-out ${particle.delay}ms forwards;
                                    `">
                                </span>
                            </template>
                        </a>
                        @endif
                        
                        <!-- Menú desplegable de usuario mejorado -->
                        <div class="relative ml-2" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center focus:outline-none group">
                                <div class="relative">
                                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('/img/default-avatar.png') }}"
                                        alt="Avatar"
                                        class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:border-purple-300 dark:group-hover:border-purple-500">
                                    <div x-show="open" class="absolute inset-0 rounded-full bg-purple-500/20 animate-pulse border border-purple-400/50"></div>
                                    <div class="absolute -bottom-1 -right-1 bg-purple-500 rounded-full w-3 h-3 border-2 border-white dark:border-gray-800"></div>
                                </div>
                            </button>
                            
                            <div x-show="open" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
                                x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="transform opacity-0 scale-95 translate-y-2"
                                class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-1 z-50 border border-gray-200 dark:border-gray-700 overflow-hidden backdrop-blur-sm bg-white/90 dark:bg-gray-800/90">
                                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-purple-50/50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Perfil
                                </a>
                               
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-purple-50/50 dark:hover:bg-gray-700/50 transition-colors duration-200 border-t border-gray-100 dark:border-gray-700">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    
                </div>

                <!-- Menú móvil - Botón hamburguesa con animación mejorada -->
                <div class="md:hidden flex items-center space-x-3">
                    <!-- Icono de notificaciones (ejemplo) -->
                    <button class="p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 relative">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    
                    <button @click="open = !open" class="p-2 rounded-full focus:outline-none transition-all duration-300 group">
                        <div class="relative w-6 h-6">
                            <span class="absolute top-1/2 left-0 w-full h-0.5 bg-gray-800 dark:bg-white transform transition duration-300 ease-in-out"
                                :class="{ 'rotate-45 translate-y-0': open, '-translate-y-2': !open }"></span>
                            <span class="absolute top-1/2 left-0 w-full h-0.5 bg-gray-800 dark:bg-white transform transition duration-300 ease-in-out"
                                :class="{ 'opacity-0': open }"></span>
                            <span class="absolute top-1/2 left-0 w-full h-0.5 bg-gray-800 dark:bg-white transform transition duration-300 ease-in-out"
                                :class="{ '-rotate-45 translate-y-0': open, 'translate-y-2': !open }"></span>
                        </div>
                    </button>
                </div>
            @endguest
        </div>
    </div>

    <!-- Menú móvil - Estilo de tarjeta flotante mejorada -->
    @auth
        <div x-show="open" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-b-xl shadow-xl mx-2 px-4 py-3 space-y-1 border border-gray-200 dark:border-gray-700">
            
            <!-- Perfil móvil mejorado -->
            <div class="flex items-center space-x-3 pb-3 border-b border-gray-200 dark:border-gray-700">
                <div class="relative">
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('/img/default-avatar.png') }}"
                        alt="Avatar"
                        class="w-10 h-10 rounded-full border-2 border-purple-400 shadow">
                    <div class="absolute -bottom-1 -right-1 bg-purple-500 rounded-full w-3 h-3 border-2 border-white dark:border-gray-800"></div>
                </div>
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
             @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('admin.dashboard') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>Panel Admin</span>
                </a>
                <a href="{{ route('admin.categorias') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('admin.categorias') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span>Categorías</span>
                </a>
                <a href="{{ route('admin.usuarios') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('admin.usuarios') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Usuarios</span>
                </a>
                <a href="{{ route('admin.eventos') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('admin.eventos') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Eventos</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('dashboard') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Inicio</span>
                </a>
                <a href="{{ route('eventosPersonalizados') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('eventosPersonalizados') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Planes</span>
                </a>
                <a href="{{ route('mapa') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('mapa') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <span>Mapa</span>
                </a>
                <a href="{{ route('favoritos') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('favoritos') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span>Favoritos</span>
                </a>
                <a href="{{ route('tickets.index') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-200
                    {{ request()->routeIs('tickets.index') ? 'bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    <span>Tickets</span>
                </a>
            @endif

            <!-- Sección secundaria del menú móvil -->
            <div class="pt-2 border-t border-gray-200 dark:border-gray-700 space-y-1">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 py-2 px-3 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Perfil</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full space-x-3 py-2 px-3 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    @endauth
</nav>
