<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatHistory;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'session_id' => 'nullable|uuid',
        ]);

        $session_id = $request->session_id ?? Str::uuid();

        $userMessage = ChatHistory::create([
            'user_id' => $request->user()->id,  // Inloggad användare
            'session_id' => $session_id,
            'user_message' => $request->message,
            'bot_response' => '',
        ]);

        // Generera botens svar (exempel)
        $botResponseText = "Jag är en bot! Jag fick ditt meddelande: " . $request->message;

        // Uppdatera botens svar
        $userMessage->update(['bot_response' => $botResponseText]);

        return response()->json([
            'message' => 'Chat message saved',
            'session_id' => $session_id,
            'user_message' => $userMessage->user_message,
            'bot_response' => $botResponseText,
        ], 201);
    }
}
