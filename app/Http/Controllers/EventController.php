<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Order;
use App\Models\Categoria;
use App\Models\Asiento;
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
        // Validación
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
            'ubicacion' => 'nullable|string|max:255',
            'necesita_asientos' => 'required|boolean',
            'cantidad_asientos' => 'required_if:necesita_asientos,1|nullable|integer|min:1',

        ]);

        // Guardar evento
        $evento = new Event();
        $evento->user_id = Auth::id();
        $evento->category_id = $request->categoria;
        $evento->titulo = $request->titulo;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->fecha_fin;
        $evento->hora_inicio = $request->hora_inicio;
        $evento->hora_fin = $request->hora_fin;
        $evento->tipo_evento = $request->tipo_evento;
        $evento->precio = $request->tipo_evento === 'gratis' ? 0 : $request->precio;
        $evento->descripcion = $request->descripcion;
        $evento->ubicacion = $request->ubicacion;
        $evento->lat = $request->latitud;
        $evento->lng = $request->longitud;
        $evento->necesita_asientos = $request->necesita_asientos;
        $evento->numero_asientos = $request->necesita_asientos ? $request->cantidad_asientos : null;

        if ($request->hasFile('banner')) {
            $evento->banner = $request->file('banner')->store('banners', 'public');
        }

        $evento->save();

        // Crear asientos si es necesario
        if ($request->necesita_asientos && $request->cantidad_asientos > 0) {
            $total = $request->cantidad_asientos;

            $zonas = [
                'vip' => round($total * 0.10),
                'palcos' => round($total * 0.15),
                'pista' => round($total * 0.35),
                'grada' => round($total * 0.40),
            ];

            $contador = 1;
            foreach ($zonas as $zona => $cantidad) {
                for ($i = 0; $i < $cantidad; $i++) {
                    Asiento::create([
                        'events_id' => $evento->id,
                        'numero' => $contador++,
                        'zona' => $zona,
                        'estado' => 'disponible',
                    ]);
                }
            }
        }
        return redirect()->route('mapa')->with('success', 'Tu evento ha sido creado. Cuando sea revisado, será visible aquí.');
    }

    public function index(Request $request)
    {
        $query = Event::with('category')->where('revisado', 1);

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

        if ($request->has('categoria')) {
            $categoriaId = $request->input('categoria');
            $query->where('category_id', $categoriaId);
        } elseif ($request->has('categorias')) {
            $categoriasIds = $request->input('categorias');
            $query->whereIn('category_id', $categoriasIds);
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
                case 'category':
                    // value guarda el ID de la categoría
                    $query->orWhere('category_id', $pref->value);
                    break;

                case 'price':
                    if (strtolower($pref->value) === 'gratis') {
                        $query->orWhere('precio', 0);
                    } else {
                        $query->orWhere('precio', '>', 0);
                    }
                    break;

                case 'date':
                    $hoy = Carbon::today();

                    if (strtolower($pref->value) === 'hoy') {
                        $query->orWhereDate('fecha_inicio', $hoy);
                    } elseif (strtolower($pref->value) === 'esta semana') {
                        $query->orWhereBetween('fecha_inicio', [$hoy, $hoy->copy()->endOfWeek()]);
                    } elseif (strtolower($pref->value) === 'este mes') {
                        $query->orWhereBetween('fecha_inicio', [$hoy, $hoy->copy()->endOfMonth()]);
                    }
                    break;
            }
        }

        $eventosPersonalizados = $query->latest()->take(9)->get();

        $eventos = Event::latest()->take(9)->get(); // Eventos normales
        $categorias = Categoria::all();

        return view('dashboard', compact('eventos', 'categorias', 'eventosPersonalizados'));
    }

    private function obtenerEventosPersonalizados($user)
{
    $preferences = $user->preferences;
    $query = Event::query();

    $categoryPrefs = $preferences->where('category', 'category')->pluck('value');
    $pricePrefs = $preferences->where('category', 'price')->pluck('value');
    $datePrefs = $preferences->where('category', 'date')->pluck('value');

    if ($preferences->isNotEmpty()) {
        if ($categoryPrefs->isNotEmpty()) {
            $query->whereIn('category_id', $categoryPrefs);
        }

        if ($pricePrefs->isNotEmpty()) {
            $query->where(function ($q) use ($pricePrefs) {
                foreach ($pricePrefs as $value) {
                    if (strtolower($value) === 'gratis') {
                        $q->orWhere('precio', 0);
                    } else {
                        $q->orWhere('precio', '>', 0);
                    }
                }
            });
        }

        if ($datePrefs->isNotEmpty()) {
            $hoy = Carbon::today();
            $query->where(function ($q) use ($datePrefs, $hoy) {
                foreach ($datePrefs as $value) {
                    $value = strtolower($value);
                    if ($value === 'hoy') {
                        $q->orWhereDate('fecha_inicio', $hoy);
                    } elseif ($value === 'esta semana') {
                        $q->orWhereBetween('fecha_inicio', [$hoy, $hoy->copy()->endOfWeek()]);
                    } elseif ($value === 'este mes') {
                        $q->orWhereBetween('fecha_inicio', [$hoy, $hoy->copy()->endOfMonth()]);
                    }
                }
            });
        }

        return $query->latest()->take(6)->get();
    }

    return collect(); // vacío si no hay preferencias
}

public function mostrarDashboard()
{
    $user = Auth::user();
    $categorias = Categoria::all();
    $eventos = Event::where('revisado', 1)->latest()->take(6)->get();
    $eventosPersonalizados = $this->obtenerEventosPersonalizados($user)->where('revisado', 1);

    return view('dashboard', compact('categorias', 'eventos', 'eventosPersonalizados'));
}

public function mostrar($id = null)
{
    if ($id) {
        // Cargar evento solo si está revisado
        $evento = Event::with('category', 'user', 'asientos')
            ->where('revisado', 1)
            ->findOrFail($id);

        // Agrupar los asientos por zona, estructurando para Alpine.js
        $asientosAgrupados = $evento->asientos
            ->groupBy('zona')
            ->map(function ($asientos) {
                return $asientos->map(fn ($a) => [
                    'id' => $a->id,
                    'numero' => $a->numero,
                    'estado' => $a->estado,
                ])->values();
            });

        // Obtener eventos personalizados si el usuario está autenticado
        $eventosPersonalizados = collect();
        if (Auth::check()) {
            $user = Auth::user();
            $eventosPersonalizados = $this->obtenerEventosPersonalizados($user)
                ->reject(fn ($eventoPersonalizado) => $eventoPersonalizado->id == $id);
        }

        return view('evento', [
            'evento' => $evento,
            'eventosPersonalizados' => $eventosPersonalizados,
            'asientosAgrupados' => $asientosAgrupados,
        ]);
    } else {
        // Solo mostrar eventos revisados en el mapa
        $eventosmapa = Event::where('revisado', 1)->get();
        return view('mapa', compact('eventosmapa'));
    }
}



}