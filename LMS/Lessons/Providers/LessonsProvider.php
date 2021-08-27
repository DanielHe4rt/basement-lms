<?php

namespace LMS\Lessons\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LMS\Lessons\View\Components\Lesson;
use LMS\Lessons\View\Components\Types\Article;
use LMS\Lessons\View\Components\Types\Video;

class LessonsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'lessons');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'lessons');
        Blade::component('lessons', Lesson::class);
        Blade::component('lesson-video', Video::class);
        Blade::component('lesson-article', Article::class);
    }
}
