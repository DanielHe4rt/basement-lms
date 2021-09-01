<?php


namespace LMS\Modules\Providers;


use App\View\Components\LectureModules;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ModulesProvider extends ServiceProvider
{
    public function boot() {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'modules');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'modules');

        Blade::component('lecture-modules', LectureModules::class);
    }
}
