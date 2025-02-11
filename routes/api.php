<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Sanctum\Sanctum;
use App\Http\Controllers\ChatbotController;


// Hämta inloggad användare (kräver autentisering med Sanctum)
Route::middleware('auth:sanctum')->group(function(){
   
    Route::get('/user', function (Request $request)
    {
        return response()->json($request->user());
    });

    Route::post('/chat', [ChatbotController::class, 'chat']);
});

// API-authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Ändrat till POST

Route::get('/test', function () {
    return response()->json(['message' => 'API fungerar!']);
});