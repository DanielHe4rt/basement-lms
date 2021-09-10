<?php

namespace LMS\Billings\Services\Gerencianet;

use GuzzleHttp\Client;
use LMS\Billings\Contracts\PaymentProviderContract;
use LMS\Billings\Services\AbstractService;

class GerencianetService extends AbstractService implements PaymentProviderContract
{
    private Client $client;

    private string $accessToken;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('paymentProviders.gerencianet.baseUri.' . config('paymentProviders.environment'))
        ]);
    }

    private function encodeCredentials(): string
    {
        $clientId = config('paymentProviders.gerencianet.client_id.' . config('paymentProviders.environment'));
        $clientSecret = config('paymentProviders.gerencianet.client_secret.' . config('paymentProviders.environment'));
        return base64_encode(
            sprintf('%s:%s', $clientId, $clientSecret)
        );
    }

    public function authenticate(): array
    {
        $uri = '/v1/authorize';
        $response = $this->client->request('POST', $uri, [
            'headers' => [
                'Authorization' => 'Basic ' . $this->encodeCredentials()
            ],
            'json' => [
                'grant_type' => 'client_credentials'
            ]
        ]);

        $result = json_decode($response->getBody(), true);
        $this->accessToken = $result['access_token'];

        return $result;
    }

    public function createPlan(string $name, int $interval): array
    {
        $uri = '/v1/plan';
        $response = $this->client->request('POST', $uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken
            ],
            'json' => [
                'name' => $name,
                'interval' => $interval,
                'repeats' => null
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        return [
            'id' => $result['data']['plan_id']
        ];
    }

    public function createSubscription($planId, string $name, float $price): array
    {
        $uri = sprintf('/v1/plan/%s/subscription', $planId);
        $response = $this->client->request('POST', $uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken
            ],
            'json' => [
                'items' => [
                    [
                        'name' => $name,
                        'value' => $price,
                        'amount' => 1
                    ]
                ],
                'metadata' => [
                    'notification_url' => route('billing-callbacks', ['provider' => 'gerencianet'])
                ]
            ]
        ]);

        $result = json_decode($response->getBody(), true);
        return [
            'id' => $result['data']['subscription_id']
        ];
    }

    public function makePayment(int $subscriptionId, array $payload): array
    {
        $uri = sprintf('/v1/subscription/%s/pay', $subscriptionId);
        $response = $this->client->request('POST', $uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
            'json' => $payload
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getSubscriptionInformation(string $token): array
    {
        $uri = sprintf('/v1/notification/%s', $token);
        $response = $this->client->request('GET', $uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getSubscription(string $subscriptionId): array
    {
        $uri = sprintf('/v1/subscription/%s', $subscriptionId);
        $response = $this->client->request('GET', $uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
        ]);

        return json_decode($response->getBody(), true)['data'];
    }
}
