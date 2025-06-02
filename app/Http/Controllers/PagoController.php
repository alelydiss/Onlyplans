<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Event;
use App\Models\Order;
use App\Models\Asiento;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    
public function checkout(Request $request, Event $evento)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Entrada para ' . $evento->titulo,
                ],
                'unit_amount' => $evento->precio * 100,
            ],
            'quantity' => (int) $request->cantidad,
        ]],
        'mode' => 'payment',
        'success_url' => route('eventos.checkout.success', $evento->id) . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => url()->previous(),
        'metadata' => [
            'evento_id' => $evento->id,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'cantidad' => $request->cantidad,
            'asientos' => json_encode($request->asientos),
        ],
    ]);

    return response()->json(['id' => $session->id]);
}



public function success(Request $request, Event $evento)
{
    Stripe::setApiKey(config('services.stripe.secret'));
    $session = Session::retrieve($request->session_id);

    if ($session && $session->payment_status === 'paid') {
        $metadata = $session->metadata;

        // Crear la orden
        Order::create([
            'event_id' => $metadata->evento_id ?? null,
            'nombre' => $metadata->nombre ?? '',
            'correo' => $metadata->correo ?? '',
            'telefono' => $metadata->telefono ?? '',
            'cantidad' => $metadata->cantidad ?? 1,
            'asientos' => $metadata->asientos ?? '[]',
            'total' => $evento->precio * ($metadata->cantidad ?? 1),
            'user_id' => optional(Auth::user())->id,
        ]);

        // Cambiar estado de los asientos seleccionados
        $asientos = json_decode($metadata->asientos ?? '[]', true);
        if (is_array($asientos) && count($asientos) > 0) {
           Asiento::whereIn('id', $asientos)
            ->where('estado', 'disponible')
            ->update(['estado' => 'reservado']);
        }

        \App\Models\Actividad::create([
            'descripcion' => ($metadata->cantidad ?? 1) . ' tickets vendidos para ' . $evento->titulo,
            'icono' => 'fas fa-ticket-alt',
            'fecha' => now(),
        ]);
    }

    return redirect()->route('tickets.index')->with('success', '¡Compra realizada con éxito!');
}




}
