<?php

namespace App\Http\Controllers;
    // app/Http/Controllers/ChatController.php
    use App\Models\Message;
    use App\Events\MessageSent;
    use Illuminate\Http\Request;

class ChatController extends Controller
{


public function send(Request $request)
{
    $message = Message::create([
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return response()->json(['status' => 'Mensaje enviado']);
}

}
