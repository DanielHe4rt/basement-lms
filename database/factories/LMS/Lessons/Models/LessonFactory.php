<?php

namespace Database\Factories\LMS\Lessons\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use LMS\Lessons\Models\Lesson;
use LMS\Modules\Models\Module;
use LMS\User\Models\User;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'module_id' => Module::factory(),
            'type_id' => rand(1,3),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(7),
            'content' => '',
            'duration' => null
        ];
    }
}
