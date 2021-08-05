<?php


namespace LMS\Core\Contracts;


abstract class DomainInterface
{
    protected bool $disabled = false;

    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function registerProvider(): array
    {
        return [];
    }
}
