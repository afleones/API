<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatMessageSent;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {   
        $data = $request->all();

        // Lógica para enviar el mensaje
        $user = auth()->user(); // Supongamos que obtienes al usuario actual
        $message = $request->$data['message']; // Obtén el mensaje del formulario


        // Emite un evento para notificar a otros usuarios sobre el nuevo mensaje
        event(new ChatMessageSent($user, $message));

        // Otras acciones después de enviar el mensaje

        return response()->json(['message' => 'Mensaje enviado']);
    }

    public function getChatHistory(Request $request)
    {
        // Lógica para cargar el historial de chat
    }
}
