<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoritoController;
use App\Models\Categoria;
use App\Models\Event;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\Message;


Route::get('/', function () {
    // Obtener las categorías directamente en la ruta
    $categorias = Categoria::all();
    return view('welcome', compact('categorias')); // Pasar las categorías a la vista
})->name('welcome');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');

Route::get('/dashboard', function () {
    $categorias = Categoria::all();
    $eventos = Event::latest()->take(6)->get();
    return view('dashboard', compact('categorias', 'eventos'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mapa', function () {
    return view('mapa');
})->name('mapa');

Route::get('/mapa', [EventController::class, 'mostrar'])->name('mapa');

require __DIR__.'/auth.php';

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');


Route::get('/evento', function () {
    return view('evento');
})->name('evento');

Route::post('/evento/{evento}/favorito', [FavoritoController::class, 'toggle'])->middleware('auth')->name('evento.favorito');

Route::get('/evento/{id}', [EventController::class, 'mostrar'])->name('evento');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/eventos/{id}/comprar', [EventController::class, 'procesarCompra'])
         ->name('eventos.comprar');
});
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
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/categorias', [AdminCategoriaController::class, 'index'])->name('admin.categorias');
    Route::get('/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios');
    Route::get('/eventos', [AdminEventoController::class, 'index'])->name('admin.eventos');
});

Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos');
