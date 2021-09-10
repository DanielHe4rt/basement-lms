<?php

namespace LMS\Billings\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use LMS\Billings\Models\Plan;
use LMS\Billings\Repositories\Subscriptions\SubscriptionRepository;

class ViewController extends Controller
{
    private SubscriptionRepository $repository;

    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewSubscriptions(): View
    {
        $plans = $this->repository->getSubscriptions();
        return view('billings::subscriptions', compact('plans'));
    }
}
