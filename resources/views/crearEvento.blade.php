@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-purple-700">Crear un Nuevo Evento</h1>

    <form method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Detalles del Evento</h2>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Título del Evento</label>
                <input type="text" name="titulo" class="w-full border px-3 py-2 rounded" placeholder="Introduce el nombre del evento">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Categoría del Evento</label>
                <select name="categoria" class="w-full border px-3 py-2 rounded">
                    <option value="">Please select one</option>
                    <!-- Agrega opciones aquí -->
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 font-medium">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label class="block mb-1 font-medium">Fecha de Cierre</label>
                    <input type="date" name="fecha_fin" class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label class="block mb-1 font-medium">Hora de Inicio</label>
                    <input type="time" name="hora_inicio" class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label class="block mb-1 font-medium">Hora de Cierre</label>
                    <input type="time" name="hora_fin" class="w-full border px-3 py-2 rounded">
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Banner</label>
                <input type="file" name="banner" class="w-full">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">¿Qué tipo de evento estás realizando?</label>
                <div class="flex space-x-4">
                    <label class="flex items-center p-4 border rounded cursor-pointer bg-blue-50 space-x-2 flex-col gap-3 pl-10 pr-10">
                        <img src="img/boleto.png" alt="Icono Boleto" class="w-40 h-40">
                        <input type="radio" name="tipo_evento" value="ticket" class="mr-2">
                        <span>Evento con Ticket</span>
                    </label>
                    <label class="flex items-center p-4 border rounded bg-blue-50 cursor-pointer space-x-2 flex-col gap-3 pl-10 pr-10">
                        <img src="img/gratis.png" alt="Icono Gratis" class="w-40 h-40">
                        <input type="radio" name="tipo_evento" value="gratis" class="mr-2">
                        <span>Evento Gratis</span>
                    </label>
                </div>
            </div>
            

            <div class="mb-4">
                <label class="block mb-1 font-medium">Precio del ticket</label>
                <input type="number" name="precio" class="w-full border px-3 py-2 rounded" placeholder="€ 0.00">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">¿Dónde se hará tu evento?</label>
                <input type="text" name="ubicacion" class="w-full border px-3 py-2 rounded" placeholder="Introduce la dirección">
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium">Descripción del evento</label>
                <textarea name="descripcion" rows="5" class="w-full border px-3 py-2 rounded" placeholder="Describe los detalles del evento..."></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">
                    Guardar & Continuar
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
