@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10 min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Mis Tickets</h1>

    @if($orders->isEmpty())
        <p class="text-gray-600">No has comprado tickets todavía.</p>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="border p-4 rounded-lg bg-white dark:bg-gray-800 shadow">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <h2 class="text-xl font-semibold">{{ $order->event->titulo }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($order->event->fecha)->format('d M Y') }}<br>
                                <strong>Hora:</strong> {{ \Carbon\Carbon::parse($order->event->hora_inicio)->format('H:i') }}<br>
                                <strong>Zona:</strong> {{ $order->zona }}<br>
                                <strong>Cantidad:</strong> {{ $order->cantidad }}<br>
                                <strong>Total:</strong> {{ number_format($order->total, 2) }} €
                            </p>
                        </div>
                        <img src="{{ $order->event->banner ? asset('storage/' . $order->event->banner) : asset('img/evento6.png') }}" class="w-32 h-20 object-cover rounded-lg" />
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
