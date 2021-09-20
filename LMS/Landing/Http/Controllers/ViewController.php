<?php

namespace LMS\Landing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use LMS\Landing\Repositories\LandingRepository;

class ViewController extends Controller
{
    private LandingRepository $repository;

    public function __construct(LandingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewLandingPage(): View
    {
        $landingData = $this->repository->retrieveData();

        return view('landing::welcome', compact('landingData'));
    }
}
