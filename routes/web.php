<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\Admin\AdminUsuarioController;
use App\Http\Controllers\Admin\AdminEventoController;
use App\Http\Controllers\Admin\AdminCategoriaController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PagoController;
use App\Models\Categoria;
use App\Models\Event;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Actividad;
use App\Events\MessageSent;
use App\Http\Controllers\Admin\AdminTicketController;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    // Obtener las categorías directamente en la ruta
    $categorias = Categoria::all();
     $eventos = Event::latest()->take(6)->get();
    return view('welcome', compact('categorias', 'eventos'));
})->name('welcome');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');

Route::get('/dashboard', [EventController::class, 'mostrarDashboard'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mapa', function () {
    return view('mapa');
})->name('mapa');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');


Route::get('/intereses', function () {
    $categorias = Categoria::all();
    return view('intereses', compact('categorias'));
})->name('intereses');


Route::get('/mapa', [EventController::class, 'mostrar'])->name('mapa');

require __DIR__.'/auth.php';

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');


Route::get('/evento', function () {
    return view('evento');
})->name('evento');

Route::post('/evento/{evento}/favorito', [FavoritoController::class, 'toggle'])->middleware('auth')->name('evento.favorito');

Route::get('/evento/{id}', [EventController::class, 'mostrar'])->name('evento');

# MIS  ENTRADAS
Route::get('/mis-tickets', [App\Http\Controllers\EventController::class, 'misEntradas'])->name('tickets.index')->middleware('auth');

#DESCARGAR ENTRADAS
Route::get('/ticket/download/{order}', [App\Http\Controllers\EventController::class, 'downloadTicket'])->name('ticket.download');




Route::get('/eventosPersonalizados', function () {
    return view('eventosPersonalizados');
})->name('eventosPersonalizados');

Route::get('/eventosPersonalizados', [EventController::class, 'index'])->name('eventosPersonalizados');

// RUTA CORRECTA PARA FILTROS Y LISTADO
Route::get('/eventos', [EventController::class, 'index'])->name('eventos');


Route::get('/crearEvento', function () {
    $categorias = Categoria::all();
    return view('crearEvento', compact('categorias'));
})->middleware('auth')->name('crearEvento');

Route::get('/crearEvento', [EventController::class, 'create'])->name('crearEvento'); // Mostrar formulario
Route::post('/crearEvento', [EventController::class, 'store']); // Guardar evento


Route::get('/password/success', function () {
    return view('auth.passwords.success');
})->name('password.success');

Route::get('/categorias', [CategoriaController::class, 'index']);

Route::post('/eventos/{evento}/chat', [EventController::class, 'chat'])->name('eventos.chat');

Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {

        $totalUsuarios = User::count();
        $eventosTotales = Event::count();
        $ticketsVendidos = Order::sum('cantidad');
        $ingresosTotales = Order::sum('total');
        $totalCategorias = Categoria::count();

        // Categorías más populares
        $categoriasPopulares = Categoria::select('categorias.id', 'categorias.nombre', DB::raw('COUNT(events.id) as total_eventos'))
            ->leftJoin('events', 'categorias.id', '=', 'events.category_id')
            ->groupBy('categorias.id', 'categorias.nombre')
            ->orderByDesc('total_eventos')
            ->get();

        $totalEventos = $categoriasPopulares->sum('total_eventos');

        // Eventos próximos
        $eventosProximos = Event::with('category')
            ->whereDate('fecha_inicio', '>=', Carbon::today())
            ->orderBy('fecha_inicio')
            ->take(5)
            ->get()
            ->map(function ($evento) {
                $ticketsVendidos = Order::where('event_id', $evento->id)->sum('cantidad');
                $evento->ticketsVendidos = $ticketsVendidos;
                return $evento;
            });
            // Últimos 7 días
    $ventasPorDia = Order::where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
    ->selectRaw('DATE(created_at) as fecha, SUM(cantidad) as total')
    ->groupBy('fecha')
    ->orderBy('fecha')
    ->get();

// Formatear datos para el gráfico
$fechas = [];
$tickets = [];

$periodo = \Carbon\CarbonPeriod::create(now()->subDays(6), now());
foreach ($periodo as $date) {
    $formato = $date->format('Y-m-d');
    $fechas[] = $date->format('d M');
    $venta = $ventasPorDia->firstWhere('fecha', $formato);
    $tickets[] = $venta ? $venta->total : 0;
}

$eventosPorRevisar = Event::where('revisado', false)->take(5)->get();
$actividadesRecientes = Actividad::orderBy('fecha', 'desc')->paginate(6);

return view('admin.dashboard', compact(
    'totalUsuarios',
    'eventosTotales',
    'ticketsVendidos',
    'ingresosTotales',
    'totalCategorias',
    'categoriasPopulares',
    'totalEventos',
    'fechas',
    'tickets',
    'eventosProximos',
    'eventosPorRevisar',
    'actividadesRecientes'
));
    })->name('admin.dashboard');

    /* EVENTOS */
    Route::get('/eventos', [AdminEventoController::class, 'index'])->name('admin.eventos');
    Route::get('/eventos/pendientes', [AdminEventoController::class, 'pendientes'])->name('admin.eventos.pendientes');
    Route::put('/eventos/{evento}/aprobar', [AdminEventoController::class, 'aprobar'])->name('admin.eventos.aprobar');
    Route::delete('/eventos/{evento}/rechazar', [AdminEventoController::class, 'rechazar'])->name('admin.eventos.rechazar');
    Route::get('/eventos/{id}', [AdminEventoController::class, 'mostrar'])->name('admin.eventos.mostrar');
    Route::put('/eventos/{evento}', [AdminEventoController::class, 'update'])->name('admin.eventos.update');
    Route::delete('/eventos/{evento}', [AdminEventoController::class, 'destroy'])->name('admin.eventos.destroy');


    /* USUARIOS */
    Route::get('/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios');
    Route::post('/usuarios', [AdminUsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::put('/usuarios/{usuario}', [AdminUsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/usuarios/{usuario}', [AdminUsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');


    /* CATEGORIAS */
    Route::get('/categorias', [AdminCategoriaController::class, 'index'])->name('admin.categorias');
    Route::post('/categorias', [AdminCategoriaController::class, 'store'])->name('admin.categorias.store');
    Route::put('/categorias/{categoria}', [AdminCategoriaController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/categorias/{categoria}', [AdminCategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

    /* TICKETS */
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets');

});


Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos');

Route::post('/guardar-preferencias', [UserPreferenceController::class, 'store'])->name('preferencias.store');

Route::get('/obtener-preferencias', [UserPreferenceController::class, 'getUserPreferences'])->name('obtener-preferencias');

Route::get('/usuarios/totales', [UsuarioController::class, 'totales'])->name('usuarios.totales');

Route::post('/evento/{evento}/checkout', [PagoController::class, 'checkout'])->name('eventos.checkout');
Route::get('/evento/{evento}/checkout/success', [PagoController::class, 'success'])->name('eventos.checkout.success');
