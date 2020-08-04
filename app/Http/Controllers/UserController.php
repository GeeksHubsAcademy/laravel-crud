<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getBirthdate()
    {
        //req.user es Auth::user() o $request->user()
        $user = Auth::user();
        $birthdate = new Carbon($user->birthdate); //fecha de cumple
        $now = Carbon::now(); //fecha de hoy
        $birthdate->year = $now->year;
        $difference = ($birthdate->diff($now)->days < 1) //diferencia en días entre hoy y el cumple
            ? 'today is your birthdate! :)'
            : $birthdate->diffForHumans($now);
        return ['message' => 'Hi ' . $user->name . ' ' . $difference];
    }
}
