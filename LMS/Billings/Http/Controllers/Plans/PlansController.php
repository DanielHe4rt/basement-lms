<?php

namespace LMS\Billings\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LMS\Billings\Http\Requests\Plans\CreatePlanRequest;
use LMS\Billings\Repositories\Plans\PlanRepository;

class PlansController extends Controller
{
    private PlanRepository $repository;

    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postPlan(CreatePlanRequest $request)
    {
        try {
            $result = $this->repository->createPlan($request->validated());
            return response()->json($result);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

    }

}
