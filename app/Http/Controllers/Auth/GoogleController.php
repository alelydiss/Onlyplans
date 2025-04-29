<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Obtener el usuario de Google
        $googleUser = Socialite::driver('google')->user();

        // Buscar si el usuario ya existe
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Si no existe, creamos un nuevo usuario
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(uniqid()), // Contraseña random
                'avatar' => $googleUser->getAvatar(), // Guardamos la foto de perfil
            ]);
        }

        // Iniciar sesión
        Auth::login($user);

        // Redirigir al dashboard o la página principal
        return redirect()->intended('/dashboard');
    }
}
