<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LMS\Courses\Models\Status;
use LMS\User\Models\User;

class SystemBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'status_id' => 1,
                'course_level_id' => 1,
                'title' => 'Laravel4Noobs - Guia Introdutório ao PHP',
                'subtitle' => 'Domine os Fundamentos do Laravel 8 entendendo Views, Controllers, FormRequest, Eloquent, e Artisan CLI!',
                'description' => 'foudase',
                'paid' => 1,
                'image' => 'https://img-c.udemycdn.com/course/750x422/3958978_91d3_3.jpg',
                'modules' => [
                    [
                        'name' => 'Introdução',
                        'description' => 'Quem sou eu',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Pré Requisitos',
                        'description' => 'O que você precisa para esse curso',
                        'order' => 2,
                    ]
                ]
            ],
            [
                'status_id' => 1,
                'course_level_id' => 1,
                'title' => 'PHP4Noobs - Guia Introdutório ao PHP',
                'subtitle' => 'Aprenda os fundamentos básicos PHP de um jeito rápido e didático!',
                'description' => 'foudase',
                'paid' => 1,
                'image' => 'https://img-c.udemycdn.com/course/750x422/3147678_221a_2.jpg',
                'modules' => [
                    [
                        'name' => 'Introdução',
                        'description' => 'Quem sou eu',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Pré Requisitos',
                        'description' => 'O que você precisa para esse curso',
                        'order' => 2,
                    ]
                ]
            ],
        ];
        $user = User::factory()->create(['email' => 'admin@admin.com']);
        $user->assignRole('admin');

        foreach ($courses as $course) {
            $modules = $course['modules'];
            $image = $course['image'];
            unset($course['modules']);
            unset($course['image']);

            $course = $user->courses()->create($course);
            $course->addMediaFromUrl($image)
                ->toMediaCollection();

            foreach ($modules as $module) {
                $course->modules()->create($module);
            }
        }

    }
}
