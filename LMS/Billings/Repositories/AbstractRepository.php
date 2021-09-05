<?php

namespace LMS\Billings\Repositories;

use Illuminate\Support\Str;
use LMS\Billings\Contracts\PaymentProviderContract;
use LMS\Billings\Models\Provider;
use LMS\Billings\Services\Gerencianet\GerencianetService;

abstract class AbstractRepository
{
    protected int $provider;
    private string $providerName;

    public function __construct()
    {
        $provider = Provider::where('active', true)->first();
        $this->provider = $provider->id;
        $this->providerName = $provider->name;
    }

    public function getProvider(): PaymentProviderContract
    {
        return match (Str::slug($this->providerName)) {
            'gerencianet' => new GerencianetService(),
            default => throw new \Exception('fudeu')
        };
    }
}
