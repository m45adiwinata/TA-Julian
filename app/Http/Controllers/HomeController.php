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
        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Home';
        $data['sub_link'] = '/';
        return view('home', $data);
    }
}
