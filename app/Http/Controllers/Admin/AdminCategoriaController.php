<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCategoriaController extends Controller
{
    // Mostrar listado de categorías
public function index(Request $request)
{
    $categorias = Categoria::all();

    // Si viene ?edit=ID en la url, buscamos esa categoría para editar
    $categoria_edit = null;
    if ($request->has('edit')) {
        $categoria_edit = Categoria::find($request->edit);
    }

    return view('admin.categorias', compact('categorias', 'categoria_edit'));
}

    // Mostrar formulario para crear categoría
    public function create()
    {
        return view('admin.categorias-create');
    }

    // Guardar nueva categoría
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('img', 'public');
        }

        Categoria::create($data);

        return redirect()->route('admin.categorias')->with('success', 'Categoría creada exitosamente.');
    }

    // Mostrar formulario para editar categoría
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias-edit', compact('categoria'));
    }

    // Actualizar categoría
    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($categoria->foto) {
                Storage::disk('public')->delete($categoria->foto);
            }
            $data['foto'] = $request->file('foto')->store('img', 'public');
        }

        $categoria->update($data);

        return redirect()->route('admin.categorias')->with('success', 'Categoría actualizada.');
    }

    // Eliminar categoría
    public function destroy(Categoria $categoria)
    {
        if ($categoria->foto) {
            Storage::disk('public')->delete($categoria->foto);
        }

        $categoria->delete();

        return redirect()->route('admin.categorias')->with('success', 'Categoría eliminada.');
    }
}
