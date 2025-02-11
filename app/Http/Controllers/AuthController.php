<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required | string', 
            'email' => 'required | email | unique:users',
            'password' => 'required | confirmed | min:8',
        ]);

        try 
        {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('accessToken')->plainTextToken;

            return response()->json([
                'message' => 'New user registered',
                'user' => $user,
                'accessToken' => $token
            ]);

        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([ 
            'email' => 'required|email',
            'password' => 'required',
        ]);

            try
            {
                $user = User::where('email', $request->email)->first();

                if(!$user || !Hash::check($request->password, $user->password)){
                    throw ValidationException::withMessages([
                        'message' => ['The provided credentials are incorrect'],
                    ]);
                }

                $token = $user->createToken('accessToken')->plainTextToken;

               return response()->json([
                'message' => 'Login Successful',
                'user' => $user,
                'accessToken' => $token
               ]);

            } catch(\Exception $e){
                return response()->json(['message' => $e->getMessage()], 401);
            }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged Out'], 200);
    }
}