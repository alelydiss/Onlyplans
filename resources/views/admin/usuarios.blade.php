@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    {{-- Mensajes de éxito y error --}}
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-4">Usuarios</h1>

    {{-- Formulario para crear usuario --}}
    <form action="{{ route('admin.usuarios.store') }}" method="POST" enctype="multipart/form-data" class="mb-6 border p-4 rounded">
        @csrf
        <h2 class="text-xl mb-2">Crear nuevo usuario</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <input type="text" name="name" placeholder="Nombre" value="{{ old('name') }}" required class="border p-2 rounded">
            <input type="text" name="last_name" placeholder="Apellido" value="{{ old('last_name') }}" class="border p-2 rounded">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="border p-2 rounded">

            <input type="text" name="phone" placeholder="Teléfono" value="{{ old('phone') }}" class="border p-2 rounded">
            <input type="text" name="address" placeholder="Dirección" value="{{ old('address') }}" class="border p-2 rounded">
            <input type="text" name="city" placeholder="Ciudad" value="{{ old('city') }}" class="border p-2 rounded">

            <input type="text" name="country" placeholder="País" value="{{ old('country') }}" class="border p-2 rounded">

            <select name="role" required class="border p-2 rounded">
                <option value="">Selecciona un rol</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuario</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>

            <input type="password" name="password" placeholder="Contraseña" required class="border p-2 rounded">

            <input type="file" name="avatar" accept="image/*" class="border p-2 rounded">

        </div>

        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Usuario</button>
    </form>

    {{-- Tabla de usuarios --}}
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Avatar</th>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Rol</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td class="border px-4 py-2">{{ $usuario->id }}</td>
                    <td class="border px-4 py-2">
                        @if($usuario->avatar)
                            <img src="{{ asset('storage/'.$usuario->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <span class="text-gray-500">N/A</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $usuario->name }} {{ $usuario->last_name }}</td>
                    <td class="border px-4 py-2">{{ $usuario->email }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $usuario->role }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        {{-- Botón Editar --}}
                        <button
                            onclick="openEditModal({{ $usuario }})"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded transition"
                            @if($usuario->role === 'admin') disabled title="No puedes editar a un administrador" @endif
                        >
                            Editar
                        </button>

                        {{-- Formulario eliminar --}}
                        @if($usuario->role !== 'admin')
                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition">Eliminar</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal para editar usuario --}}
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded p-6 w-full max-w-lg relative">
            <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>

            <h2 class="text-xl font-bold mb-4">Editar Usuario</h2>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="name" id="edit_name" placeholder="Nombre" required class="border p-2 rounded">
                    <input type="text" name="last_name" id="edit_last_name" placeholder="Apellido" class="border p-2 rounded">
                    <input type="email" name="email" id="edit_email" placeholder="Email" required class="border p-2 rounded">

                    <input type="text" name="phone" id="edit_phone" placeholder="Teléfono" class="border p-2 rounded">
                    <input type="text" name="address" id="edit_address" placeholder="Dirección" class="border p-2 rounded">
                    <input type="text" name="city" id="edit_city" placeholder="Ciudad" class="border p-2 rounded">

                    <input type="text" name="country" id="edit_country" placeholder="País" class="border p-2 rounded">

                    <select name="role" id="edit_role" required class="border p-2 rounded">
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>

                    <input type="password" name="password" id="edit_password" placeholder="Nueva contraseña (opcional)" class="border p-2 rounded">

                    <input type="file" name="avatar" id="edit_avatar" accept="image/*" class="border p-2 rounded">
                </div>

                <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Actualizar Usuario</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Abrir modal y llenar formulario con datos del usuario
    function openEditModal(usuario) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Rellenar campos
        document.getElementById('edit_id').value = usuario.id;
        document.getElementById('edit_name').value = usuario.name || '';
        document.getElementById('edit_last_name').value = usuario.last_name || '';
        document.getElementById('edit_email').value = usuario.email || '';
        document.getElementById('edit_phone').value = usuario.phone || '';
        document.getElementById('edit_address').value = usuario.address || '';
        document.getElementById('edit_city').value = usuario.city || '';
        document.getElementById('edit_country').value = usuario.country || '';
        document.getElementById('edit_role').value = usuario.role || 'user';

        // Limpiar password y avatar
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_avatar').value = '';

        // Cambiar action del formulario con la ruta correcta
        const form = document.getElementById('editForm');
        form.action = `/admin/usuarios/${usuario.id}`;
    }

    // Cerrar modal
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush
