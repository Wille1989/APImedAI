<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function(Request $request)
{
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])
->middleware('auth:sanctum');


Route::post('/test', function (Request $request)
{
    $data = $request->test;

    dump($data);

    return response()->json(['message' => "It Works!: $data"]);
});

Route::get('/getRouteTest', function(Request $request)
{
    return response()->json(['message' => "Hello from the API"]);
});

Http::get()