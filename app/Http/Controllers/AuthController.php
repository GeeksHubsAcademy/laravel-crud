<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $body = $request->all();
        $validator = Validator::make($body, [
            'name' => 'string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,}$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'There was a problem trying to register the user'
            ], 400);
        }
        //Hash utiliza bcrypt por detrás
        $body['password'] = Hash::make($body['password']);
        //req.body.password = await bcrypt.hash(req.body.password,10)
        return User::create($body);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Wrong credentials'], 400);
        }
        $user = Auth::user();
        $token = $user->createToken('authToken')->accessToken;
        return response()->json(['token' => $token, 'user' => $user], 200);
    }
}
