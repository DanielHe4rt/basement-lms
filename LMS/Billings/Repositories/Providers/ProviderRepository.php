<?php

namespace LMS\Billings\Repositories\Providers;

use LMS\Billings\Models\Provider;

class ProviderRepository
{
    private Provider $model;

    public function __construct()
    {
        $this->model = new Provider();
    }

    public function activateProvider(Provider $provider): bool
    {
        foreach ($this->model->all() as $providerItem) {
            $providerItem->turnOff();
        }
        $provider->turnOn();
        return true;
    }

}
