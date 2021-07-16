<?php


namespace LMS\User\Providers;


use Illuminate\Support\ServiceProvider;
use Gate;

class UserProvider extends ServiceProvider
{

    public function boot()
    {
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin')) {
                return true;
            }
        });
    }
}
