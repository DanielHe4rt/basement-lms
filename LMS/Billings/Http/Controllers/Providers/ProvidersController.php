<?php

namespace LMS\Billings\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use LMS\Billings\Models\Provider;
use LMS\Billings\Repositories\Providers\ProviderRepository;

class ProvidersController extends Controller
{

    private ProviderRepository $repository;

    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function putProvider(Provider $provider): JsonResponse
    {
        $this->repository->activateProvider($provider);

        return response()->json($provider->refresh());
    }
}
