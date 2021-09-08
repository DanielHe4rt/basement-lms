<?php

namespace LMS\Billings\Repositories\Billings;

use Illuminate\Support\Facades\Auth;
use LMS\Billings\Models\Billing;
use LMS\Billings\Models\Plan;
use LMS\Billings\Repositories\AbstractRepository;
use LMS\Billings\Transformers\Payment\GerenciaNet\BillingTransformer;
use LMS\Billings\Transformers\Payment\GerenciaNet\PaymentTransformer;

class BillingRepository extends AbstractRepository
{
    private Billing $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Billing();
    }

    public function pay(array $payload)
    {
        $servicePayload = app(PaymentTransformer::class)->handle($payload);

        $service = $this->getProvider();
        $service->authenticate();
        $plan = Plan::find($payload['plan_id']);
        $changeName = config('app.name') . ' - ' . $plan->name;
        $subscription = $service->createSubscription(
            $plan->data,
            $changeName,
            $this->formatPrice($plan->price)
        );

        $result = $service->makePayment($subscription['id'], $servicePayload);
        $payload = app(BillingTransformer::class)->handle($payload, $result);
        $payload['provider_id'] = $this->provider;

        return $this->model->create($payload);
    }

    private function formatPrice(string $price): string
    {
        return str_replace(['.', ','], '', $price);
    }
}
