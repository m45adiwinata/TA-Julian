<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(!Auth::check()) {
            return redirect('/login');
        }
        $data['page'] = 'home';
        return view('home', $data);
    }
}
