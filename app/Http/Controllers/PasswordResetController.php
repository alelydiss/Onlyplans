<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomResetPasswordMail;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function enviarCorreoReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese correo.']);
        }

        $token = Password::createToken($user);

        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        Mail::to($user->email)->send(new CustomResetPasswordMail($url, $user));

        return back()->with('status', 'Te hemos enviado un correo para restablecer tu contraseña.');
    }
}
