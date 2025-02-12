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

        $user = $request->user();
        if(!$user)
        {
            return response()->json(['error' => 'Unauthorized']);
        }

        $session_id = $request->session_id ?? Str::uuid()->toString();

        $previousMessages = ChatHistory::where('user_id', $user->id)
        ->where('session_id', $session_id)
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(fn($chat) => 
        [
            ['role' => 'user', 'content' => $chat->user_message],
            ['role' => 'assistant', 'content' => $chat->bot_response],
        ])
        ->flatten(1)
        ->toArray();

        $messages = array_merge($previousMessages,
        [
            ['role' => 'user', 'content' => $request->message]
        ]);

        // Skicka meddelandet till Ollama och få svar
        $response = Http::post('http://localhost:11434/api/chat', [
            'model' => 'mistral',
            'messages' => $messages,
            'stream' => false,
        ]);

        $botResponseText = $response->json()['message'] ?? 'Couldnt understand your message';

        $userMessage = ChatHistory::create([
            'user_id' => $request->user()->id,  // Inloggad användare
            'session_id' => $session_id,
            'user_message' => $request->message,
            'bot_response' => $botResponseText,
        ]);

        return response()->json([
            'message' => 'Chat message saved',
            'session_id' => $session_id,
            'user_message' => $userMessage->user_message,
            'bot_response' => $botResponseText,
        ], 201);
    }
}
