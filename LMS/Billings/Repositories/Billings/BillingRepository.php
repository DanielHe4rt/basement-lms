<?php

namespace LMS\Billings\Repositories\Billings;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use LMS\Billings\Models\Billing;
use LMS\Billings\Models\Plan;
use LMS\Billings\Repositories\AbstractRepository;
use LMS\Billings\Transformers\Payment\GerenciaNet\BillingOutputTransformer;
use LMS\Billings\Transformers\Payment\GerenciaNet\BillingTransformer;
use LMS\Billings\Transformers\Payment\GerenciaNet\PaymentTransformer;
use LMS\User\Models\User;
use Money\Money;

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
        $plan = Plan::find($payload['plan_id']);

        if (!$plan) {
            throw new \Exception('Plano não encontrado');
        }

        $servicePayload = app(PaymentTransformer::class)->handle($payload);
        $service = $this->getProvider();
        $service->authenticate();

        $platformName = config('app.name') ?: 'LMS';
        $changeName = sprintf('%s - %s', $platformName, $plan->name);
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

    public function processCallback(string $provider, array $payload)
    {
        match ($provider) {
            'gerencianet' => $this->gerenciaNetCallback($payload['notification'])
        };
    }

    private function gerenciaNetCallback(string $notificationToken)
    {

        $service = $this->getProvider();
        $service->authenticate();
        $result = $service->getSubscriptionInformation($notificationToken)['data'];
        $lastResult = $result[count($result) - 1];

        $subscriptionId = $lastResult['identifiers']['subscription_id'];
        $status = $lastResult['status']['current'];

        $billing = Billing::where('data', $subscriptionId)->first();
        $this->handleSubscription($billing, $status);

    }

    private function handleSubscription(Billing $billing, mixed $status)
    {
        if ($status == 'paid') {
            $billing->paid();

            if (!$billing->user->hasRole('subscriber')) {
                $billing->user->assignRole('subscriber');
            }
        }
    }

    public function getUserBillings($id)
    {
        $billings = User::find($id)
            ->billings()
            ->orderByDesc('created_at')
            ->get();
        if (!$billings) {
            throw new \Exception('n tem nada aqui');
        }

        $provider = $this->getProvider();
        $provider->authenticate();

        $result = [];

        foreach ($billings as $billing) {
            $payload = $provider->getSubscription($billing->data);
            $result[] = app(BillingOutputTransformer::class)->handle($payload);
        }
        return $result;
    }

}
