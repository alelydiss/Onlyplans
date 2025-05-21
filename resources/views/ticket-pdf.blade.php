<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrada PDF</title>
    <style>
    .ticket {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        background: linear-gradient(135deg, #f9f5ff 0%, #f0ebff 100%);
        padding: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .ticket:before {
        content: "";
        position: absolute;
        top: 0;
        left: 30%;
        width: 40%;
        height: 5px;
        background: #7c3aed;
    }

    .ticket h1 {
        text-align: center;
        font-size: 28px;
        margin: 15px 0 25px;
        color: #5b21b6;
        font-weight: 600;
        letter-spacing: -0.5px;
    }

    .event-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #e0e0e0;
    }

    .details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        font-size: 15px;
        margin-bottom: 20px;
    }

    .detail-item {
        padding: 8px 0;
        border-bottom: 1px dashed #d1d5db;
    }

    .detail-item strong {
        display: block;
        color: #4c1d95;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .qr-container {
        text-align: center;
        margin: 25px 0;
        padding: 15px;
        background: white;
        border-radius: 8px;
        display: inline-block;
        border: 1px solid #e0e0e0;
    }

    .ticket-number {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #5b21b6;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .footer {
        text-align: center;
        font-size: 12px;
        margin-top: 25px;
        color: #666;
        line-height: 1.5;
        padding-top: 15px;
        border-top: 1px solid #e0e0e0;
    }
</style>

<div class="ticket">
    <div class="ticket-number">ENTRADA #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
    
    <h1>{{ $order->event->titulo }}</h1>
    
    <div class="details">
        <div class="detail-item">
            <strong>FECHA</strong>
            {{ \Carbon\Carbon::parse($order->event->fecha)->isoFormat('D MMM YYYY') }}
        </div>
        <div class="detail-item">
            <strong>HORA</strong>
            {{ \Carbon\Carbon::parse($order->event->hora_inicio)->format('H:i') }}h
        </div>
        <div class="detail-item">
            <strong>ZONA</strong>
            {{ $order->zona }}
        </div>
        <div class="detail-item">
            <strong>ENTRADAS</strong>
            {{ $order->cantidad }} {{ $order->cantidad > 1 ? 'unidades' : 'unidad' }}
        </div>
        <div class="detail-item">
            <strong>TOTAL</strong>
            {{ number_format($order->total, 2) }} €
        </div>
        <div class="detail-item">
            <strong>CÓDIGO</strong>
            #{{ strtoupper(substr(md5($order->id), 0, 8)) }}
        </div>
    </div>

    <div class="qr">
        @php
            $qrText = urlencode('https://onlyplans.com/ticket/'.$order->id);
            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data={$qrText}&size=200x200";
        @endphp
        <img src="{{ $qrUrl }}" alt="QR Code">
    </div>

    <div class="footer">
        <strong>IMPORTANTE:</strong> Esta entrada es personal e intransferible. Deberás presentarla impresa o en tu dispositivo móvil al acceder al evento. OnlyPlans no se hace responsable de entradas perdidas o robadas.
    </div>
</div>

</body>
</html>
