<?php


namespace LMS\Courses\Providers;


use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'courses');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'courses');
    }
}
