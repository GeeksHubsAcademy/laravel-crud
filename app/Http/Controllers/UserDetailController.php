<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function index()
    {
        $user = Auth::user();
       return $user->load('user_detail');
    }
}
