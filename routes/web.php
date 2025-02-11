<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\GuestChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function()
{
    return view('auth.register');
})->name('auth.register');

Route::get('/login', function()
{
    return view('auth.login');
})->name('auth.login');

Route::get('/chat', function()
{
    return view ('guest.chat');
})->name('guest.chat');

Route::post('/chat', [GuestChatController::class, 'chat'])->name('chat.send');