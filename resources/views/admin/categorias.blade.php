@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 p-6">
    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Gestión de Categorías</h1>
        </div>

        {{-- Mensajes de éxito --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario para crear nueva categoría --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md mb-10">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Crear Nueva Categoría</h2>
            <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="nombre" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                           class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="foto" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Foto (opcional)</label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                           class="w-full text-gray-700 dark:text-gray-300">
                    @error('foto')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">Crear Categoría</button>
            </form>
        </div>

        {{-- Listado de categorías --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Categorías Existentes</h2>

            @if($categorias->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No hay categorías creadas.</p>
            @else
                <table class="w-full text-left table-auto border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Foto</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Nombre</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                    @if($categoria->foto)
                                        <img src="{{ asset('storage/'.$categoria->foto) }}" alt="{{ $categoria->nombre }}" class="w-16 h-16 object-cover rounded-md">
                                    @else
                                        <span class="text-gray-400 italic">Sin foto</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $categoria->nombre }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 space-x-2">
                                    <!-- Botón Editar abre modal -->
                                    <button 
                                        onclick="openEditModal({{ $categoria->id }}, '{{ addslashes($categoria->nombre) }}', '{{ $categoria->foto ? asset('storage/'.$categoria->foto) : '' }}')"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded transition"
                                    >
                                        Editar
                                    </button>

                                    <!-- Formulario eliminar -->
                                    <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar esta categoría?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Modal para editar categoría --}}
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 w-full max-w-lg shadow-lg relative">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Editar Categoría</h3>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="edit_nombre" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Nombre</label>
                        <input type="text" name="nombre" id="edit_nombre" required
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="edit_foto" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Foto (opcional)</label>
                        <input type="file" name="foto" id="edit_foto" accept="image/*" class="w-full text-gray-700 dark:text-gray-300">
                        <div id="currentPhoto" class="mt-2">
                            <img src="" alt="Foto actual" class="w-32 h-32 object-cover rounded-md hidden" />
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600">Cancelar</button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">Guardar Cambios</button>
                    </div>
                </form>
                <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-bold text-xl">&times;</button>
            </div>
        </div>

    </div>
</div>

<script>
    function openEditModal(id, nombre, fotoUrl) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const nombreInput = document.getElementById('edit_nombre');
        const currentPhotoDiv = document.getElementById('currentPhoto');
        const img = currentPhotoDiv.querySelector('img');

        form.action = `/admin/categorias/${id}`;
        nombreInput.value = nombre;

        if (fotoUrl) {
            img.src = fotoUrl;
            img.classList.remove('hidden');
        } else {
            img.classList.add('hidden');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
