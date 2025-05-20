<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->input('preferences');

        // Eliminar las preferencias anteriores del usuario
        UserPreference::where('user_id', $user->id)->delete();

        // Guardar las nuevas
        foreach ($data as $pref) {
            UserPreference::create([
                'user_id' => $user->id,
                'category' => $pref['category'],
                'value' => $pref['value'],
            ]);
        }

        return response()->json(['message' => 'Preferencias guardadas correctamente']);
    }
}
