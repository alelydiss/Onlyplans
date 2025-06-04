<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;

class AdminEventoController extends Controller
{
    /**
     * Mostrar todos los eventos (revisados o no).
     */
    public function index()
    {
    $eventosRevisados = Event::where('revisado', true)->orderBy('fecha_inicio', 'desc')->get();
    $eventosPorRevisar = Event::where('revisado', false)->orderBy('fecha_inicio', 'desc')->get();

    return view('admin.eventos', compact('eventosRevisados', 'eventosPorRevisar'));
    }

    /**
     * Aprobar un evento.
     */
    public function aprobar(Event $evento)
    {
        $evento->revisado = true;
        $evento->save();

        return redirect()->back()->with('success', 'Evento aprobado correctamente.');
    }

    /**
     * Rechazar un evento (lo elimina).
     */
    public function rechazar(Event $evento)
    {
        $evento->delete();

        return redirect()->back()->with('success', 'Evento rechazado y eliminado.');
    }

    /**
     * Mostrar solo eventos pendientes de revisión.
     */
    public function pendientes()
    {
        $eventosPorRevisar = Event::where('revisado', false)->get();
        return view('admin.eventos.pendientes', compact('eventosPorRevisar'));
    }

    /**
     * Mostrar detalle de un evento específico (sin importar si está aprobado).
     * Si no se pasa ID, muestra todos los eventos en el mapa.
     */


public function mostrar($id = null)
{
    if ($id) {
        $evento = Event::with('category', 'user', 'asientos')->findOrFail($id);

        $asientosAgrupados = $evento->asientos
            ->groupBy('zona')
            ->map(function ($asientos) {
                return $asientos->map(fn ($a) => [
                    'id' => $a->id,
                    'numero' => $a->numero,
                    'estado' => $a->estado,
                ])->values();
            });

        // Aquí obtienes las categorías para el select
        $categorias = Categoria::all();

        return view('admin.evento', [
            'evento' => $evento,
            'asientosAgrupados' => $asientosAgrupados,
            'categorias' => $categorias,   // <-- PASAR LA VARIABLE
        ]);
    } else {
        $eventosmapa = Event::all();
        return view('admin.mapa', compact('eventosmapa'));
    }
}

public function destroy(Event $evento)
{
    $evento->delete();
    return redirect()->route('admin.eventos')->with('success', 'Evento eliminado correctamente.');
}

public function update(Request $request, Event $evento)
{
    $data = $request->validate([
        'titulo' => 'required|string|max:255',
        'category_id' => 'required|exists:categorias,id',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'precio' => 'nullable|numeric|min:0',
        'ubicacion' => 'nullable|string|max:255',
        'descripcion' => 'nullable|string',
        'banner' => 'nullable|image|max:2048',
         'revisado' => 'required|boolean',
    ]);

    // Si subieron una imagen, guárdala
    if ($request->hasFile('banner')) {
        $path = $request->file('banner')->store('public/banners');
        $data['banner'] = str_replace('public/', '', $path);
    }
    $evento->revisado = $request->input('revisado');
    $evento->update($data);

    return redirect()->back()->with('success', 'Evento actualizado correctamente.');
}

}
