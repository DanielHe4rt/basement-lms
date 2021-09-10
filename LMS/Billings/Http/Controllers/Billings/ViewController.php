<?php

namespace LMS\Billings\Http\Controllers\Billings;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use LMS\Billings\Repositories\Billings\BillingRepository;

class ViewController extends Controller
{
    private BillingRepository $repository;

    public function __construct(BillingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewBillings(): View
    {
        $billings = $this->repository->getUserBillings(Auth::user()->id);
        return view('billings::billings', compact('billings'));
    }
}
