<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LMS\Courses\Models\Status;
use LMS\Lessons\Enums\LessonTypes;
use LMS\Lessons\Models\Lesson;
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
                'description' => 'Curso de Introdução ao framework Laravel. Nesse curso você vai dominar na prática os principais conceitos desse Framework que é um dos mais utilizado no mundo PHP.<br>

Laravel é um framework PHP livre e open-source criado por Taylor B. Otwell para o desenvolvimento de sistemas web que utilizam o padrão MVC (model, view, controller). Algumas características proeminentes do Laravel são sua sintaxe simples e concisa, um sistema modular com gerenciador de dependências dedicado, várias formas de acesso a banco de dados relacionais e vários utilitários indispensáveis no auxílio ao desenvolvimento e manutenção de sistemas.<br>

Atualmente, o Laravel é considerado o maior Framework PHP existente. Esse status se dá devido à agilidade de programação de sistemas complexos envolvendo grande quantidade de recursos, tais como segurança, acesso a dados e arquitetura da aplicação. Todas essas características, que são básicas a qualquer sistema web, são fornecidas nativamente pelo Laravel de modo simples e intuitivo.<br>

Você tem a possibilidade de construir aplicações com autenticação e cadastros em questão de minutos. Sem contar que não precisa dominar técnicas de autenticação e muito menos saber SQL para realizar tal tarefa.<br>

Neste curso abordaremos os recursos que o Laravel oferece e você estará apto a agilizar o desenvolvimento de seus sistemas.',
                'slug' => 'laravel4noobs',
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
                'slug' => 'php4noobs',
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
                $module = $course->modules()->create($module);
                $lessons = Lesson::factory()->count(5)->create([
                    'type_id' => LessonTypes::VIDEO,
                    'module_id' => $module->id,
                    'content' => '{"streamingUrls":[{"protocol":"Hls","url":"https:\/\/basement-brso.streaming.media.azure.net\/\/3ac22ab0-2936-4939-9b80-89e48ac24fb1\/ig-arguments-2.ism\/manifest(format=m3u8-aapl)"},{"protocol":"Dash","url":"https:\/\/basement-brso.streaming.media.azure.net\/\/3ac22ab0-2936-4939-9b80-89e48ac24fb1\/ig-arguments-2.ism\/manifest(format=mpd-time-csf)"},{"protocol":"SmoothStreaming","url":"https:\/\/basement-brso.streaming.media.azure.net\/\/3ac22ab0-2936-4939-9b80-89e48ac24fb1\/ig-arguments-2.ism\/manifest"}],"info":{"status":"done","percent":"100","asset":"1-1-744936e1-fd3b-4357-a027-a65fc17fd07e-21-36-13_Output_20210915-213613","locator":"locator-20210915-213658"}}',
                    'duration' => 17
                ]);

                foreach ($lessons as $lesson) {
                    $lesson->addMediaFromUrl($image)
                        ->toMediaCollection();
                }
            }
        }

    }
}
