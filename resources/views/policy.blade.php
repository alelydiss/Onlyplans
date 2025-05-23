@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Encabezado minimalista -->
    <div class="text-center mb-16">
        <span class="inline-block text-sm font-medium text-blue-600 mb-3 tracking-widest">PRIVACIDAD</span>
        <h1 class="text-4xl font-light text-gray-900 mb-4">Nuestro compromiso con <span class="font-medium">tu privacidad</span></h1>
        <div class="w-20 h-px bg-gray-300 mx-auto"></div>
    </div>

    <!-- Contenido principal en tarjetas superpuestas -->
    <div class="relative z-10 space-y-10">
        <!-- Sección 1 - Flotante -->
        <div class="relative bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 p-8 md:p-10 border border-gray-100">
            <div class="absolute -top-4 -left-4 w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                </svg>
            </div>
            <h2 class="text-2xl font-normal text-gray-800 mb-4">Recopilación mínima de datos</h2>
            <p class="text-gray-600 leading-relaxed mb-6">Solo solicitamos la información estrictamente necesaria para brindarte nuestros servicios. Nuestro principio es la minimización de datos.</p>
            <ul class="space-y-3 text-gray-600 text-sm">
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Sin recopilación de datos innecesarios</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Información básica de contacto</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Datos de transacciones protegidos</span>
                </li>
            </ul>
        </div>

        <!-- Sección 2 - Flotante con desplazamiento -->
        <div class="relative bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 p-8 md:p-10 border border-gray-100 md:ml-12">
            <div class="absolute -top-4 -left-4 w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <h2 class="text-2xl font-normal text-gray-800 mb-4">Protección de última generación</h2>
            <p class="text-gray-600 leading-relaxed mb-6">Implementamos los más altos estándares de seguridad para garantizar la integridad y confidencialidad de tu información.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-800 mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                        </svg>
                        Cifrado AES-256
                    </h3>
                    <p class="text-gray-600 text-sm">Todos los datos se almacenan con el mismo estándar que utilizan las instituciones financieras.</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-medium text-gray-800 mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                        </svg>
                        Autenticación MFA
                    </h3>
                    <p class="text-gray-600 text-sm">Protección de cuentas con autenticación multifactor opcional.</p>
                </div>
            </div>
        </div>

        <!-- Sección 3 - Flotante -->
        <div class="relative bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 p-8 md:p-10 border border-gray-100 md:ml-24">
            <div class="absolute -top-4 -left-4 w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <h2 class="text-2xl font-normal text-gray-800 mb-4">Control y transparencia</h2>
            <p class="text-gray-600 leading-relaxed mb-6">Mantenemos total transparencia sobre el uso de tus datos y te damos control absoluto sobre tu información.</p>
            
            <div class="flex flex-wrap gap-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Exportación de datos</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Eliminación inmediata</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Regulaciones GDPR</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Sin terceros</span>
            </div>
        </div>
    </div>

    <!-- Sección de principios -->
    <div class="mt-32 mb-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-light text-gray-900 mb-3">Principios fundamentales</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Bases sobre las que construimos nuestra política de privacidad</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center px-6">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-normal text-gray-800 mb-3">Seguridad primero</h3>
                <p class="text-gray-600">Inversión continua en tecnologías de protección de datos de última generación.</p>
            </div>
            <div class="text-center px-6">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-purple-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-normal text-gray-800 mb-3">Sin sorpresas</h3>
                <p class="text-gray-600">Comunicación clara sobre cualquier cambio en nuestras políticas de privacidad.</p>
            </div>
            <div class="text-center px-6">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-green-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-normal text-gray-800 mb-3">Sin fines comerciales</h3>
                <p class="text-gray-600">Tus datos nunca serán vendidos o utilizados para publicidad no deseada.</p>
            </div>
        </div>
    </div>
</div>
@endsection