<?php

namespace LMS\Billings\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function viewCard(): View
    {
        $card = Auth::user()->card()->orderByDesc('id')->first();
        return view('billings::card', compact('card'));
    }
}
