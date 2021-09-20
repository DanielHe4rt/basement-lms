<?php


namespace Database\Factories\LMS\Courses\Models;


use Illuminate\Database\Eloquent\Factories\Factory;
use LMS\User\Models\User;
use LMS\Courses\Models\Course;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'author_id' => User::factory()->create(),
            'status_id' => 1,
            'course_level_id' => 1,
            'title' => $this->faker->title,
            'subtitle' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'paid' => false,
            'published_at' => null,
            'slug' => $this->faker->slug(3),
        ];
    }
}
