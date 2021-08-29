<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LMS\Lessons\Models\Type;

class LessonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Video',
            'Text',
            'Quiz'
        ];

        foreach ($types as $type) {
            Type::create([
                'name' => $type,
                'slug' => Str::slug($type)
            ]);
        }
    }
}
