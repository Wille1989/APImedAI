<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate
        ([
            'name' => 'requiered | string', 
            'email' => 'requiered | email | unique:users',
            'password' => 'requiered | confirmed | min:8',
        ]);

        try 
        {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['message' => 'New user Registered'], 201);

        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }
}
