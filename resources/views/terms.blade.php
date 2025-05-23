@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Encabezado elegante -->
    <div class="text-center mb-16">
        <span class="inline-block text-sm font-medium text-indigo-600 mb-4 tracking-widest">CONTRATO LEGAL</span>
        <h1 class="text-4xl font-light text-gray-900 mb-4">Términos y <span class="font-medium">Condiciones</span></h1>
        <div class="w-24 h-0.5 bg-gray-300 mx-auto"></div>
    </div>

    <!-- Introducción -->
    <div class="bg-white rounded-xl shadow-sm p-8 mb-12 border border-gray-100">
        <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-indigo-500 mt-1 mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-gray-700 leading-relaxed">
                Bienvenido a OnlyPlans. Al acceder y utilizar nuestro sitio web y servicios, aceptas cumplir con los siguientes términos y condiciones legales. Te recomendamos leer detenidamente este documento.
            </p>
        </div>
    </div>

    <!-- Términos en acordeón -->
    <div class="space-y-6">
        <!-- Término 1 -->
        <div class="group">
            <div class="flex items-start justify-between cursor-pointer" onclick="toggleTerm(1)">
                <div class="flex items-start">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 font-medium mr-4 flex-shrink-0 group-hover:bg-indigo-200 transition">1</span>
                    <h2 class="text-xl font-medium text-gray-900">Uso del Servicio</h2>
                </div>
                <svg id="term-icon-1" class="h-6 w-6 text-gray-400 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="term-content-1" class="hidden pl-12 pt-4">
                <div class="prose prose-indigo text-gray-600 max-w-none">
                    <p>OnlyPlans opera como plataforma para la promoción, gestión y venta de entradas para diversos eventos. Al utilizar nuestros servicios, declaras y garantizas que:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-3">
                        <li>Tienes al menos 18 años de edad o cuentas con el consentimiento expreso de tus padres/tutores legales</li>
                        <li>Utilizarás el servicio únicamente para fines legales</li>
                        <li>No realizarás actividades fraudulentas o que infrinjan derechos de terceros</li>
                        <li>No interferirás con el funcionamiento normal de la plataforma</li>
                    </ul>
                </div>
            </div>
            <div class="border-b border-gray-200 mt-6"></div>
        </div>

        <!-- Término 2 -->
        <div class="group">
            <div class="flex items-start justify-between cursor-pointer" onclick="toggleTerm(2)">
                <div class="flex items-start">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 font-medium mr-4 flex-shrink-0 group-hover:bg-indigo-200 transition">2</span>
                    <h2 class="text-xl font-medium text-gray-900">Registro de Usuario</h2>
                </div>
                <svg id="term-icon-2" class="h-6 w-6 text-gray-400 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="term-content-2" class="hidden pl-12 pt-4">
                <div class="prose prose-indigo text-gray-600 max-w-none">
                    <p>Para acceder a ciertas funcionalidades como la compra de entradas, deberás crear una cuenta proporcionando información exacta, completa y actualizada. Como usuario, aceptas que:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-3">
                        <li>Eres responsable de mantener la confidencialidad de tus credenciales de acceso</li>
                        <li>Notificarás inmediatamente cualquier uso no autorizado de tu cuenta</li>
                        <li>Eres responsable de todas las actividades que ocurran bajo tu cuenta</li>
                        <li>OnlyPlans se reserva el derecho de suspender cuentas con información falsa o actividades sospechosas</li>
                    </ul>
                </div>
            </div>
            <div class="border-b border-gray-200 mt-6"></div>
        </div>

        <!-- Término 3 -->
        <div class="group">
            <div class="flex items-start justify-between cursor-pointer" onclick="toggleTerm(3)">
                <div class="flex items-start">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 font-medium mr-4 flex-shrink-0 group-hover:bg-indigo-200 transition">3</span>
                    <h2 class="text-xl font-medium text-gray-900">Procesamiento de Pagos</h2>
                </div>
                <svg id="term-icon-3" class="h-6 w-6 text-gray-400 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="term-content-3" class="hidden pl-12 pt-4">
                <div class="prose prose-indigo text-gray-600 max-w-none">
                    <p>OnlyPlans utiliza Stripe como procesador de pagos certificado PCI DSS nivel 1, el estándar más estricto de la industria. Al realizar transacciones en nuestra plataforma:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-3">
                        <li>Autorizas el cargo correspondiente al método de pago proporcionado</li>
                        <li>Reconoces que no almacenamos información sensible de tarjetas de crédito/débito</li>
                        <li>Aceptas que los precios pueden incluir cargos por servicio y procesamiento</li>
                        <li>Comprendes que las transacciones son verificadas para prevenir fraudes</li>
                    </ul>
                    <p class="mt-4 text-sm bg-indigo-50 p-3 rounded-lg">Todos los pagos se procesan en moneda local (EUR) y pueden estar sujetos a conversión cambiaria según tu entidad financiera.</p>
                </div>
            </div>
            <div class="border-b border-gray-200 mt-6"></div>
        </div>

        <!-- Término 4 -->
        <div class="group">
            <div class="flex items-start justify-between cursor-pointer" onclick="toggleTerm(4)">
                <div class="flex items-start">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 font-medium mr-4 flex-shrink-0 group-hover:bg-indigo-200 transition">4</span>
                    <h2 class="text-xl font-medium text-gray-900">Política de Cancelación</h2>
                </div>
                <svg id="term-icon-4" class="h-6 w-6 text-gray-400 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="term-content-4" class="hidden pl-12 pt-4">
                <div class="prose prose-indigo text-gray-600 max-w-none">
                    <p>Las entradas adquiridas a través de OnlyPlans están sujetas a las siguientes condiciones:</p>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">No reembolsable</h4>
                                <p class="text-sm text-gray-600 mt-1">Las compras son definitivas y no reembolsables, excepto en caso de cancelación del evento por parte del organizador.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 1 1 0 001.415 1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">Cambio de fecha</h4>
                                <p class="text-sm text-gray-600 mt-1">Si el evento cambia de fecha, las entradas mantendrán su validez para la nueva fecha o podrán solicitar reembolso.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">Reembolso por cancelación</h4>
                                <p class="text-sm text-gray-600 mt-1">En caso de cancelación del evento, los reembolsos se procesarán automáticamente en un plazo máximo de 14 días hábiles.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-200 mt-6"></div>
        </div>

        <!-- Término 5 -->
        <div class="group">
            <div class="flex items-start justify-between cursor-pointer" onclick="toggleTerm(5)">
                <div class="flex items-start">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 font-medium mr-4 flex-shrink-0 group-hover:bg-indigo-200 transition">5</span>
                    <h2 class="text-xl font-medium text-gray-900">Modificaciones</h2>
                </div>
                <svg id="term-icon-5" class="h-6 w-6 text-gray-400 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div id="term-content-5" class="hidden pl-12 pt-4">
                <div class="prose prose-indigo text-gray-600 max-w-none">
                    <p>OnlyPlans se reserva el derecho de modificar estos términos y condiciones en cualquier momento para:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-3">
                        <li>Reflejar cambios en nuestras prácticas operativas</li>
                        <li>Cumplir con nuevas regulaciones legales</li>
                        <li>Implementar mejoras en nuestros servicios</li>
                    </ul>
                    <p class="mt-4">Las versiones actualizadas serán publicadas en nuestro sitio web con la fecha de última modificación. El uso continuado de nuestros servicios después de dichos cambios constituirá tu consentimiento a los términos revisados.</p>
                    <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="font-medium text-gray-900 mb-2">Notificación de cambios importantes</h4>
                        <p class="text-sm text-gray-600">Para modificaciones sustanciales que puedan afectar tus derechos, te notificaremos por correo electrónico con al menos 30 días de anticipación.</p>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-200 mt-6"></div>
        </div>
    </div>
</div>

<script>
    function toggleTerm(termNumber) {
        const content = document.getElementById(`term-content-${termNumber}`);
        const icon = document.getElementById(`term-icon-${termNumber}`);
        
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
@endsection