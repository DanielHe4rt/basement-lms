<?php

namespace LMS\Billings\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use LMS\Billings\Repositories\Plans\PlanRepository;

class ViewController extends Controller
{
    private PlanRepository $repository;

    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewPlans(): View
    {
        $plans = $this->repository->getPlans();
        return view('billings::plans', compact('plans'));
    }
}
