<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirige a Google para iniciar sesión.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Procesa la respuesta de Google.
     */
    public function handleGoogleCallback()
    {
        try {
            // Obtenemos los datos del usuario desde Google
            $googleUser = Socialite::driver('google')->user();

            // Buscamos si ya existe un usuario con ese email
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(24)), // Contraseña aleatoria
                ]
            );

            // Autenticamos al usuario
            Auth::login($user);

            // Redirigimos al dashboard
            return redirect()->intended('/dashboard');

        } catch (Exception $e) {
            // Si hay error, redirige al login con un mensaje
            return redirect('/login')->with('error', 'No se pudo iniciar sesión con Google.');
        }
    }
}
