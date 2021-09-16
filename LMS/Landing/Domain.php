<?php


namespace LMS\Landing;


use LMS\Core\Contracts\DomainInterface;
use LMS\Landing\Providers\LandingServiceProvider;

class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            LandingServiceProvider::class
        ];
    }
}
