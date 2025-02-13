<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuestChatController extends Controller
{
    public function chat(Request $request)
    {
        // Validera att meddelandet är ett giltigt string med max längd 200
        $request->validate([
            'message' => 'required|string|max:200',
        ]);

        // Skicka förfrågan till ChatBot API:t
        try {
            $response = Http::post('http://localhost:11434/api/chat', [
                'model' => 'mistral',
                'messages' => [[ 'role' => 'user', 'content' => $request->message ]],
                'stream' => false
            ]);

            // Om förfrågan misslyckades, skicka tillbaka ett fel
            if ($response->failed()) {
                return response()->json([
                    'message' => 'ChatBot did not respond.',
                ], 500);
            }

            $data = $response->json();

            if (!empty($data['message']['content'])) {
                $botResponse = $data['message']['content'];
            } else {
                $botResponse = 'No response from AI';
            }

            return response()->json([
                'user_message' => $request->message,
                'bot_response' => $botResponse
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Could not get a response from ChatBot',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
