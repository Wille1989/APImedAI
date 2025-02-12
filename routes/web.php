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




Route::middleware(['web'])->post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['web'])->post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['web'])->post('/logout', [AuthController::class, 'logout'])->name('logout');




// FÖR INLOGGAD ANVÄNDARE

Route::middleware('auth')->get('/user/index', function()
{
    return view('user.index')->name('user.index');
});

Route::middleware('auth')->get('/chat', function () {
    return view('user.chat');
})->name('user.chat');



// FÖR GÄST

Route::get('/guest/chat', function () {
    return view('guest.chat');
})->name('guest.chat');

Route::post('/guest/chat/send', [GuestChatController::class, 'chat'])
->name('guest.chat.send');