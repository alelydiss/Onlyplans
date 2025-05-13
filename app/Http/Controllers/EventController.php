<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


class EventController extends Controller
{
    public function create()
    {
        // Obtener todas las categorías para pasarlas al formulario
        $categorias = Categoria::all();
        
        // Mostrar el formulario de creación de evento y pasar las categorías
        return view('crearEvento', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|exists:categorias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
            'banner' => 'nullable|image|max:2048',
            'tipo_evento' => 'required|in:ticket,gratis',
            'precio' => 'nullable|numeric|min:0',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'descripcion' => 'required|string',
            'ubicacion' => 'nullable|string|max:255', // Ubicación opcional
        ]);

        // Guardar el evento
        $evento = new Event();
        $evento->user_id = Auth::id();  // Establecer el ID del usuario autenticado
        $evento->category_id = $request->categoria;
        $evento->titulo = $request->titulo;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->fecha_fin;
        $evento->hora_inicio = $request->hora_inicio;
        $evento->hora_fin = $request->hora_fin;
        $evento->tipo_evento = $request->tipo_evento;
        $evento->precio = $request->precio;
        $evento->descripcion = $request->descripcion;
        $evento->ubicacion = $request->ubicacion; // Se agrega ubicación
        $evento->lat = $request->latitud;  // Latitud
        $evento->lng = $request->longitud;  // Longitud

        // Manejo del archivo banner
        if ($request->hasFile('banner')) {
            $evento->banner = $request->file('banner')->store('banners', 'public');
        }

        // Guardar el evento en la base de datos
        $evento->save();

        return redirect()->route('crearEvento')->with('success', 'Evento creado con éxito!');
    }

public function show($id)
{
    $evento = Event::with('category', 'user')->findOrFail($id);
    return view('evento', compact('evento'));
}

public function comprar(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email',
        'telefono' => 'nullable|string|max:20',
        'cantidad' => 'required|integer|min:1',
        'zona' => 'required|string',
    ]);

    $total = $request->cantidad * 600; // Asumiendo precio fijo

    Order::create([
        'event_id' => $id,
        'nombre' => $request->nombre,
        'correo' => $request->correo,
        'telefono' => $request->telefono,
        'cantidad' => $request->cantidad,
        'zona' => $request->zona,
        'total' => $total,
    ]);

    return response()->json(['message' => 'Compra registrada correctamente.']);
}



    
    public function showEventos()
    {
        $eventos = Event::select('id', 'titulo', 'lat', 'lng', 'ubicacion')->get();
        return view('mapa', compact('eventos'));
    }

    public function index()
    {
        $categorias = Categoria::all(); // Para los filtros
        $eventos = Event::with('category')->paginate(6); // Carga las categorías de cada evento

        return view('eventosPersonalizados', compact('eventos', 'categorias'));
    }

    public function ordenar(Request $request)
    {
        $query = Event::with('category');

        // Búsqueda
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where('titulo', 'like', "%{$q}%")
                ->orWhere('ubicacion', 'like', "%{$q}%")
                ->orWhereHas('category', function ($subQuery) use ($q) {
                    $subQuery->where('nombre', 'like', "%{$q}%");
                });
        }

        // Ordenamiento
        switch ($request->input('orden')) {
            case 'nombre':
                $query->orderBy('titulo');
                break;
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            default: // fecha
                $query->orderBy('fecha_inicio', 'asc');
                break;
        }

        $eventos = $query->paginate(6)->appends($request->query());

        $categorias = \App\Models\Categoria::all();

        return view('eventosPersonalizados', compact('eventos', 'categorias'));
    }

    
}

