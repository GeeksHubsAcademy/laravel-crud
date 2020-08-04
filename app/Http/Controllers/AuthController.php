<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    public function logout(Request $request)
    {
        // $request->user() es lo mismo que Auth::user() o req.user en nodeJS
        $request->user()->token()->revoke();
        // DB::table('oauth_access_tokens')->where('revoked',1)->delete();
        return response([
            'mensaje' => 'User successfully logged out'
        ]);
    }
    public function sendResetPasswordEmail($email)
    {
        $user = User::where('email', $email)->first();
        if($user)
        {
            Mail::to($email)->send(new ResetPassword($user));
        }
        return ['message' => 'A email was sent to your email box'];
    }
}
