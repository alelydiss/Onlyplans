<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class UsuarioController extends Controller
{
   public function totales()
{
    $total = User::count();

    $ayer = Carbon::yesterday();
    $usuariosAyer = User::whereDate('created_at', '<=', $ayer)->count();

    $incremento = $usuariosAyer > 0
        ? (($total - $usuariosAyer) / $usuariosAyer) * 100
        : 0;

    return response()->json([
        'total' => $total,
        'incremento' => round($incremento, 2),
    ]);
}
}
