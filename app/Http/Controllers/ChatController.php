<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $message = $request->input('message');

        // Emitir evento
        broadcast(new MessageSent($message));

        return response()->json(['status' => 'ok']);
    }
}
