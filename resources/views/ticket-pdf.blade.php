<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrada PDF</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .ticket {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border: 2px dashed #7c3aed;
            border-radius: 10px;
            background: #f9f5ff;
            padding: 24px;
            position: relative;
        }

        .ticket h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #5b21b6;
        }

        .details {
            font-size: 14px;
            line-height: 1.6;
        }

        .details p {
            margin: 4px 0;
        }

        .details strong {
            color: #4c1d95;
        }

        .qr {
            position: absolute;
            top: 24px;
            right: 24px;
            background: #fff;
            padding: 8px;
            border-radius: 6px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
        }

        .qr img {
            display: block;
            width: 120px;
            height: 120px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 30px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="ticket">
    <h1>Entrada para {{ $order->event->titulo }}</h1>

    <div class="qr">
        @php
            $qrText = urlencode('https://onlyplans.com/ticket/'.$order->id);
            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data={$qrText}&size=200x200";
        @endphp
        <img src="{{ $qrUrl }}" alt="QR Code">
    </div>

    <div class="details">
        <p><strong>Zona:</strong> {{ $order->zona }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($order->event->fecha)->isoFormat('D [de] MMMM [de] YYYY') }}</p>
        <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($order->event->hora_inicio)->format('H:i') }}</p>
        <p><strong>Cantidad:</strong> {{ $order->cantidad }} {{ $order->cantidad > 1 ? 'Entradas' : 'Entrada' }}</p>
        <p><strong>Asistentes:</strong> {{ $order->cantidad }} {{ $order->cantidad > 1 ? 'Personas' : 'Persona' }}</p>
        <p><strong>Total:</strong> {{ number_format($order->total, 2) }} €</p>
        <p><strong>Código de acceso:</strong> #{{ strtoupper(substr(md5($order->id), 0, 8)) }}</p>
    </div>

    <div class="footer">
        Por favor, presenta esta entrada al ingresar al evento. Es válida para una sola persona y no es transferible.
    </div>
</div>

</body>
</html>
