<?php


namespace LMS\Auth\Http\Controllers;


use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function viewLogin()
    {
        return view('auth::login');
    }

    public function viewRegister()
    {
        return view('auth::register');
    }
}
