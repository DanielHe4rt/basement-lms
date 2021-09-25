<?php

namespace LMS\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use LMS\Dashboard\Repositories\DashboardRepository;

class ViewController extends Controller
{
    private DashboardRepository $repository;

    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewDashboard(): View
    {
        $hero = $this->repository->getHeroCardInformation();
        return view('dashboard::dashboard', compact('hero'));
    }
}
