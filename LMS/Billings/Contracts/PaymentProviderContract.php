<?php

namespace LMS\Billings\Contracts;

interface PaymentProviderContract
{
    public function authenticate(): array;

    public function createPlan(string $name, int $interval): array;

    public function createSubscription($planId, string $name, float $price): array;
}
