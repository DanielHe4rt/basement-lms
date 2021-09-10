<?php

namespace LMS\Billings\Http\Controllers\Billings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LMS\Billings\Http\Requests\Billings\CreateBillingRequest;
use LMS\Billings\Repositories\Billings\BillingRepository;

class BillingsController extends Controller
{
    private BillingRepository $repository;

    public function __construct(BillingRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth', ['except' => ['getCallback']]);
    }

    public function postBilling(CreateBillingRequest $request)
    {
        $this->repository->pay($request->validated());
    }

    public function getCallback(Request $request, string $provider)
    {
        $this->repository->processCallback($provider, $request->all());

    }
}
