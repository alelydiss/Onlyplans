<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ChatController;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\Message;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mapa', function () {
    return view('mapa');
})->name('mapa');

require __DIR__.'/auth.php';

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/evento', function () {
    return view('evento');
});

Route::get('/eventosPersonalizados', function () {
    return view('eventosPersonalizados');
})->name('eventosPersonalizados');

Route::get('/password/success', function () {
    return view('auth.passwords.success');
})->name('password.success');

// routes/web.php
Route::post('/chat/send', [ChatController::class, 'send'])->middleware('auth');
Route::middleware('auth')->post('/send-message', [ChatController::class, 'send']);
Route::post('/send-message', function (Request $request) {
    $request->validate(['message' => 'required|string']);

    $message = Message::create([
        'user_id' => auth()->id(),
        'message' => $request->message,
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return response()->json(['status' => 'ok']);
})->middleware('auth');



Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

