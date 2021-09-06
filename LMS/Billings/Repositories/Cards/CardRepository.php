<?php

namespace LMS\Billings\Repositories\Cards;

use Illuminate\Support\Facades\Auth;
use LMS\Billings\Models\Card;
use LMS\Billings\Repositories\AbstractRepository;
use Ramsey\Uuid\Uuid;

class CardRepository extends AbstractRepository
{
    private Card $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Card();
    }


    public function createCard(array $payload)
    {
        $payload['id'] = Uuid::uuid4()->toString();
        $payload['provider_id'] = $this->provider;
        return Auth::user()->card()->create($payload);
    }

    public function deleteCards(): bool
    {
        Auth::user()->card()->delete();
        return true;
    }
}
