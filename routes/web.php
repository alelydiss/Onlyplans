<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EventController;
use App\Models\Categoria;
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
    // Obtener las categorías directamente en la ruta
    $categorias = Categoria::all();
    return view('dashboard', compact('categorias')); // Pasar las categorías a la vista
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

Route::get('/evento/{id}', [EventController::class, 'mostrar'])->name('evento');

Route::get('/eventosPersonalizados', function () {
    return view('eventosPersonalizados');
})->name('eventosPersonalizados');

Route::get('/eventosPersonalizados', [EventController::class, 'index'])->name('eventosPersonalizados');

Route::get('/eventos', [EventController::class, 'ordenar'])->name('eventos');

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

// // routes/web.php
// Route::post('/chat/send', [ChatController::class, 'send'])->middleware('auth');
// Route::middleware('auth')->post('/send-message', [ChatController::class, 'send']);
// Route::post('/send-message', function (Request $request) {
//     $request->validate(['message' => 'required|string']);

//     $message = Message::create([
//         'user_id' => auth()->id(),
//         'message' => $request->message,
//     ]);

//     broadcast(new MessageSent($message))->toOthers();

//     return response()->json(['status' => 'ok']);
// })->middleware('auth');



Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

