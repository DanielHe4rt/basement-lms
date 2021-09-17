<?php

namespace LMS\Landing\Providers;

use Carbon\Laravel\ServiceProvider;

class LandingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'landing');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'landing');
    }
}
