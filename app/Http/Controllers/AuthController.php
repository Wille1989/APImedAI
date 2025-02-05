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

            return response()->json(['message' => 'New user registered'], 201);

        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([ 
            'email' => 'requiered | email',
            'password' => 'requiered',

            try{
                $user = User::where('email', $reqeust->email->first());

                if(!$user || !Hash::check($request->password, $user->password)){
                    throw ValidationException::withMessages([
                        'message' => ['The provided credentials are incorrect'],
                    ]);
                }

            } catch(\Exception $e){
                return response()->json(['message'])
            }
        ])
    }


}
