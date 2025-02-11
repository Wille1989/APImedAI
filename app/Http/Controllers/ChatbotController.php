<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {

        $message = $request->input('message');

        $response = Http::post('http://localhost:11434/api/generate',
        [
        'model' => 'mistral',
        'prompt' => $message,
        'stream' => false
        ]); 

        $botResponse = $response->json()['response'] ?? 'No Response from AI';

        // Skicka tillbaka användaren med svaret
        return back()->with('response', $botResponse);
    }
}
