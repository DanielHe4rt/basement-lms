<?php

namespace LMS\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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

    public function putMe(UpdateMeRequest $request): JsonResponse
    {
        $this->repository->updateBaseInformation($request->validated());
        return response()->json(['message' => 'Informações atualizadas com sucesso!'],Response::HTTP_CREATED);
    }
}
