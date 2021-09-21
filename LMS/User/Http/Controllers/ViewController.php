<?php

namespace LMS\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ViewController extends Controller
{
    public function viewProfile(): View
    {
        $user = Auth::user();
        return view('user::profile', compact('user'));
    }
}
