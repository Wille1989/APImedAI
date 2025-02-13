<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\ChatHistory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class ChatbotController extends Controller
{
    public function userChat(Request $request)
    {

        $user= auth()->user();

        $session_id = $request->session_id;


        if (!$session_id && $user) { 
            $latestSession = ChatHistory::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->value('session_id');
        
            if ($latestSession) {
                $session_id = $latestSession; 
            } else {
                $session_id = (string) Uuid::uuid4();
            }
        }

        $request->validate([
            'message' => 'required|string|max:200',
            'session_id' => 'nullable|uuid',
        ]);

        logger('Session ID used:', ['session_id' => $session_id]);
        

        $chatHistory = ChatHistory::where('session_id', $session_id)
            ->orderBy('created_at', 'asc')
            ->get(['user_message', 'bot_response']);

        
        $messages = [];
        
        foreach ($chatHistory as $chat){
            $messages[] = ['role' => 'user', 'content' => $chat->user_message];
            $messages[] = ['role' => 'assistant', 'content' => $chat->bot_response];
        }

        $messages[] = ['role' => 'user', 'content' => $request->message];

        $response = $this->sendToLLM($messages);

        ChatHistory::create([
            'user_id' => $user ? $user->id : null,
            'session_id' => $session_id,
            'user_message' => $request->message,
            'bot_response' => $response,
        ]);

        return response()->json([
            'session_id' => $session_id,
            'response' => $response
        ]);

    }

    private function sendToLLM($messages)
{
    try {
        $response = Http::post('http://localhost:11434/api/chat', [
            'model' => 'mistral',
            'messages' => $messages,
            'stream' => false,
        ]);

        if ($response->failed()) {
            return 'ChatBot did not respond.';
        }

        return $response->json()['message']['content'] ?? 'No response from AI';

    } catch (\Exception $e) {
        return 'Error communicating with ChatBot: ' . $e->getMessage();
    }
}

}