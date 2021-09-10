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

    public function activateProvider(Provider $provider): void
    {
        $this->turnProvidersOff();
        $provider->turnOn();
    }

    private function turnProvidersOff(): void
    {
        foreach ($this->model->all() as $providerItem) {
            $providerItem->turnOff();
        }
    }

}
