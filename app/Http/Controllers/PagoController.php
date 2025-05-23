<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Event;
use App\Models\Order;
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
                'unit_amount' => $evento->precio * 100, // en céntimos
            ],
            'quantity' => $request->cantidad,
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
            'zona' => $request->zona,
        ],
    ]);

    return response()->json(['id' => $session->id]);
}


public function success(Request $request, Event $evento)
{
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    $session = \Stripe\Checkout\Session::retrieve($request->session_id);

    if ($session && $session->payment_status === 'paid') {
        // Verifica que la orden no se haya guardado ya (evita duplicados)
        $existingOrder = Order::where('correo', $session->metadata->correo)
            ->where('event_id', $session->metadata->event_id)
            ->where('zona', $session->metadata->zona)
            ->first();

        if (!$existingOrder) {
           $metadata = $session->metadata;

            Order::create([
                'event_id' => $metadata['evento_id'] ?? null,
                'nombre' => $metadata['nombre'] ?? '',
                'correo' => $metadata['correo'] ?? '',
                'telefono' => $metadata['telefono'] ?? '',
                'cantidad' => $metadata['cantidad'] ?? 1,
                'zona' => $metadata['zona'] ?? '',
                'total' => $evento->precio * ($metadata['cantidad'] ?? 1),
                'user_id' => optional(Auth::user())->id,
            ]);
        }
    }

    return redirect()->route('tickets.index')->with('success', '¡Compra realizada con éxito!');
}


}
