<?php

namespace LMS\Billings\Providers;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'billings');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'billings');
    }
}
