<?php

namespace LMS\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use LMS\User\Http\Requests\UpdateMeRequest;
use LMS\User\Repositories\MeRepository;

class MeController extends Controller
{
    private MeRepository $repository;

    public function __construct(MeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function putMe(UpdateMeRequest $request): Response
    {
        $this->repository->updateBaseInformation($request->validated());
        return response()->noContent();
    }
}
