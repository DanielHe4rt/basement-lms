<?php

namespace LMS\Dashboard;

use LMS\Core\Contracts\DomainInterface;
use LMS\Dashboard\Providers\DashboardServiceProvider;

class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            DashboardServiceProvider::class
        ];
    }
}
