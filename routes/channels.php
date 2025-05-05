<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat', function ($user) {
    return true; // Permitir que cualquiera escuche (en pruebas)
});
