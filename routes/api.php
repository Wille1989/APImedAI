<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\GuestChatController;
use Laravel\Sanctum\Sanctum;

// Hämta inloggad användare (kräver autentisering med Sanctum)
Route::middleware('auth:sanctum')->group(function(){
   
    Route::get('/user', function (Request $request)
    {
        return response()->json($request->user());
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/user/chat', [ChatbotController::class, 'userChat'])->name('user.chat');
});

// API-authentication routes
Route::post('/register', [AuthController::class, 'register'])->name('api.register');

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::post('/guest/chat', [GuestChatController::class, 'chat'])->name('guest.chat');