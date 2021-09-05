<?php

namespace LMS\Billings\Repositories\Plans;

use Illuminate\Support\Facades\DB;
use LMS\Billings\Models\Plan;
use LMS\Billings\Repositories\AbstractRepository;

class PlanRepository extends AbstractRepository
{
    private Plan $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Plan();
    }

    public function createPlan(array $payload)
    {
        return DB::transaction(function() use ($payload) {
            $provider = $this->getProvider();
            $provider->authenticate();
            $plan = $provider->createPlan(
                $payload['name'],
                $payload['interval']
            );
            $subscription = $provider->createSubscription(
                $plan['id'],
                $payload['name'],
                $this->formatPrice($payload['price'])
            );
            $payload['data'] = $plan['id'];
            $payload['provider_id'] = $this->provider;

            $plan = $this->model->create($payload);
            $plan->subscription()
                ->create([
                    'data' => $subscription['id'],
                    'price' => $payload['price']
                ]);

            return $plan->load('subscription');
        });
    }

    public function getPlans() {
        return $this->model->where('provider_id', $this->provider)->paginate();
    }

    private function formatPrice(string $price): string
    {
        return str_replace(['.',','], '', $price);
    }
}
