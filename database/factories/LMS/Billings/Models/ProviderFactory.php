<?php

namespace Database\Factories\LMS\Billings\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use LMS\Billings\Models\Provider;

class ProviderFactory extends Factory
{
    protected $model = Provider::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->slug,
            'image' => $this->faker->image(),
            'active' => true
        ];
    }
}
