<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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
            'password' => 'required|string|regex:^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,12}$'
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
}
