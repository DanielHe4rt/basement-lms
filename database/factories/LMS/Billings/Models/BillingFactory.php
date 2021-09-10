<?php

namespace Database\Factories\LMS\Billings\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use LMS\Billings\Models\Billing;
use LMS\Billings\Models\Provider;
use LMS\Billings\Models\Subscription;
use LMS\User\Models\User;

class BillingFactory extends Factory
{
    protected $model = Billing::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'provider_id' => Provider::factory(),
            'subscription_id' => Subscription::factory(),
            'user_id' => User::factory(),
            'status' => 'pending',
            'data' => null,
            'paid_at' => null
        ];
    }
}
