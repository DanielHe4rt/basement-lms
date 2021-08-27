<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(CourseLevelsSeeder::class);
        $this->call(CourseStatusSeeder::class);
        $this->call(LessonTypeSeeder::class);
    }
}
