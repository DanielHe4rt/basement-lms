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

            $payload['data'] = $plan['id'];
            $payload['provider_id'] = $this->provider;

            return $this->model->create($payload);
        });
    }

    public function getPlans() {
        return $this->model->where('provider_id', $this->provider)->paginate();
    }

}
