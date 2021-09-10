<?php

namespace LMS\Billings\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ViewController extends Controller
{
    public function __construct()
    {
    }

    public function viewProviders(): View
    {
        return view('billings::providers');
    }
}
