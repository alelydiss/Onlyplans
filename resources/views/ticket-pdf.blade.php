<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrada para {{ $order->event->titulo }} | OnlyPlans</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
        }
        
        .ticket-container {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        
        .ticket {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }
        
        .ticket-header {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            padding: 25px 30px;
            position: relative;
            overflow: hidden;
        }
        
        .ticket-header:after {
            content: "";
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: white;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
            transform: scaleY(0.5);
        }
        
        .ticket-number {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .event-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 10px 0;
            line-height: 1.3;
        }
        
        .event-date {
            display: flex;
            align-items: center;
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .event-date svg {
            margin-right: 8px;
        }
        
        .event-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        
        .ticket-body {
            padding: 30px;
            position: relative;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .detail-item {
            padding-bottom: 10px;
            border-bottom: 1px dashed #e2e8f0;
        }
        
        .detail-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-size: 16px;
            font-weight: 500;
            color: #1e293b;
        }
        
        .qr-section {
            text-align: center;
            margin: 30px 0;
        }
        
        .qr-code {
            width: 180px;
            height: 180px;
            margin: 0 auto;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        
        .qr-instructions {
            font-size: 14px;
            color: #64748b;
            margin-top: 15px;
            line-height: 1.5;
        }
        
        .ticket-footer {
            background: #f8fafc;
            padding: 20px 30px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
            line-height: 1.6;
            text-align: center;
        }
        
        .watermark {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0.1;
            font-size: 80px;
            font-weight: 700;
            color: #7c3aed;
            z-index: -1;
        }
        
        .price-tag {
            position: absolute;
            top: -20px;
            right: 30px;
            background: #10b981;
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .seats-badge {
            display: inline-block;
            background: #e9d5ff;
            color: #7c3aed;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket">
            <div class="ticket-header">
                <div class="ticket-number">ENTRADA #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                <h1 class="event-title">{{ $order->event->titulo }}</h1>
                <div class="event-date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    {{ \Carbon\Carbon::parse($order->event->fecha)->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                </div>
                <div class="event-date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    {{ \Carbon\Carbon::parse($order->event->hora_inicio)->format('H:i') }}h
                </div>
            </div>
                        
            <div class="ticket-body">
                @if($order->total > 0)
                <div class="price-tag">{{ number_format($order->total, 2) }} €</div>
                @endif
                
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">Lugar</div>
                        <div class="detail-value">{{ $order->event->ubicacion }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Entradas</div>
                        <div class="detail-value">{{ $order->cantidad }} {{ $order->cantidad > 1 ? 'unidades' : 'unidad' }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Comprado el</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMM YYYY') }}</div>
                    </div>
                </div>
                
                @if(count(json_decode($order->asientos, true) ?? []) > 0)
                <div>
                    <div class="detail-label">Asientos reservados</div>
                    <div class="seats-badge">
                        @foreach(json_decode($order->asientos, true) as $asiento)
                            Asiento {{ $asiento }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="divider"></div>
                
                <div class="qr-section">
                    <div class="detail-label">Código de acceso</div>
                    <div class="detail-value" style="font-size: 18px; margin-bottom: 15px;">#{{ strtoupper(substr(md5($order->id), 0, 8)) }}</div>
                    
                    @php
                        // Generar QR simple con información básica del ticket
                        $qrContent = "ONLYPLANS-TICKET | ";
                        $qrContent .= "Evento: ".$order->event->titulo." | ";
                        $qrContent .= "Referencia: #".$order->id." | ";
                        $qrContent .= "Entradas: ".$order->cantidad;
                        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&format=png&data=".urlencode($qrContent)."&color=5b21b6&bgcolor=f9f5ff";
                    @endphp
                    <div class="qr-code">
                        <img src="{{ $qrUrl }}" alt="Código QR" width="180" height="180">
                    </div>
                    <p class="qr-instructions">Presente este código QR en la entrada del evento para validar su acceso</p>
                </div>
                
                <div class="watermark">ONLYPLANS</div>
            </div>
            
            <div class="ticket-footer">
                <p><strong>IMPORTANTE:</strong> Esta entrada es personal e intransferible. Deberá presentarla impresa o en su dispositivo móvil al acceder al evento. OnlyPlans no se hace responsable de entradas perdidas o robadas.</p>
                <p style="margin-top: 10px;">© {{ date('Y') }} OnlyPlans - Todos los derechos reservados</p>
            </div>
        </div>
    </div>
</body>
</html>