<?php

namespace LMS\Billings\Http\Controllers\Billings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        try {
            $this->repository->pay($request->validated());
        } catch (\Exception $exception) {
            Log::error('[Billing Payment Error]', [
                'message' => $exception->getMessage()
            ]);
            return response()->json([
                'errors' => ['internal' => [$exception->getMessage()]]
            ]);
        }

    }

    public function getCallback(Request $request, string $provider)
    {
        $this->repository->processCallback($provider, $request->all());

    }
}
