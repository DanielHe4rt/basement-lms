<?php

namespace LMS\Billings\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use LMS\Billings\Models\Plan;

class ViewController extends Controller
{
    public function viewSubscriptions(): View
    {
        $plans = Plan::orderBy('interval')
            ->get();
        return view('billings::subscriptions', compact('plans'));
    }
}
