<?php

namespace App\Http\Controllers\Admin;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminEventoController extends Controller
{

        public function index()
    {
        $eventos = Event::all();  // o la lógica que quieras
        return view('admin.eventos.index', compact('eventos'));
    }
    public function aprobar(Event $evento) {
    $evento->revisado = true;
    $evento->save();

    return redirect()->back()->with('success', 'Evento aprobado correctamente.');
}

public function rechazar(Event $evento) {
    $evento->delete();

    return redirect()->back()->with('success', 'Evento rechazado y eliminado.');
}


public function pendientes() {
    $eventosPorRevisar = Event::where('revisado', false)->get();
    return view('admin.eventos.pendientes', compact('eventosPorRevisar'));
}
}
