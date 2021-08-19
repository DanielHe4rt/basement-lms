<?php


namespace LMS\Modules\Providers;


use Illuminate\Support\ServiceProvider;

class ModulesProvider extends ServiceProvider
{
    public function boot() {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'modules');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'modules');
    }
}
