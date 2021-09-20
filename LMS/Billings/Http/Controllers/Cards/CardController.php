<?php

namespace LMS\Billings\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LMS\Billings\Http\Requests\Cards\CreateCardRequest;
use LMS\Billings\Repositories\Cards\CardRepository;

class CardController extends Controller
{
    private CardRepository $repository;

    public function __construct(CardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postCard(CreateCardRequest $request): Response
    {
        $this->repository->createCard($request->validated());
        return response()->noContent();
    }

    public function deleteCard(): Response
    {
        $this->repository->deleteCards();
        return response()->noContent();
    }
}
