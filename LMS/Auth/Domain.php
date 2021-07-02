<?php

namespace LMS\Auth;

use LMS\Core\Contracts\DomainInterface;

class Domain extends DomainInterface {

    public function registerProvider(): array
    {
        return [
            \Spatie\Permission\PermissionServiceProvider::class,
            \LMS\Auth\Providers\AuthServiceProvider::class
        ];
    }

}
