<?php


namespace LMS\Lessons;


use LMS\Core\Contracts\DomainInterface;
use LMS\Lessons\Providers\LessonsProvider;


class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            LessonsProvider::class
        ];
    }
}
