<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    public function toggle(Request $request, $eventoId)
    {
        $user = Auth::user();

        // Verificamos si ya está marcado como favorito
        $favorito = Favorito::where('user_id', $user->id)
                            ->where('evento_id', $eventoId)
                            ->first();

        if ($favorito) {
            $favorito->delete(); // Si ya existe, lo quitamos
            return response()->json(['favorito' => false]);
        } else {
            Favorito::create([
                'user_id' => $user->id,
                'evento_id' => $eventoId,
            ]);
            return response()->json(['favorito' => true]);
        }
    }

    public function index()
    {
        $user = Auth::user();
        $eventos = $user->eventosFavoritos()->latest()->get();

        return view('favoritos', compact('eventos'));
    }

}
