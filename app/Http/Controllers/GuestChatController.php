<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class GuestChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:200', // Säkerställer att meddelandet är giltigt
        ]);

        try {
            $response = Http::timeout(15)->post('http://localhost:11434/api/generate', [
                'model' => 'mistral',
                'prompt' => $request->input('message'),
                'stream' => false
            ]);

            if ($response->failed()) {
                throw ValidationException::withMessages([
                    'message' => 'ChatBot do not respond'
                ]);
            }

            $botResponse = $response->json()['response'] ?? 'No response from AI';

        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'message' => 'Couldnt get a response from ChatBot'
            ]);
        }

        return back()->with('response', $botResponse);
    }
}
