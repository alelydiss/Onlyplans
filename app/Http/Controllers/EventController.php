<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Order;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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
        $evento->precio = $request->tipo_evento === 'gratis' ? 0 : $request->precio;
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

        return redirect()->route('mapa')->with('success', 'Evento creado con éxito!');
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

    // Obtener el evento y su precio
    $evento = Event::findOrFail($id);
    $precioTicket = $evento->precio ?? 0;

    $total = $request->cantidad * $precioTicket;

    Order::create([
        'event_id' => $id,
        'nombre' => $request->nombre,
        'correo' => $request->correo,
        'telefono' => $request->telefono,
        'cantidad' => $request->cantidad,
        'zona' => $request->zona,
        'total' => $total,
        'user_id' => Auth::id()
    ]);

    return response()->json(['message' => 'Compra registrada correctamente.']);
}



        public function mostrar($id = null)
    {
        if ($id) {
            // Mostrar un evento específico
            $evento = Event::with('category', 'user')->findOrFail($id);
            return view('evento', compact('evento'));
        } else {
            // Mostrar todos los eventos en el mapa
            $eventosmapa = Event::all();
            return view('mapa', compact('eventosmapa'));
        }
    }

    public function index(Request $request)
{
    $query = Event::with('category');

    // Búsqueda por título, ubicación o nombre de categoría
    if ($request->filled('q')) {
        $q = $request->input('q');
        $query->where(function ($subQuery) use ($q) {
            $subQuery->where('titulo', 'like', "%{$q}%")
                     ->orWhere('ubicacion', 'like', "%{$q}%")
                     ->orWhereHas('category', function ($catQuery) use ($q) {
                         $catQuery->where('nombre', 'like', "%{$q}%");
                     });
        });
    }

    // Filtro por precio
    if ($request->has('precio')) {
        $precios = $request->input('precio');
        if (in_array('gratis', $precios) && !in_array('pago', $precios)) {
            $query->where('precio', 0);
        } elseif (in_array('pago', $precios) && !in_array('gratis', $precios)) {
            $query->where('precio', '>', 0);
        }
        // Si ambos están marcados, no se aplica filtro
    }

    // Filtro por fecha
    if ($request->has('fecha')) {
        $fechas = $request->input('fecha');
        $today = now()->startOfDay();

        if (in_array('hoy', $fechas)) {
            $query->whereDate('fecha_inicio', $today);
        } elseif (in_array('semana', $fechas)) {
            $query->whereBetween('fecha_inicio', [$today, $today->copy()->endOfWeek()]);
        } elseif (in_array('mes', $fechas)) {
            $query->whereBetween('fecha_inicio', [$today, $today->copy()->endOfMonth()]);
        }
    }

    // Filtro por categorías
    if ($request->has('categorias')) {
        $query->whereIn('category_id', $request->input('categorias'));
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
        default:
            $query->orderBy('fecha_inicio', 'asc');
    }

    // Paginar y mantener parámetros
    $eventos = $query->paginate(6)->appends($request->query());
    $categorias = Categoria::all();

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

    public function chat(Request $request, Event $evento)
    {
        // Aquí recibes el mensaje y lo procesas
        $mensaje = $request->input('mensaje');

        // Guardar mensaje en BD o emitir evento para broadcast, ejemplo simple:
        // Suponiendo que tienes modelo Message con user_id, event_id, message, etc.
        $chatMessage = $evento->messages()->create([
            'user_id' => Auth::id(),
            'message' => $mensaje,
        ]);

        // Retorna OK para frontend
        return response()->json(['status' => 'ok', 'message' => $mensaje]);
    }


public function misEntradas()
{
    $orders = Order::with('event')->where('user_id', Auth::id())->latest()->get();
    return view('tickets', compact('orders'));
}



public function downloadTicket($orderId)
{
    $order = Order::with('event')->findOrFail($orderId);

    $pdf = Pdf::loadView('ticket-pdf', compact('order'));

    return $pdf->download('entrada_' . $order->id . '.pdf');
}


public function generarPDF($orderId)
{
    $order = Order::with('event')->findOrFail($orderId);

    // Generar URL del QR
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode('https://onlyplans.com/ticket/' . $order->id) . '&size=200x200';

    // Pasar a la vista
    $pdf = PDF::loadView('tickets.pdf', compact('order', 'qrUrl'));

    return $pdf->stream('entrada.pdf');
}

public function mostrarPreferencias()
{
    $user = Auth::user();

    $preferences = $user->preferences;

    $query = Event::query();

    foreach ($preferences as $pref) {
        switch ($pref->category) {
            case 'categoría':
                // Aquí asumimos que el campo "value" contiene el nombre de la categoría
                $query->whereHas('category', function ($q) use ($pref) {
                    $q->where('nombre', $pref->value);
                });
                break;

            case 'precio':
                if (strtolower($pref->value) === 'gratis') {
                    $query->where('precio', 0);
                } else {
                    $query->where('precio', '>', 0);
                }
                break;

            case 'date':
                $hoy = Carbon::today();

                if (strtolower($pref->value) === 'hoy') {
                    $query->whereDate('fecha_inicio', $hoy);
                } elseif (strtolower($pref->value) === 'esta semana') {
                    $query->whereBetween('fecha_inicio', [$hoy, $hoy->copy()->endOfWeek()]);
                } elseif (strtolower($pref->value) === 'este mes') {
                    $query->whereBetween('fecha_inicio', [$hoy, $hoy->copy()->endOfMonth()]);
                }
                break;
        }
    }

    if ($preferences->isEmpty()) {
    $eventosPreferencias = Event::latest()->take(9)->get();
} else {

    $eventosPreferencias = $query->latest()->take(9)->get();
}
    return view('dashboard', compact('eventosPreferencias'));
    
}
    
}

