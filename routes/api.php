<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use Laravel\Sanctum\Sanctum;

// Hämta inloggad användare (kräver autentisering med Sanctum)
Route::middleware('auth:sanctum')->group(function(){
   
    Route::get('/user', function (Request $request)
    {
        return response()->json($request->user());
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/chat', [ChatbotController::class, 'api.chat']);
});

// API-authentication routes
Route::post('/register', [AuthController::class, 'register'])->name('api.register');

Route::post('/login', [AuthController::class, 'login'])->name('api.login');


