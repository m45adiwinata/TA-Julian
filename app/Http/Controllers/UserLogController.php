<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserLogController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where(['name' => $request->name, 'password' => $request->password])->get()->first();
        if($user) {
            Auth::login($user);
            return redirect('/');
        }
        else {
            return redirect('/login')->with('fail', 'Username dan password salah.');
        }
    }
}
