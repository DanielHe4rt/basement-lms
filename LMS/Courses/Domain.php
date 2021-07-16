<?php


namespace LMS\Courses;


use LMS\Core\Contracts\DomainInterface;
use LMS\Courses\Providers\CourseServiceProvider;

class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            CourseServiceProvider::class
        ];
    }
}
