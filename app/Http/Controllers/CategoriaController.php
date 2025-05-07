<?php

// CategoriaController.php

namespace App\Http\Controllers;

use App\Models\Categoria; // Aquí es donde se importa el modelo Categoria
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();
        
        // Pasar las categorías a la vista
        return view('categorias', compact('categorias'));
    }
}

