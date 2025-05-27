<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminUsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'required|email|unique:users',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'city'       => 'nullable|string|max:255',
            'country'    => 'nullable|string|max:255',
            'avatar'     => 'nullable|image|max:2048',
            'password'   => 'required|string|min:6',
            'role'       => 'required|in:user,admin',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->back()->with('success', 'Usuario creado correctamente.');
    }

    public function update(Request $request, User $usuario)
    {
        if ($usuario->role === 'admin') {
            return back()->with('error', 'No puedes editar a un administrador.');
        }

        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $usuario->id,
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'city'       => 'nullable|string|max:255',
            'country'    => 'nullable|string|max:255',
            'avatar'     => 'nullable|image|max:2048',
            'role'       => 'required|in:user,admin',
            'password'   => 'nullable|string|min:6',
        ]);

        if ($request->hasFile('avatar')) {
            if ($usuario->avatar) {
                Storage::disk('public')->delete($usuario->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        if ($usuario->role === 'admin') {
            return back()->with('error', 'No puedes eliminar a un administrador.');
        }

        if ($usuario->avatar) {
            Storage::disk('public')->delete($usuario->avatar);
        }

        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }
}
