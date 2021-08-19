<?php


namespace Database\Factories\LMS\Modules\Models;


use Illuminate\Database\Eloquent\Factories\Factory;
use LMS\Modules\Models\Module;
use LMS\User\Models\User;
use LMS\Courses\Models\Course;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'name' => $this->faker->streetName,
            'description' => $this->faker->sentence,
            'order' => 0
        ];
    }
}
