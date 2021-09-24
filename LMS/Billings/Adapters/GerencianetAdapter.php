<?php

namespace LMS\Billings\Adapters;

use GuzzleHttp\Exception\ServerException;
use LMS\Billings\Contracts\PaymentProviderContract;
use LMS\Billings\Exceptions\GerencianetException;
use LMS\Billings\Services\Gerencianet\GerencianetService;
use LMS\Billings\Transformers\Payment\GerenciaNet\ResponseErrorTransformer;

class GerencianetAdapter implements PaymentProviderContract
{
    private GerencianetService $service;
    private ResponseErrorTransformer $error;

    public function __construct()
    {
        $this->service = new GerencianetService();
        $this->error = new ResponseErrorTransformer();
    }

    public function authenticate(): array
    {
        return $this->service->authenticate();
    }

    public function createPlan(string $name, int $interval): array
    {
        try {
            return $this->service->createPlan($name, $interval);
        } catch (ServerException $exception) {
            throw new GerencianetException(
                $this->error->handle($exception->getResponse()->getBody()->getContents())
            );
        }
    }

    public function createSubscription($planId, string $name, float $price): array
    {
        try {
            return $this->service->createSubscription($planId, $name, $price);
        } catch (ServerException $exception) {
            throw new GerencianetException(
                $this->error->handle($exception->getResponse()->getBody()->getContents())
            );
        }
    }

    public function makePayment(int $subscriptionId, array $payload): array
    {
        try {
            return $this->service->makePayment($subscriptionId, $payload);
        } catch (ServerException $exception) {
            throw new GerencianetException(
                $this->error->handle($exception->getResponse()->getBody()->getContents())
            );
        }
    }

    public function getSubscription(string $subscriptionId): array
    {
        try {
            return $this->service->getSubscription($subscriptionId);
        } catch (ServerException $exception) {
            throw new GerencianetException(
                $this->error->handle($exception->getResponse()->getBody()->getContents())
            );
        }
    }
}
