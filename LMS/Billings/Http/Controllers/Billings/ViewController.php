<?php

namespace LMS\Billings\Http\Controllers\Billings;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function viewBillings(): View
    {
        $billings = Auth::user()->billings()->orderByDesc('created_at');
        return view('billings::billings', compact('billings'));
    }
}
