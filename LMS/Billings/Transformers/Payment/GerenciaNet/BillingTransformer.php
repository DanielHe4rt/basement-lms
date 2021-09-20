<?php

namespace LMS\Billings\Transformers\Payment\GerenciaNet;

use Ramsey\Uuid\Uuid;

class BillingTransformer
{
    public function handle(array $payload, array $callback): array
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => \Auth::user()->id,
            'plan_id' => $payload['plan_id'],
            'status' => $callback['data']['charge']['status'],
            'data' => $callback['data']['subscription_id']
        ];
    }
}
