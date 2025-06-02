@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-6 p-6 bg-white dark:bg-gray-800 shadow rounded-xl">
    <h1 class="text-3xl font-bold mb-6">Editar Evento: {{ $evento->titulo }}</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-500 text-white rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.eventos.update', $evento) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Título --}}
        <label class="block mb-2 font-semibold" for="titulo">Título</label>
        <input
            type="text"
            name="titulo"
            id="titulo"
            value="{{ old('titulo', $evento->titulo) }}"
            class="w-full p-2 mb-4 border rounded"
            required
        >
        @error('titulo')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        {{-- Categoría --}}
        <label class="block mb-2 font-semibold" for="category_id">Categoría</label>
        <select name="category_id" id="category_id" class="w-full p-2 mb-4 border rounded" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    {{ old('category_id', $evento->category_id) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        {{-- Fecha Inicio --}}
        <label class="block mb-2 font-semibold" for="fecha_inicio">Fecha de inicio</label>
        <input
            type="datetime-local"
            name="fecha_inicio"
            id="fecha_inicio"
            value="{{ old('fecha_inicio', \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d\TH:i')) }}"
            class="w-full p-2 mb-4 border rounded"
            required
        >
        @error('fecha_inicio')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        {{-- Fecha Fin --}}
        <label class="block mb-2 font-semibold" for="fecha_fin">Fecha de fin</label>
        <input
            type="datetime-local"
            name="fecha_fin"
            id="fecha_fin"
            value="{{ old('fecha_fin', \Carbon\Carbon::parse($evento->fecha_fin)->format('Y-m-d\TH:i')) }}"
            class="w-full p-2 mb-4 border rounded"
            required
        >
        @error('fecha_fin')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        {{-- Precio --}}
        <label class="block mb-2 font-semibold" for="precio">Precio</label>
        <input
            type="number"
            name="precio"
            id="precio"
            value="{{ old('precio', $evento->precio) }}"
            step="0.01"
            min="0"
            class="w-full p-2 mb-4 border rounded"
        >
        @error('precio')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        {{-- Ubicación --}}
        <label class="block mb-2 font-semibold" for="ubicacion">Ubicación</label>
        <input
            type="text"
            name="ubicacion"
            id="ubicacion"
            value="{{ old('ubicacion', $evento->ubicacion) }}"
            class="w-full p-2 mb-4 border rounded"
        >
        @error('ubicacion')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        {{-- Descripción --}}
        <label class="block mb-2 font-semibold" for="descripcion">Descripción</label>
        <textarea
            name="descripcion"
            id="descripcion"
            rows="5"
            class="w-full p-2 mb-4 border rounded"
        >{{ old('descripcion', $evento->descripcion) }}</textarea>
        @error('descripcion')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        {{-- Banner --}}
        <label class="block mb-2 font-semibold" for="banner">Banner (opcional)</label>
        <input type="file" name="banner" id="banner" class="mb-4" accept="image/*" />
        @if($evento->banner)
            <p class="mb-4">Imagen actual:</p>
            <img src="{{ asset('storage/' . $evento->banner) }}" alt="Banner actual" class="w-full max-w-md rounded mb-6" />
        @endif

        {{-- Botón Guardar --}}
        <button
            type="submit"
            class="bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700 transition"
        >
            Guardar Cambios
        </button>

        <label for="revisado" class="block mb-2 font-semibold">Revisado</label>
        <select name="revisado" id="revisado" class="w-full p-2 mb-4 border rounded" required>
            <option value="0" @selected(old('revisado', $evento->revisado) == false)>No</option>
            <option value="1" @selected(old('revisado', $evento->revisado) == true)>Sí</option>
        </select>

    </form>
</div>
@endsection
