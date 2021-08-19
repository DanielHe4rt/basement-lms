<?php


namespace LMS\Modules;


use LMS\Core\Contracts\DomainInterface;
use LMS\Modules\Providers\ModulesProvider;

class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            ModulesProvider::class
        ];
    }
}
