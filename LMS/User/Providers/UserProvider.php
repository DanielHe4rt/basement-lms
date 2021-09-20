<?php


namespace LMS\User\Providers;


use Illuminate\Support\ServiceProvider;
use Gate;
use LMS\User\Models\User;
use LMS\User\Observers\UserObserver;

class UserProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'user');
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin')) {
                return true;
            }
        });

        User::observe(UserObserver::class);
    }
}
