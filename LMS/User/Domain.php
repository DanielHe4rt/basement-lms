<?php


namespace LMS\User;


use LMS\Core\Contracts\DomainInterface;
use LMS\User\Providers\UserProvider;

class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            UserProvider::class
        ];
    }
}
