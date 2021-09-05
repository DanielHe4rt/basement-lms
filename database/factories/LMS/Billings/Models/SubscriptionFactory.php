<?php

namespace Database\Factories\LMS\Billings\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use LMS\Billings\Models\Subscription;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->slug(2),
            'recurrence' => rand(1, 12),
            'price' => rand(10, 25) . '.00',
            'active' => false,
        ];
    }
}
