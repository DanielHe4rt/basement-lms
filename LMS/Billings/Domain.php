<?php


namespace LMS\Billings;


use LMS\Billings\Providers\BillingServiceProvider;
use LMS\Core\Contracts\DomainInterface;


class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            BillingServiceProvider::class
        ];
    }
}
