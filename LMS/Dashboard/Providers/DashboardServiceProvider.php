<?php

namespace LMS\Dashboard\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LMS\Dashboard\View\Components\DashboardHero;

class DashboardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'dashboard');
        Blade::component(DashboardHero::class, 'dashboard-hero');
    }
}
